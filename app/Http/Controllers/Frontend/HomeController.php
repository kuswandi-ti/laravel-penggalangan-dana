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
        $campaigns = Campaign::orderBy('publish_date', 'DESC')->get();
        return view('frontend.pages.home')->with('campaigns', $campaigns);
    }

    public function subscriber(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:subscribers,email',
        ]);

        // $validated = Validator::make($request->all(), [
        //     'email' => 'required|unique:subscribers,email',
        // ]);

        // if ($validated->fails()) {
        //     return back()->with([
        //         'errors' => true,
        //         'message' => $validated->errors(),
        //     ]);
        // }

        Subscriber::create($request->only('email'));

        // return back()->with([
        //     'errors' => false,
        //     'message' => 'Subscribe berhasil ditambahkan.',
        // ]);

        return back()->with('success', 'Email Subscriber berhasil ditambahkan.');
    }
}
