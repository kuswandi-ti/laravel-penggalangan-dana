<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cashout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CashoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.cashout.index');
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
        $cashout = Cashout::with('campaign', 'user')->findOrFail($id);
        if ($cashout->user_id != auth()->id() && auth()->user()->hasRole('donatur')) {
            abort(404);
        }

        $campaign = $cashout->campaign;
        $bank = $cashout->user->bank_user->find($cashout->bank_id);

        return view('backend.pages.cashout.show', compact('cashout', 'campaign', 'bank'));
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
            'reason_rejected' => 'required_if:status,rejected|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cashout = Cashout::findOrFail($id);
        $cashout->update([
            'status' => $request->status,
            'reason_rejected' => $request->reason_rejected
        ]);

        $statusText = "";
        if ($request->status == 'success') {
            $statusText = 'dikonfirmasi';
        } elseif ($request->status == 'canceled') {
            $statusText = 'dibatalkan';
        } elseif ($request->status == 'rejected') {
            $statusText = 'ditolak';
        }

        return response()->json(['data' => $cashout, 'message' => 'Data pencairan dana berhasil ' . $statusText]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cashout = Cashout::findOrFail($id);
        $cashout->delete();

        // TODO : balikin lagi amount cancel ke tabel campaigns

        return response()->json(['data' => null, 'message' => 'Data pencairan dana berhasil dihapus']);
    }

    public function data(Request $request)
    {
        $query = Cashout::with('campaign', 'user')
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
            ->editColumn('cashout_amount', function ($query) {
                return amount_format_id($query->cashout_amount);
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-' . $query->status_color() . '">' . $query->status_text() . '</span>';
            })
            ->editColumn('created_at', function ($query) {
                return date_format_id($query->created_at);
            })
            ->addColumn('action', function ($query) {
                return '
                    <a href="' . route('backend.cashout.show', $query->id) . '" class="btn btn-link text-dark"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-link text-danger" onclick="deleteData(`' . route('backend.cashout.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
