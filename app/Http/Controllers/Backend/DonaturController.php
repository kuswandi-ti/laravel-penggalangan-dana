<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('backend.pages.donatur.index');
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $donatur = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2
        ]);

        return response()->json(['data' => $donatur, 'message' => 'Data donatur berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donatur = User::findOrFail($id);

        return response()->json(['data' => $donatur]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $donatur = User::findOrFail($id);
        $donatur->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->has('password') ? bcrypt($request->password) : $donatur->password,
        ]);

        return response()->json(['data' => $donatur, 'message' => 'Data donatur berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donatur = User::findOrFail($id);

        if (!empty($donatur->path_image)) {
            if (Storage::disk('public')->exists($donatur->path_image)) {
                Storage::disk('public')->delete($donatur->path_image);
            }
        }

        $donatur->delete();

        return response()->json(['data' => null, 'message' => 'Data donatur berhasil dihapus']);
    }

    public function data(Request $request)
    {
        $query = User::with('role')
            ->withCount('campaigns')
            ->withSum([
                'donations' => function ($query) {
                    $query->where('status', 'paid');
                }
            ], 'nominal')
            ->donatur()
            ->when($request->has('email') && $request->email != "", function ($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->orderBy('name');

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('name', function ($query) {
                return $query->name . '<br><a target="_blank" href="mailto:' . $query->email . '">' . $query->email . '</a>';
            })
            ->editColumn('path_image', function ($query) {
                if (!empty($query->path_image)) {
                    return '<img src="' . url(env('PATH_IMAGE_STORAGE') . $query->path_image) . '" class="img-thumbnail">';
                } else {
                    return '<img src="' . url(env('NO_IMAGE_SQUARE')) . '" class="img-thumbnail">';
                }
            })
            ->editColumn('campaigns_count', function ($query) {
                return amount_format_id($query->campaigns_count);
            })
            ->editColumn('donations_sum_nominal', function ($query) {
                return amount_format_id($query->donations_sum_nominal);
            })
            ->editColumn('created_at', function ($query) {
                return date_format_id($query->created_at);
            })
            ->addColumn('action', function ($query) {
                return '
                    <button onclick="editForm(`' . route('backend.donatur.show', $query->id) . '`)" class="btn btn-link text-primary"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-link text-danger" onclick="deleteData(`' . route('backend.donatur.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
