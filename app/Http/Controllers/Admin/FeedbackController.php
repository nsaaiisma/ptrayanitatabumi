<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\feedback;
use App\Models\header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbackUnshown = feedback::where('status', 'inactive')->get()->map(function ($feedback) {
            $feedback->encrypted_id = Crypt::encryptString($feedback->id);
            return $feedback;
        });

        $feedbackShown = feedback::where('status', 'active')->get()->map(function ($feedback) {
            $feedback->encrypted_id = Crypt::encryptString($feedback->id);
            return $feedback;
        });

        $header = header::first();
        $data = [
            'feedbackUnshown' => $feedbackUnshown,
            'feedbackShown' => $feedbackShown,
            'header' => $header
        ];
        return view('admin.feedback', $data);
    }

    public function toggle(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->id);
            $feedback = Feedback::findOrFail($id);
            $feedback->status = $request->status;
            $feedback->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
