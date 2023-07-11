<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $donatur_count = User::where('role_id', '=', 2)->count();
        $donation_sum = Donation::sum('nominal');

        return view('frontend.pages.about.index', compact([
            'donatur_count',
            'donation_sum',
        ]));
    }
}
