<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        return view('frontend.pages.campaigns');
    }

    public function detail()
    {
        return view('frontend.pages.campaigns_detail');
    }
}
