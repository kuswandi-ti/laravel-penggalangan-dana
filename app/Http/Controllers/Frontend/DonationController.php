<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CreateSnapTokenService;

class DonationController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('publish_date', 'desc')
            ->paginate(3)
            ->withQueryString();
        return view('frontend.pages.donation.index', compact('campaigns'));
    }

    public function create($id)
    {
        $campaign = Campaign::findOrFail($id);
        $donatur = User::with('role')
            ->whereRelation('role', 'name', '=', 'donatur')
            ->get();
        return view('frontend.pages.donation.create', compact('campaign', 'donatur'));
    }

    public function detail($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('frontend.pages.donation.detail', compact('campaign'));
    }

    public function checkout(Request $request, $id)
    {
        $this->validate($request, [
            'nominal' => 'required',
            'user_id' => 'required',
            'anonim' => 'nullable|in:1,0',
            'support' => 'nullable',
        ]);

        $data = [];

        $data['campaign_id'] = $id;
        $data['user_id'] = $request->user_id;
        $data['order_number'] = 'PX' . mt_rand(000000, 999999);
        $data['anonim'] = $request->anonim ?? 0;
        $data['nominal'] = str_replace('.', '', $request->nominal);
        $data['support'] = $request->support;
        $data['status'] = 'not paid';

        $donation = Donation::create($data);

        if ($donation) {
            // // Set your Merchant Server Key
            // \Midtrans\Config::$serverKey = config('midtrans.midtrans_server_key');
            // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            // \Midtrans\Config::$isProduction = config('midtrans.is_production');
            // // Set sanitization on (default)
            // \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            // // Set 3DS transaction for credit card to true
            // \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = array(
                'transaction_details' => array(
                    'order_id' => $donation->id,
                    'order_number' => $donation->order_number,
                    'gross_amount' => $donation->nominal,
                ),
                'item_details' => [
                    [
                        'id' => $donation->id,
                        'price' => $donation->nominal,
                        'quantity' => 1,
                        'name' => $donation->campaign->title,
                    ],
                ],
                'customer_details' => array(
                    'first_name' => $donation->user->name,
                    'email' => $donation->user->email,
                    'phone' => $donation->user->phone,
                ),
            );

            // $snapToken = \Midtrans\Snap::getSnapToken($params);

            $snapService = new CreateSnapTokenService();
            $snapToken = $snapService->getSnapToken($params);

            return redirect('/donation/' . $id . '/payment/' . $donation->order_number)
                ->with([
                    'success' => 'Data Pembayaran Berhasil Disimpan. Silahkan Lakukan Pembayaran.',
                    'snap_token' => $snapToken,
                ]);
        } else {
            return redirect('/donation/' . $id . '/payment/' . $donation->order_number)
                ->with([
                    'success' => 'Data Pembayaran Gagal Disimpan.',
                ]);
        }
    }

    public function payment($id, $order_number)
    {
        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();

        if (!$donation) {
            abort(404);
        }

        return view('frontend.pages.donation.payment', compact('campaign', 'donation'));
    }

    public function callback_payment(Request $request)
    {
        $serverKey = config('midtrans.midtrans_server_key');
        $hash = hash('SHA512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hash == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                /* Update data-data di database */
                $donation = Donation::findOrFail($request->order_id);
                $donation->update([
                    'status' => 'paid',
                ]);
            }
        }
    }
}
