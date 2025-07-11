<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\header;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->map(function ($user) {
            $user->encrypted_id = Crypt::encrypt($user->id);
            return $user;
        });
        $header = header::first();
        $data = [
            'users' => $users,
            'header' => $header
        ];
        return view('admin.user', $data);
    }

    public function addUser(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:admin,user'], // Sesuaikan dengan kebutuhan
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $v_error = $validator->errors()->all();
            return redirect()->route('admin.user')->with('error', implode(',', $v_error));
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'Data gagal disimpan');
        } else {
            return redirect()->route('admin.user')->with('success', 'Data berhasil disimpan');
        }
    }

    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(Crypt::decrypt($request->id))],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Crypt::decrypt($request->id))],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8'], // Optional password
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user')->with('error', implode(', ', $validator->errors()->all()));
        }

        try {
            $id = Crypt::decrypt($request->id);
            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role = $request->role;

            // Update password only if filled
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('admin.user')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
            $user = User::findOrFail($id);

            if ($user->image && File::exists(public_path('storage/uploads/users/' . $user->image))) {
                File::delete(public_path('storage/uploads/users/' . $user->image));
            }

            $user->delete();

            return response()->json(['status' => 'success', 'message' => 'User berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus user: ' . $e->getMessage()]);
        }
    }
}
