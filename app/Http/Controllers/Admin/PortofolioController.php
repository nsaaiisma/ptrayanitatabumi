<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\header;
use App\Models\portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = portofolio::all()->map(function ($portofolio) {
            $portofolio->encrypted_id = Crypt::encrypt($portofolio->id);
            return $portofolio;
        });
        $header = header::first();
        $data = [
            'portofolios' => $portofolios,
            'header' => $header
        ];
        return view('admin.portofolio', $data);
    }

    public function addPortofolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'time' => 'required|numeric',
            'years' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'timeRange' => $request->time,
            'years' => $request->years,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portofolio', 'public');
        }

        $portofolio = Portofolio::create($data);

        return redirect()->back()->with($portofolio ? 'success' : 'error', $portofolio ? 'Data berhasil ditambahkan' : 'Gagal menambahkan data');
    }

    public function editPortofolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'time' => 'required|numeric',
            'years' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $id = Crypt::decrypt($request->id);
        $portofolio = Portofolio::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'timeRange' => $request->time,
            'years' => $request->years
        ];

        if ($request->hasFile('image')) {
            if ($portofolio->image && Storage::disk('public')->exists($portofolio->image)) {
                Storage::disk('public')->delete($portofolio->image);
            }
            $data['image'] = $request->file('image')->store('portofolio', 'public');
        }

        $updated = $portofolio->update($data);

        return redirect()->back()->with($updated ? 'success' : 'error', $updated ? 'Data berhasil diupdate' : 'Gagal mengupdate data');
    }

    public function deletePortofolio(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->id);

            $portofolio = Portofolio::findOrFail($id);

            if ($portofolio->image && Storage::disk('public')->exists($portofolio->image)) {
                if ($portofolio->image !== 'portofolio/default.png') {
                    Storage::disk('public')->delete($portofolio->image);
                }
            }

            $portofolio->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data. ' . $e->getMessage()
            ]);
        }
    }

    public function statusPortofolio(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:finished,unfinished',
        ]);

        try {
            $id = Crypt::decrypt($request->id);
            $portofolio = Portofolio::findOrFail($id);
            $portofolio->status = $request->status;
            $portofolio->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui status.'
            ]);
        }
    }
}
