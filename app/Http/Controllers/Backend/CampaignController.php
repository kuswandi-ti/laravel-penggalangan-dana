<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('backend.campaign.index', compact('categories'));
    }

    public function data(Request $request)
    {
        $query = Campaign::orderBy('publish_date', 'DESC')
            ->when($request->has('statuscampaign') && $request->statuscampaign != "", function ($query) use ($request) {
                $query->where('status', $request->statuscampaign);
            })
            ->when($request->has('status') && $request->status != "", function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when(
                $request->has('startdate') && $request->startdate != "" &&
                    $request->has('enddate') && $request->enddate != "",
                function ($query) use ($request) {
                    $query->whereBetween('publish_date', $request->only('startdate', 'enddate'));
                }
            );

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('path_image', function ($query) {
                return '<img src="' . Storage::disk('public')->url($query->path_image) . '" class="img-thumbnail">';
            })
            ->editColumn('short_description', function ($query) {
                return '<strong>' . $query->title . '</strong>' . '<br><small>' . $query->short_description . '</small>';
            })
            ->editColumn('status', function ($query) {
                return '<span class="bagde badge-' . $query->status_color() . '">' . $query->status . '</span>';
            })
            ->addColumn('author', function ($query) {
                return $query->user->name;
            })
            ->addColumn('action', function ($query) {
                return '
                    <a href="' . route('campaign.detail', $query->id) . '" class="btn btn-link text-dark">
                        <i class="fas fa-search-plus"></i>
                    </a>
                    <a href="' . route('campaign.edit', $query->id) . '" class="btn btn-link text-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-link text-danger"
                        onclick="deleteData(`' . route('campaign.destroy', $query->id) . '`)">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['path_image', 'short_description', 'status', 'author', 'action'])
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('backend.campaign.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        $this->validate($request, [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required|max:255',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:publish,pending,archieve',
            'goal' => 'required|integer',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'required|mimes:png,jpg,jpeg,bmp|max:2048',
        ]);

        $data = $request->except('path_image', 'slug', 'categories', 'user_id');
        $data['slug'] = Str::slug($request->title);
        $data['path_image'] = upload('images/campaign', $request->file('path_image'), 'campaign');
        $data['user_id'] = auth()->id();

        $campaign = Campaign::create($data);

        if ($campaign) {
            $campaign = Campaign::orderBy('id', 'DESC')->first();
            $campaign->category_campaign()->attach($request->categories);
            return redirect()->route('campaign.index')->with('success', 'Data Program berhasil ditambahkan.');
        } else {
            return redirect()->route('campaign.index')->with('error', 'Data Program gagal ditambahkan.');
        }
        // } catch (Exception $e) {
        //     return back()->withError($e->getMessage())->withInput();
        // } catch (QueryException $qe) {
        //     return back()->withError($qe->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        $campaign->publish_date = date('Y-m-d H:i', strtotime($campaign->publish_date));
        $campaign->end_date = date('Y-m-d H:i', strtotime($campaign->end_date));
        $campaign->categories = $campaign->category_campaign;

        return response()->json([
            'data' => $campaign,
        ]);
    }

    public function detail($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('backend.campaign.detail', compact(['campaign']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('backend.campaign.edit', compact('campaign', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        // try {
        $this->validate($request, [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required|max:255',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:publish,pending,archieve',
            'goal' => 'required|integer',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'nullable|mimes:png,jpg,jpeg,bmp|max:2048',
        ]);

        $data = $request->except('path_image', 'slug', 'categories', 'user_id');
        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('path_image')) {
            if (!empty($campaign->path_image)) {
                if (Storage::disk('public')->exists($campaign->path_image)) {
                    Storage::disk('public')->delete($campaign->path_image);
                }
            }
            $data['path_image'] = upload('images/campaign', $request->file('path_image'), 'campaign');
        }

        $query = $campaign->update($data);

        if ($campaign) {
            $campaign->category_campaign()->sync($request->categories);
            return redirect()->route('campaign.index')->with('success', 'Data Program berhasil diperbaharui.');
        } else {
            return redirect()->route('campaign.index')->with('error', 'Data Program gagal diperbaharui.');
        }
        // } catch (Exception $e) {
        //     return back()->withError($e->getMessage())->withInput();
        // } catch (QueryException $qe) {
        //     return back()->withError($qe->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        try {
            $detach = $campaign->category_campaign()->detach();
            if ($detach) {
                $query = $campaign->delete();
                if ($query) {
                    if (Storage::disk('public')->exists($campaign->path_image)) {
                        Storage::disk('public')->delete($campaign->path_image);
                    }
                    return response()->json([
                        'data' => null,
                        'message' => 'Data Program berhasil dihapus.',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data Program gagal dihapus.'
                    ], 500);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Program - Kategori gagal dihapus.'
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Proses hapus data gagal !!!'
            ], 500);
        }
    }
}
