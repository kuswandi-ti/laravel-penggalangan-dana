<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return view('frontend.pages.donation.index');
    }

    public function create()
    {
        return view('frontend.pages.donation.create');
    }

    public function detail()
    {
        return view('frontend.pages.donation.detail');
    }
}
