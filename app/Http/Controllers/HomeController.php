<?php

namespace App\Http\Controllers;

use App\Models\about;
use App\Models\contact;
use App\Models\feedback;
use App\Models\header;
use App\Models\portofolio;
use App\Models\product;
use App\Models\social;
use App\Models\title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $products = product::where('status', 'active')->get()->map(function ($product) {
            $product->encrypted_id = Crypt::encrypt($product->id);
            $product->imageUrl = url('/') . Storage::url($product->image);
            return $product;
        });
        $portofolios = portofolio::take(3)->get()->map(function ($portofolio) {
            $portofolio->encrypted_id = Crypt::encrypt($portofolio->id);
            return $portofolio;
        });
        $abouts = about::orderBy('years', 'desc')->get()->map(function ($about) {
            $about->encrypted_id = Crypt::encrypt($about->id);
            return $about;
        });
        $testimonials = feedback::where('status', 'active')->orderBy('updated_at', 'desc')->get();
        $data = [
            'header' => header::first(),
            'title' => title::first(),
            'contact' => contact::first(),
            'social' => social::first(),
            'products' => $products,
            'portofolios' => $portofolios,
            'abouts' => $abouts,
            'testimonials' => $testimonials
        ];
        return view('home', $data);
    }


    public function sendFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $stored = feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'message' => $request->message,
            'status' => 'inactive', // default: tampil
        ]);

        if (!$stored) {
            return redirect()->back()->with('error', 'Gagal mengirim feedback.');
        }
        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }
}
