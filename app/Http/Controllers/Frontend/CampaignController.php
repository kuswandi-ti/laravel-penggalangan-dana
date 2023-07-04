<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Program',
        ];
        return view('frontend.pages.campaigns', $data);
    }

    public function detail()
    {
        $data = [
            'title' => 'Program Detail',
        ];
        return view('frontend.pages.campaigns_detail', $data);
    }
}