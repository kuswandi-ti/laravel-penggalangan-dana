<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileInformationController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'request' => $request,
            'user' => $request->user(),
            'bank' => Bank::all()->pluck('name', 'id'),
        ]);
    }

    public function bank_destroy(Request $request, $id)
    {
        $request->user()->bank_users()->detach($id);

        return redirect()->back()->with('success', 'Data Bank Terdaftar berhasil diperbaharui.');
    }
}
