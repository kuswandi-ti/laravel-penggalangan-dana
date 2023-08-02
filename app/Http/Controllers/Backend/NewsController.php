<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|min:8',
                'body' => 'required|min:8',
                'path_image' => 'required|mimes:png,jpg,jpeg,bmp|max:2048',
            ]);

            $data = $request->except('path_image', 'user_id');
            $data['path_image'] = upload('images/news', $request->file('path_image'), 'news');
            $data['user_id'] = auth()->id();

            $news = News::create($data);

            if ($news) {
                $news = News::orderBy('id', 'DESC')->first();
                return redirect()->route('backend.news.index')->with('success', 'Data Berita berhasil ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Data Berita gagal ditambahkan.');
            }
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        } catch (QueryException $qe) {
            return back()->withError($qe->getMessage());
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
    public function edit(News $news)
    {
        return view('backend.pages.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        try {
            $this->validate($request, [
                'title' => 'required|min:8',
                'body' => 'required|min:8',
                'path_image' => 'nullable|mimes:png,jpg,jpeg,bmp|max:2048',
            ]);

            $data = $request->except('path_image', 'user_id');
            $data['user_id'] = auth()->id();

            if ($request->hasFile('path_image')) {
                if (!empty($news->path_image)) {
                    if (Storage::disk('public')->exists($news->path_image)) {
                        Storage::disk('public')->delete($news->path_image);
                    }
                }
                $data['path_image'] = upload('images/news', $request->file('path_image'), 'news');
            }

            $query = $news->update($data);

            if ($query) {
                return redirect()->route('backend.news.index')->with('success', 'Data Berita berhasil diperbaharui.');
            } else {
                return redirect()->route('backend.news.index')->with('error', 'Data Berita gagal diperbaharui.');
            }
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        } catch (QueryException $qe) {
            return back()->withError($qe->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            $query = $news->delete();
            if (Storage::disk('public')->exists($news->path_image)) {
                Storage::disk('public')->delete($news->path_image);
            }
            return response()->json([
                'data' => null,
                'message' => 'Data Berita berhasil dihapus.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Proses hapus data gagal !!!'
            ], 500);
        }
    }

    public function data()
    {
        $query = News::orderBy('created_at', 'DESC');
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('path_image', function ($query) {
                if (!empty($query->path_image)) {
                    return '<img src="' . url(env('PATH_IMAGE_STORAGE') . $query->path_image) . '" class="img-thumbnail">';
                } else {
                    return '<img src="' . url(env('NO_IMAGE_SQUARE')) . '" class="img-thumbnail" style="width: 100px;">';
                }
            })
            ->editColumn('body', function ($query) {
                return Str::limit($query->body, 300, ' ...');
            })
            ->editColumn('created_at', function ($query) {
                return date_format_id($query->created_at, true, false);
            })
            ->addColumn('author', function ($query) {
                return $query->user->name;
            })
            ->addColumn('action', function ($query) {
                return '
                    <a href="' . route('backend.news.edit', $query->id) . '" class="btn btn-link text-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-link text-danger"
                        onclick="deleteData(`' . route('backend.news.destroy', $query->id) . '`)">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['path_image', 'author', 'action'])
            ->escapeColumns([])
            ->make(true);
    }
}
