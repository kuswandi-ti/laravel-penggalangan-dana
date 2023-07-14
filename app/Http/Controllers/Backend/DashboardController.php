<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cashout;
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
            $jumlah_donasi_belum_dibayar = Donation::where('status', 'not paid')->count();
            $jumlah_donasi_sudah_dibayar = Donation::where('status', 'paid')->count();
            $total_donasi_dicairkan = Cashout::where('status', 'success')->sum('cashout_amount');

            return view('backend.dashboard_admin', compact([
                'jumlah_kategori',
                'jumlah_program_all',
                'jumlah_program_pending',
                'jumlah_kontak_masuk',
                'total_donasi',
                'jumlah_donasi_belum_dibayar',
                'jumlah_donasi_sudah_dibayar',
                'total_donasi_dicairkan',
            ]));
        }

        return view('backend.dashboard_not_admin');
    }
}
