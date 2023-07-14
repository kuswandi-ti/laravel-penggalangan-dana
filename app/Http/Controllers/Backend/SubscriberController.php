<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.subscriber.index');
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
    public function destroy($id)
    {
        try {
            $subscriber = Subscriber::findOrFail($id);
            $query = $subscriber->delete();

            if ($query) {
                return response()->json([
                    'data' => null,
                    'message' => 'Data Subscriber berhasil dihapus.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Subscriber gagal dihapus.'
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Proses hapus data gagal !!!'
            ], 500);
        }
    }

    public function data()
    {
        $query = Subscriber::orderBy('created_at');

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('email', function ($query) {
                return '<a href="mailto:'. $query->email .'" target="_blank">'. $query->email .'</a>';
            })
            ->editColumn('created_at', function ($query) {
                return date_format_id($query->created_at);
            })
            ->addColumn('action', function ($query) {
                return '
                    <button class="btn btn-link text-danger"
                        onclick="deleteData(`' . route('admin.subscriber.destroy', $query->id) . '`)">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }
}
