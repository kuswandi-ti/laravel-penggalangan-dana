<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.contact.index');
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
            $contact = Contact::findOrFail($id);
            $query = $contact->delete();

            if ($query) {
                return response()->json([
                    'data' => null,
                    'message' => 'Data Kontak berhasil dihapus.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kontak gagal dihapus.'
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Proses hapus data gagal !!!'
            ], 500);
        }
    }

    public function data(Request $request)
    {
        $query = Contact::when($request->has('date') && $request->date != "", function ($query) use ($request) {
                $query->whereDate('created_at', $request->date);
            })
            ->orderBy('name');

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('name', function ($query) {
                return $query->name .'<br><a href="mailto:'. $query->email .'" target="_blank">'. $query->email .'</a>';
            })
            ->editColumn('created_at', function ($query) {
                return date_format_id($query->created_at);
            })
            ->addColumn('action', function ($query) {
                return '
                    <button class="btn btn-link text-danger"
                        onclick="deleteData(`' . route('contact.destroy', $query->id) . '`)">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }
}
