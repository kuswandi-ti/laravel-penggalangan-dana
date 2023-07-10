<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact.index');
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->only([
            'name', 'email', 'phone', 'subject', 'message'
        ]), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validated->errors(),
            ]);
        }

        $query = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        if ($query) {
            return response()->json([
                'error' => false,
                'message' => 'Menambahkan data kontak berhasil.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Menambahkan data kontak gagal.'
            ]);
        }
    }
}
