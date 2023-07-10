<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('publish_date', 'DESC')->get();
        return view('frontend.pages.donation.index', compact('campaigns'));
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
