<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PaymentDonationConfirm;
use Illuminate\Support\Facades\Mail;
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

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $donatur = User::with('role')
            ->whereRelation('role', 'name', '=', 'donatur')
            ->get();
        return view('frontend.pages.donation.edit', compact('campaign', 'donatur'));
    }

    public function checkout(Request $request, $id)
    {
        $this->validate($request, [
            'nominal' => 'required|integer|min:1000',
            'user_id' => 'required|exists:users,id',
            'anonim' => 'nullable|in:1,0',
            'support' => 'nullable',
        ]);

        $data = [];

        $order_number = 'PX-' . time();

        $data['campaign_id'] = $id;
        $data['user_id'] = $request->user_id;
        $data['order_number'] = $order_number; // mt_rand(0000000000, 9999999999);
        $data['anonim'] = $request->anonim ?? 0;
        $data['nominal'] = str_replace('.', '', $request->nominal);
        $data['support'] = $request->support;
        $data['status'] = env('STATUS_DONATION_NOT_PAID');

        $donation = Donation::create($data);

        if ($donation) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $donation->id,
                    'order_number' => $donation->order_number,
                    'gross_amount' => $donation->nominal,
                ),
                'customer_details' => array(
                    'first_name' => $donation->user->name,
                    'last_name' => '',
                    'email' => $donation->user->email,
                    'phone' => $donation->user->phone,
                ),
            );

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

    public function callback_donation()
    {
        $server_key = config('midtrans.midtrans_server_key');

        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$serverKey = $server_key;

        $notification = new \Midtrans\Notification();

        $order_id = $notification->order_id;
        $status_code = $notification->status_code;
        $signature_key = $notification->signature_key;
        $transaction_status = $notification->transaction_status;
        $payment_time = $notification->transaction_time;
        $payment_type = $notification->payment_type;
        $payment_currency = $notification->currency;
        $fraud_status = $notification->fraud_status;
        $gross_amount = $notification->gross_amount;

        $hashed = hash("sha512", $order_id . $status_code . $gross_amount . $server_key);

        $payment_status = '';
        if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
            $payment_status = env('STATUS_PAYMENT_SUCCESS');
        } else if ($transaction_status == 'pending' || $transaction_status == 'authorize') {
            $payment_status = env('STATUS_PAYMENT_PENDING');
        } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'failure') {
            $payment_status = env('STATUS_PAYMENT_CANCEL');
        } else if ($transaction_status == 'refund' || $transaction_status == 'partial_refund') {
            $payment_status = env('STATUS_PAYMENT_REFUND');
        }

        if ($hashed == $signature_key) {
            $donation = Donation::findOrFail($order_id);

            // Insert di tabel payments
            $payment = Payment::create([
                'user_id' => $donation->user->id,
                'order_number' => $donation->order_number,
                'name' => $donation->user->name,
                'phone' => $donation->user->phone,
                'email' => $donation->user->email,
                'nominal' => $gross_amount,
                'bank_id' => 1,
                'payment_time' => $payment_time,
                'payment_type' => $payment_type,
                'payment_currency' => $payment_currency,
                'payment_status' => $payment_status,
            ]);

            if (($transaction_status == 'capture' && $payment_type == 'credit_card' && $fraud_status == 'accept') ||
                $transaction_status == 'settlement'
            ) {
                // Update status di tabel donations
                $donation->update([
                    'status' => env('STATUS_DONATION_PAID'),
                ]);

                $campaign_id = $donation->campaign_id;
                $campaign = Campaign::findOrFail($campaign_id);

                // Update payment_status di tabel payments                
                Payment::where([
                    ['id', '=', $payment->id],
                ])->update([
                    'payment_status' => $payment_status,
                ]);

                // Update amount di tabel campaigns
                Campaign::where([
                    ['id', '=', $campaign_id],
                ])->update([
                    'amount' => $campaign->amount + $gross_amount,
                ]);
            } else {
                abort(403);
            }
        }
    }

    public function payment_confirm($id, $order_number)
    {
        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();

        if (!$donation) {
            abort(404);
        }

        $donation_email = Donation::with('campaign', 'user', 'payment')->findOrFail($donation->id);
        Mail::to($donation->user->email)->send(new PaymentDonationConfirm($donation_email));

        return view('frontend.pages.donation.payment_confirm', compact('campaign', 'donation'));
    }
}
