<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('publish_date', 'desc')
            ->paginate(3)
            ->withQueryString();
        return view('frontend.pages.donation.index', compact('campaigns'));
    }

    public function create($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('frontend.pages.donation.create', compact('campaign'));
    }

    public function detail($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('frontend.pages.donation.detail', compact('campaign'));
    }
}
