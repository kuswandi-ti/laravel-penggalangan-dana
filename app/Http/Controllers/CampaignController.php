<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        return view('campaign.index', compact('categories'));
    }

    public function data(Request $request)
    {
        $query = Campaign::orderBy('publish_date', 'DESC')
            ->when($request->has('statuscampaign') && $request->statuscampaign != "", function ($query) use ($request) {
                $query->where('status', $request->statuscampaign);
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
                    <button onclick="editForm(`' . route('campaign.show', $query->id) . '`)"
                        class="btn btn-link text-primary">
                        <i class="fas fa-edit"></i>
                    </button>
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:publish,pending,archieve',
            'goal' => 'required|integer',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'required|mimes:png,jpg,jpeg,bmp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->except('path_image', 'slug', 'categories', 'user_id');
        $data['slug'] = Str::slug($request->title);
        $data['path_image'] = upload('campaign', $request->file('path_image'), 'campaign');
        $data['user_id'] = auth()->id();

        $campaign = Campaign::create($data);

        $campaign = Campaign::orderBy('id', 'DESC')->first();
        $campaign->category_campaign()->attach($request->categories);

        return response()->json([
            'data' => $campaign,
            'message' => 'Projek berhasil ditambahkan.',
        ]);
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

        return view('campaign.detail', compact(['campaign']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:publish,pending,archieve',
            'goal' => 'required|integer',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'nullable|mimes:png,jpg,jpeg,bmp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->except('path_image', 'slug', 'categories', 'user_id');
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('path_image')) {
            if (!empty($campaign->path_image)) {
                if (Storage::disk('public')->exists($campaign->path_image)) {
                    Storage::disk('public')->delete($campaign->path_image);
                }
            }
            $data['path_image'] = upload('campaign', $request->file('path_image'), 'campaign');
        }
        $data['user_id'] = auth()->id();

        $campaign->update($data);

        $campaign->category_campaign()->sync($request->categories);

        return response()->json([
            'data' => $campaign,
            'message' => 'Projek berhasil diperbaharui.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        if (Storage::disk('public')->exists($campaign->path_image)) {
            Storage::disk('public')->delete($campaign->path_image);
        }

        $campaign->delete();

        return response()->json([
            'data' => null,
            'message' => 'Projek berhasil dihapus.',
        ]);
    }
}
