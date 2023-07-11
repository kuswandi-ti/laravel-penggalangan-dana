<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;

class AboutController extends Controller
{
    public function index()
    {
        $donatur_count = User::where('role_id', '=', 2)->count();
        $donation_sum = Campaign::sum('amount');

        return view('frontend.pages.about.index', compact([
            'donatur_count',
            'donation_sum',
        ]));
    }
}
