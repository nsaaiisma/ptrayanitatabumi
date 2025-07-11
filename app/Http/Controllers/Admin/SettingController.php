<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\header;
use App\Models\title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $setting = title::first();
        $setting->encrypted_id = Crypt::encrypt($setting->id);
        $header = header::first();
        $data = [
            'setting' => $setting,
            'header' => $header
        ];

        return view('admin.setting', $data);
    }

    public function updateData(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
            'tipe' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_description' => 'nullable|string',
            'owner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            $v_error = $validator->errors()->all();
            return redirect()->route('admin.setting')->with('error', implode(',', $v_error));
        }

        $id = Crypt::decrypt($input['id']);
        $title = Title::findOrFail($id);
        $tipe = $input['tipe'];

        // Data awal berdasarkan tipe
        if ($tipe == 'product') {
            $data = [
                'captionProduct' => $input['title'],
                'descriptionProduct' => $input['description'],
            ];
        } else if ($tipe == 'portofolio') {
            $data = [
                'captionPortofolio' => $input['title'],
                'descriptionPortofolio' => $input['description'],
            ];
        } else if ($tipe == 'about') {
            $data = [
                'captionAboutMe' => $input['title'],
                'descriptionAboutMe' => $input['description'],
            ];
        } else if ($tipe == 'testimoni') {
            $data = [
                'captionTestimoni' => $input['title'],
                'descriptionTestimoni' => $input['description'],
            ];
        } else {
            $data = [];
        }

        if (!empty($input['ownerDescription'])) {
            $data['owner_description'] = $input['ownerDescription'];
        }

        if ($request->hasFile('ownerImage')) {
            if ($title->owner_image && Storage::disk('public')->exists($title->owner_image)) {
                Storage::delete($title->owner_image);
            }

            $data['owner_image'] = $request->file('ownerImage')->store('owner', 'public');
        }

        $data['updated_by'] = auth()->id();

        $update = $title->update($data);

        if (!$update) {
            return redirect()->route('admin.setting')->with('error', 'Data gagal diperbarui.');
        } else {
            return redirect()->route('admin.setting')->with('success', 'Data berhasil diperbarui.');
        }
    }
}
