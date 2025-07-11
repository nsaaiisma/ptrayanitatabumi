<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HeaderController extends Controller
{
    public function index()
    {
        $header = header::first();
        $header->encrypted_id = Crypt::encrypt($header->id);
        $data = [
            'header' => $header
        ];
        return view('admin.header', $data);
    }

    public function editHeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|string|max:255',
            'sub-title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $id = Crypt::decrypt($request->id);
        $header = Header::findOrFail($id);

        $data = [
            'heading' => $request->input('title'),
            'subheading' => $request->input('sub-title'),
            'description' => $request->input('description'),
        ];

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            if (
                $header->logo && // Cegah hapus default logo
                Storage::disk('public')->exists($header->logo)
            ) {
                Storage::disk('public')->delete($header->logo);
            }
            $data['logo'] = $request->file('logo')->store('header', 'public');
        }

        // Handle Background Image Upload
        if ($request->hasFile('image')) {
            if (
                $header->image && // Cegah hapus default background
                Storage::disk('public')->exists($header->image)
            ) {
                Storage::disk('public')->delete($header->image);
            }
            $data['image'] = $request->file('image')->store('header', 'public');
        }


        $update = $header->update($data);
        if (!$update) {
            return redirect()->back()->with('error', 'Gagal memperbarui header.');
        } else {
            return redirect()->route('admin.header')->with('success', 'Header berhasil diperbarui.');
        }
    }
}
