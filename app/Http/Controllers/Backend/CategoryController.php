<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

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
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //try {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('path_image')) {
            $data['path_image'] = upload('images/category', $request->file('path_image'), 'category');
        }

        $query = Category::create($data);

        if ($query) {
            return redirect()->route('backend.category.index')->with('success', 'Data Kategori berhasil ditambahkan.');
        } else {
            return redirect()->route('backend.category.index')->with('error', 'Data Kategori gagal ditambahkan.');
        }
        // } catch (Exception $e) {
        //     return back()->withError($e->getMessage)->withInput();
        // } catch (QueryException $qe) {
        //     return back()->withError($qe->getMessage());
        // }
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
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // try {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id,
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('path_image')) {
            if (!empty($category->path_image)) {
                if (Storage::disk('public')->exists($category->path_image)) {
                    Storage::disk('public')->delete($category->path_image);
                }
            }
            $data['path_image'] = upload('images/category', $request->file('path_image'), 'category');
        }

        $category->update($data); // $category didapat dari parameter di fungsi update()

        return redirect()->route('backend.category.index')->with('success', 'Data Kategori berhasil diupdate.');
        // } catch (Exception $e) {
        //     return back()->withError($e->getMessage)->withInput();
        // } catch (QueryException $qe) {
        //     return back()->withError($qe->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //    try {
        $category->delete();

        return redirect()->route('backend.category.index')->with('success', 'Data Kategori berhasil dihapus.');
        // } catch (Exception $e) {
        //     return back()->withError($e->getMessage)->withInput();
        // } catch (QueryException $qe) {
        //     return back()->withError($qe->getMessage());
        // }
    }
}
