<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
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
        $donatur = User::with('role')
            ->whereRelation('role', 'name', '=', 'donatur')
            ->get()->pluck('name', 'id');
        return view('frontend.pages.donation.create', compact('campaign', 'donatur'));
    }

    public function detail($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('frontend.pages.donation.detail', compact('campaign'));
    }

    public function checkout(Request $request, $id)
    {
        $this->validate($request, [
            'nominal' => 'required',
        ]);
    }
}
