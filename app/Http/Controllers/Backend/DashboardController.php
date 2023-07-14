<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $jumlah_kategori = Category::count();
            $jumlah_program_all = Campaign::count();
            $jumlah_program_pending = Campaign::where('status', 'pending')->count();
            $jumlah_kontak_masuk = Contact::whereDate('created_at', date('Y-m-d'))->count();
            $total_donasi = Campaign::sum('amount');
            $total_donasi_belum_dibayar = Donation::where('status', 'not paid');
            $total_donasi_sudah_dibayar = Donation::where('status', 'paid');

            return view('backend.dashboard_admin', compact([
                'jumlah_kategori',
                'jumlah_program_all',
                'jumlah_program_pending',
                'jumlah_kontak_masuk',
                'total_donasi',
                'total_donasi_belum_dibayar',
                'total_donasi_sudah_dibayar',
            ]));
        }

        return view('backend.dashboard_not_admin');
    }
}
