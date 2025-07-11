<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use App\Models\header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contact = contact::first();
        $contact->encrypted_id = Crypt::encrypt($contact->id);
        $header = header::first();

        $data = [
            'contact' => $contact,
            'header' => $header
        ];
        return view('admin.contact', $data);
    }

    public function editContact(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
            'location' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'day-start' => 'required|string',
            'day-end' => 'required|string',
            'time-start' => 'required',
            'time-end' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->with('error', implode(', ', $validated->errors()->all()));
        }

        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        $contact = Contact::findOrFail($id);

        $time_operational = $request->input('day-start') . ' - ' . $request->input('day-end') . ': ' .
            date('H.i', strtotime($request->input('time-start'))) . ' - ' .
            date('H.i', strtotime($request->input('time-end'))) . ' WIB';

        $update = $contact->update([
            'location' => $request->input('location'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'time_operational' => $time_operational,
        ]);

        if (!$update) {
            return redirect()->route('admin.contact')->with('error', 'Data contact gagal diperbarui.');
        } else {
            return redirect()->route('admin.contact')->with('success', 'Data contact berhasil diperbarui.');
        }
    }
}
