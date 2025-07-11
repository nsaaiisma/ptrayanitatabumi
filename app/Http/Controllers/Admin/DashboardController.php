<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\feedback;
use App\Models\header;
use App\Models\portofolio;
use App\Models\product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $header = header::first();
        $portofolio = portofolio::all()->count();
        $product = product::all()->count();
        $feedback = feedback::all()->count();
        $data = [
            'header' => $header,
            'portofolio' => $portofolio,
            'product' => $product,
            'feedback' => $feedback
        ];
        return view('admin.dashboard', $data);
    }
}
