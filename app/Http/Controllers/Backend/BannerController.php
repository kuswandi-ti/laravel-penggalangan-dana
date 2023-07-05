<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banners = Banner::orderBy('id', 'desc')
            ->when($request->has('keyword') && $request->keyword != "", function ($query) use ($request) {
                $query->where('banner_title', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate($request->per_page ?? env('CUSTOM_PAGING'))
            ->appends($request->only('per_page', 'keyword'));
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'banner_title' => 'required|unique:banners,banner_title',
            'banner_description' => 'required',
            'banner_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only('banner_title', 'banner_description');
        $data['banner_image'] = upload('images/banner', $request->file('banner_image'), 'banner');

        $query = Banner::create($data);

        if ($query) {
            return redirect()->route('banner.index')->with('success', 'Data Banner berhasil ditambahkan.');
        } else {
            return redirect()->route('banner.index')->with('error', 'Data Banner gagal ditambahkan.');
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
    public function edit(Banner $banner)
    {
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'banner_title' => 'required|unique:banners,banner_title,' . $banner->id,
            'banner_description' => 'required',
            'banner_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only('banner_title', 'banner_description');

        if ($request->hasFile('banner_image')) {
            if (!empty($banner->banner_image)) {
                if (Storage::disk('public')->exists($banner->banner_image)) {
                    Storage::disk('public')->delete($banner->banner_image);
                }
            }
            $data['banner_image'] = upload('images/banner', $request->file('banner_image'), 'banner');
        }

        $query = $banner->update($data); // $banner didapat dari parameter di fungsi update()

        if ($query) {
            return redirect()->route('banner.index')->with('success', 'Data Banner berhasil diupdate.');
        } else {
            return redirect()->route('banner.index')->with('error', 'Data Banner gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $query = $banner->delete();

        if ($query) {
            if (!empty($banner->banner_image)) {
                if (Storage::disk('public')->exists($banner->banner_image)) {
                    Storage::disk('public')->delete($banner->banner_image);
                }
            }
            return redirect()->route('banner.index')->with('success', 'Data Banner berhasil dihapus.');
        } else {
            return redirect()->route('banner.index')->with('error', 'Data Banner gagal dihapus.');
        }
    }
}
