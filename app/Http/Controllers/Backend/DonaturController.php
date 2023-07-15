<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banks = Bank::orderBy('id', 'desc')
            ->when($request->has('keyword') && $request->keyword != "", function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate($request->per_page ?? env('CUSTOM_PAGING'))
            ->appends($request->only('per_page', 'keyword'));
        return view('backend.pages.donatur.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
