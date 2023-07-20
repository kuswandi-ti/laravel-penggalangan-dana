<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PaymentDonationConfirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.donation.index');
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
    public function show(Request $request, string $id)
    {
        $donation = Donation::with('campaign', 'user', 'payment')->findOrFail($id);

        if (! $request->ajax()) {
            return view('backend.pages.donation.show', compact('donation'));
        }

        return response()->json(['data' => $donation]);
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
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $donation = Donation::findOrFail($id);
        $donation->update([
            'status' => $request->status
        ]);

        $donation->campaign->update([
            'amount' => $donation->campaign->amount + $donation->nominal
        ]);

        $donation->payment->update([
            'payment_status' => env('STATUS_PAYMENT_SUCCESS')
        ]);

        $statusText = "";
        if ($request->status == 'paid') {
            $statusText = 'sudah dibayar';
        } elseif ($request->status == 'cancel') {
            $statusText = 'dibatalkan';
        }

        $donation_email = Donation::with('campaign', 'user', 'payment')->findOrFail($id);
        Mail::to($donation->user->email)->send(new PaymentDonationConfirm($donation_email));

        return response()->json(['data' => $donation, 'message' => 'Data donasi berhasil '. $statusText]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donation = Donation::findOrFail($id);

        // Update amount di tabel campaigns
        Campaign::where([
            ['id', '=', $donation->campaign_id],
        ])->update([
            'amount' => $donation->campaign->amount - $donation->nominal,
        ]);

        // Delete di tabel payments
        $payment = Payment::where('id', '=', $donation->payment->id);
        $donation->delete();

        // Delete di tabel donations
        $donation->delete();

        return response()->json(['data' => null, 'message' => 'Data donasi berhasil dihapus']);
    }

    public function data(Request $request)
    {
        $query = Donation::with('campaign', 'user', 'payment')
            ->when(auth()->user()->hasRole('donatur'), function ($query) {
                $query->donatur();
            })
            ->when($request->has('status') && $request->status != "", function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('created_at');

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('title', function ($query) {
                return $query->campaign->title;
            })
            ->editColumn('name', function ($query) {
                return $query->user->name;
            })
            ->editColumn('nominal', function ($query) {
                return amount_format_id($query->nominal);
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-' . $query->status_color() . '">' . $query->status_text() . '</span>';
            })
            ->editColumn('created_at', function ($query) {
                return date_format_id($query->created_at);
            })
            ->addColumn('action', function ($query) {
                $action = '';

                $action .= '
                    <a href="' . route('backend.donation.show', $query->id) . '" class="btn btn-link text-dark"><i class="fas fa-search-plus"></i></a>
                ';

                if ($query->status != 'paid') {
                    $action .= '
                        <button class="btn btn-link text-danger" onclick="deleteData(`' . route('backend.donation.destroy', $query->id) . '`)"><i class="fas fa-trash-alt"></i></button>
                    ';
                }

                return $action;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
