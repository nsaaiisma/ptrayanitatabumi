<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\header;
use App\Models\social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
{
    public function index()
    {
        $header = header::first();
        $social = social::first();
        $social->encrypted_id = Crypt::encrypt($social->id);
        $data = [
            'header' => $header,
            'social' => $social
        ];
        return view('admin.social', $data);
    }

    public function editSocial(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'whatsapp'  => 'nullable|url',
            'instagram' => 'nullable|url',
            'facebook'  => 'nullable|url',
            'youtube'   => 'nullable|url',
            'linkedin'  => 'nullable|url',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->with('error', implode(', ', $validated->errors()->all()));
        }

        try {
            $id = Crypt::decrypt($request->id);
            $social = Social::findOrFail($id);

            $update = $social->update([
                'whatsapp'  => $request->whatsapp,
                'instagram' => $request->instagram,
                'facebook'  => $request->facebook,
                'youtube'   => $request->youtube,
                'linkedin'  => $request->linkedin,
            ]);

            if (!$update) {
                return redirect()->back()->with('error', 'Gagal memperbarui data.');
            }

            return redirect()->back()->with('success', 'Data sosial media berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}
