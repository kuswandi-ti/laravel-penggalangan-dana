<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Cashout;
use App\Models\Contact;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Subscriber;
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

            // * range 1 tahun
            $range = range(1, 12);
            $list_bulan = [];
            $list_donasi = [];
            $list_pencairan = [];

            foreach ($range as $bulan) {
                $donasi = Donation::whereMonth('created_at', $bulan)
                    ->whereYear('created_at', date('Y'))
                    ->where('status', 'confirmed')
                    ->sum('nominal');
                $pencairan = Cashout::whereMonth('created_at', $bulan)
                    ->whereYear('created_at', date('Y'))
                    ->where('status', 'success')
                    ->sum('cashout_amount');

                $list_bulan[] = mounth_format_id($bulan);
                $list_donasi[] = $donasi;
                $list_pencairan[] = $pencairan;
            }

            // * range 1 bulan
            $projek_populer = Campaign::withCount('donations')
                ->orderByDesc('donations_count')
                ->limit(10)
                ->get();

            $top_donatur = User::withCount('donations', 'campaigns')
                ->donatur()
                ->orderByDesc('donations_count')
                ->orderByDesc('campaigns_count')
                ->limit(10)
                ->get();

            $list_nama_user = ['Donatur', 'Subscriber'];
            $list_jumlah_user = [
                User::donatur()->where('created_at', 'LIKE', date('Y-m'). '%')->count(),
                Subscriber::where('created_at', 'LIKE', date('Y-m'). '%')->count()
            ];

            // * range 1 hari
            $list_notifikasi = [
                'donatur' => User::donatur()->get(), // ->whereDate('created_at', date('Y-m-d'))
                'subscriber' => Subscriber::get(), // whereDate('created_at', date('Y-m-d'))->
                'contact' => Contact::get(), // whereDate('created_at', date('Y-m-d'))->
                'donation' => Donation::get(), // whereDate('created_at', date('Y-m-d'))->
                'cashout' => Cashout::get(), // whereDate('created_at', date('Y-m-d'))->
            ];

            $count_notifikasi = collect($list_notifikasi)->map(fn ($item) => $item->count())->sum();

            return view('backend.pages.dashboard', compact([
                'jumlah_kategori',
                'jumlah_program_all',
                'jumlah_program_pending',
                'jumlah_kontak_masuk',
                'total_donasi',
                'jumlah_donasi_belum_dibayar',
                'jumlah_donasi_sudah_dibayar',
                'total_donasi_dicairkan',
                'list_bulan',
                'list_donasi',
                'list_pencairan',
                'projek_populer',
                'top_donatur',
                'list_nama_user',
                'list_jumlah_user',
                'list_notifikasi',
                'count_notifikasi',
            ]));
        }

        return view('backend.pages.dashboard');
    }
}
