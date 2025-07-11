<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\header;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profile', [
            'user' => $request->user(),
            'header' => Header::first(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Tambahkan validasi manual jika tidak hanya mengandalkan Form Request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->user()->id,
            'username' => 'required|string|max:100|unique:users,username,' . $request->user()->id
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $user = $request->user();
        $data = $request->only(['name', 'email', 'username']);

        if ($user->email !== $data['email']) {
            $user->email_verified_at = null;
        }

        $update = $user->update($data);
        if (!$update) {
            return redirect()->back()->with('error', 'Gagal memperbarui profile.');
        } else {
            return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus gambar profil jika ada
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $user = $request->user();

        // Hapus gambar lama jika ada
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // Simpan gambar baru
        $path = $request->file('avatar')->store('user', 'public');
        $user->image = $path;
        $update = $user->save();

        if ($update) {
            $status = 'success';
            $message = 'Foto profil berhasil diperbarui.';
        } else {
            $status = 'error';
            $message = 'Foto profil gagal diperbarui.';
        }


        return response()->json([
            'status' => $status,
            'message' => $message,
            'image_url' => asset('storage/' . $path),
        ]);
    }
}
