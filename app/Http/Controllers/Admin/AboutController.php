<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\about;
use App\Models\header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = about::all()->map(function ($about) {
            $about->encrypted_id = Crypt::encrypt($about->id);
            return $about;
        });
        $header = header::first();
        $data = [
            'abouts' => $abouts,
            'header' => $header
        ];
        return view('admin.about', $data);
    }

    public function addAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'years' => 'required|numeric',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $about = About::create([
            'title' => $request->title,
            'years' => $request->years,
            'description' => $request->description,
        ]);

        if (!$about) {
            return redirect()->back()->with('error', 'Data gagal disimpan.');
        } else {
            return redirect()->route('admin.about')->with('success', 'Data berhasil ditambahkan.');
        }
    }

    public function editAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|string|max:255',
            'years' => 'required|numeric',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        $about = About::findOrFail($id);

        $update = $about->update([
            'title' => $request->title,
            'years' => $request->years,
            'description' => $request->description,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'Data gagal diperbarui.');
        } else {
            return redirect()->route('admin.about')->with('success', 'Data berhasil diperbarui.');
        }
    }

    public function deleteAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.about')->with('error', implode(', ', $validator->errors()->all()));
        }

        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID tidak valid.',
            ]);
        }

        $about = about::find($id);

        if (!$about) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.',
            ]);
        }

        $about->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
