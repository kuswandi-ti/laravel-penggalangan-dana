<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banks = Bank::orderBy('id', 'desc')
            ->when($request->has('keyword') && $request->keyword != "", function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate($request->per_page ?? env('CUSTOM_PAGING'))
            ->appends($request->only('per_page', 'keyword'));
        return view('backend.bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:banks,code',
            'name' => 'required',
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only('code', 'name');
        $data['path_image'] = upload('images/bank', $request->file('path_image'), 'bank');

        $query = Bank::create($data);

        if ($query) {
            return redirect()->route('bank.index')->with('success', 'Data Bank berhasil ditambahkan.');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data Bank gagal ditambahkan.');
        }
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
    public function edit(Bank $bank)
    {
        return view('backend.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $this->validate($request, [
            'code' => 'required|unique:banks,code,' . $bank->id,
            'name' => 'required',
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only('code', 'name');

        if ($request->hasFile('path_image')) {
            if (!empty($bank->path_image)) {
                if (Storage::disk('public')->exists($bank->path_image)) {
                    Storage::disk('public')->delete($bank->path_image);
                }
            }
            $data['path_image'] = upload('images/bank', $request->file('path_image'), 'bank');
        }

        $query = $bank->update($data); // $bank didapat dari parameter di fungsi update()

        if ($query) {
            return redirect()->route('bank.index')->with('success', 'Data Bank berhasil diupdate.');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data Bank gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        $query = $bank->delete();

        if ($query) {
            if (!empty($bank->path_image)) {
                if (Storage::disk('public')->exists($bank->path_image)) {
                    Storage::disk('public')->delete($bank->path_image);
                }
            }
            return redirect()->route('bank.index')->with('success', 'Data Bank berhasil dihapus.');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data Bank gagal dihapus.');
        }
    }
}
