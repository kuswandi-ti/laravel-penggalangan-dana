<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Banner;
use App\Models\Campaign;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('publish_date', 'desc')
            ->paginate(3)
            ->withQueryString();

        $donatur_count = User::where('role_id', '=', 2)->count();
        $donation_sum = Campaign::sum('amount');

        $banners = Banner::orderBy('id', 'ASC')->get();

        return view('frontend.pages.home', compact([
            'donatur_count',
            'donation_sum',
            'campaigns',
            'banners',
        ]));
    }

    public function subscriber(Request $request)
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
