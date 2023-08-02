<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('frontend.pages.news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::find($id);
        return view('frontend.pages.news.show', compact('news'));
    }
}
