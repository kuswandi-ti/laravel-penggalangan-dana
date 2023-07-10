<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('publish_date', 'desc')
            ->paginate(3)
            ->withQueryString();
        return view('frontend.pages.home')->with('campaigns', $campaigns);
    }

    public function subscribe(Request $request)
    {
        $validated = Validator::make($request->only('email_subscribe'), [
            'email_subscribe' => 'required|email|unique:subscribers,email',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validated->errors(),
            ]);
        }

        $query = Subscriber::create([
            'email' => $request->email_subscribe,
        ]);

        if ($query) {
            return response()->json([
                'error' => false,
                'message' => 'Menambahkan data subscriber berhasil.'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Menambahkan data subscriber gagal.'
            ]);
        }
    }
}
