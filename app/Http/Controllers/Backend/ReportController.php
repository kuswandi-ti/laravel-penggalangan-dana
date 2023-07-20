<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cashout;
use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = now()->subDays(30)->format('Y-m-d');
        $end = date('Y-m-d');

        if ($request->has('start') && $request->start != "" && $request->has('end') && $request->end != "") {
            $start = $request->start;
            $end = $request->end;
        }

        return view('backend.pages.report.index', compact('start', 'end'));
    }

    public function get_data($start, $end, $escape = false)
    {
        $data = [];
        $i = 1;
        $sisa_kas = 0;
        $total_sisa_kas = 0;

        while (strtotime($start) <= strtotime($end)) {
            $donation = Donation::whereHas('payment')
                ->where('status', 'confirmed')
                ->where('created_at', 'LIKE', "%$start%")
                ->sum('nominal');
            $cashout_received = Cashout::whereHas('campaign')
                ->where('status', 'success')
                ->where('created_at', 'LIKE', "%$start%")
                ->sum('amount_received');
            $cashout_fee = Cashout::whereHas('campaign')
                ->where('status', 'success')
                ->where('created_at', 'LIKE', "%$start%")
                ->sum('cashout_fee');

            $total = ($donation + $cashout_fee) - $cashout_received;
            $sisa_kas += $total;
            $total_sisa_kas += $total;

            $separate = '';
            if ($escape) $separate = ',-';

            $row = [];
            $row['DT_RowIndex'] = $i++;
            $row['tanggal'] = date_format_id($start);
            $row['pemasukan'] = amount_format_id($donation + $cashout_fee) . $separate;
            $row['pengeluaran'] = amount_format_id($cashout_received) . $separate;
            $row['sisa'] = amount_format_id($sisa_kas) . $separate;

            array_push($data, $row);

            $start = date('Y-m-d', strtotime('+1 day', strtotime($start)));
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'pemasukan' => '',
            'pengeluaran' => ! $escape ? '<strong>Total Kas</strong>' : 'Total Kas',
            'sisa' => ! $escape ? '<strong>'. amount_format_id($total_sisa_kas) .'</strong>' : amount_format_id($total_sisa_kas) . $separate
        ];

        return $data;
    }

    public function data($start, $end)
    {
        $data = $this->get_data($start, $end);

        return datatables($data)
            ->escapeColumns([])
            ->make(true);
    }

    public function export_pdf($start, $end)
    {
        $data = $this->get_data($start, $end);
        $pdf = PDF::loadView('backend.pages.report.pdf', compact('start', 'end', 'data'));

        return $pdf->stream('laporan-penggalangan-dana-'. date('Y-m-d-his'). '.pdf');
    }

    public function export_excel($start, $end)
    {
        $data = $this->get_data($start, $end, true);
        $excel = new ReportExport($start, $end, $data);

        return Excel::download($excel, 'laporan-penggalangan-dana-'. date('Y-m-d-his'). '.xlsx');
    }
}
