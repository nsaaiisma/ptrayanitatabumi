<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\header;
use App\Models\portofolio;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $header = header::first();
        $products = product::all()->map(function ($product) {
            $product->encrypted_id = Crypt::encrypt($product->id);
            $product->imageUrl = url('/') . Storage::url($product->image);
            return $product;
        });
        $data = [
            'header' => $header,
            'products' => $products
        ];
        return view('admin.product', $data);
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'location' => 'required|string',
            'size' => 'required|string',
            'theme' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $data = $request->only(['name', 'category', 'description', 'price', 'location', 'size', 'theme']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $add = Product::create($data);

        if (!$add) {
            return redirect()->back()->with('error', 'Failed to add product.');
        } else {
            return redirect()->back()->with('success', 'Product added successfully.');
        }
    }

    public function editProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'size' => 'required|string',
            'theme' => 'required|string',
            'edit-image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $id = Crypt::decrypt($request->id);
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->location = $request->location;
        $product->size = $request->size;
        $product->theme = $request->theme;

        if ($request->hasFile('edit-image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('edit-image')->store('products', 'public');
        }

        $update = $product->save();

        if (!$update) {
            return redirect()->back()->with('error', 'Failed to update product.');
        } else {
            return redirect()->back()->with('success', 'Product updated successfully.');
        }
    }

    public function statusProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $id = Crypt::decrypt($request->id);
            $portofolio = Product::findOrFail($id);
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

    public function deleteProduct(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->id);

            $product = product::findOrFail($id);

            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $product->delete();

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
}
