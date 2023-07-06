<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'desc')
            ->when($request->has('keyword') && $request->keyword != "", function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate($request->per_page ?? env('CUSTOM_PAGING'))
            ->appends($request->only('per_page', 'keyword'));
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:categories,name'
            ]);

            $data = $request->only('name');
            $data['slug'] = Str::slug($request->name);

            $query = Category::create($data);

            if ($query) {
                return redirect()->route('category.index')->with('success', 'Data Kategori berhasil ditambahkan.');
            } else {
                return redirect()->route('category.index')->with('error', 'Data Kategori gagal ditambahkan.');
            }
        } catch (Exception $e) {
            return back()->withError($e->getMessage)->withInput();
        } catch (QueryException $qe) {
            return back()->withError($qe->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        $category->update($data); // $category didapat dari parameter di fungsi update()

        return redirect()->route('category.index')->with('success', 'Data Kategori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Data Kategori berhasil dihapus.');
    }
}
