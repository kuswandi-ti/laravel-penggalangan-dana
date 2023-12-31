<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Cashout;
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

        return view('backend.pages.campaign.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('backend.pages.campaign.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|min:8',
                'categories' => 'required|array',
                'short_description' => 'required|string|max:255',
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
                if (auth()->user()->hasRole('donatur')) {
                    return redirect()->route('frontend.donation.index')->with('success', 'Data Program berhasil ditambahkan.');
                }
                return redirect()->route('backend.campaign.index')->with('success', 'Data Program berhasil ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Data Program gagal ditambahkan.');
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

        return view('backend.pages.campaign.detail', compact(['campaign']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('backend.pages.campaign.edit', compact('campaign', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        try {
            $this->validate($request, [
                'title' => 'required|min:8',
                'categories' => 'required|array',
                'short_description' => 'required|string|max:255',
                'body' => 'required|min:8',
                'publish_date' => 'required|date_format:Y-m-d H:i',
                'status' => 'required|in:publish,pending,archieve',
                'goal' => 'required|numeric',
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

            if ($query) {
                $campaign->category_campaign()->sync($request->categories);
                if (auth()->user()->hasRole('donatur')) {
                    return redirect()->route('frontend.donation.index')->with('success', 'Data Program berhasil ditambahkan.');
                }
                return redirect()->route('backend.campaign.index')->with('success', 'Data Program berhasil diperbaharui.');
            } else {
                return redirect()->route('backend.campaign.index')->with('error', 'Data Program gagal diperbaharui.');
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
                if (!empty($query->path_image)) {
                    return '<img src="' . url(env('PATH_IMAGE_STORAGE') . $query->path_image) . '" class="img-thumbnail">';
                } else {
                    return '<img src="' . url(env('NO_IMAGE_SQUARE')) . '" class="img-thumbnail" style="width: 100px;">';
                }
            })
            ->editColumn('short_description', function ($query) {
                return '<strong>' . $query->title . '</strong>' . '<br><small>' . $query->short_description . '</small>';
            })
            ->editColumn('status', function ($query) {
                return '<span class="bagde badge-' . $query->status_color() . '">' . $query->status_text() . '</span>';
            })
            ->addColumn('author', function ($query) {
                return $query->user->name;
            })
            ->addColumn('action', function ($query) {
                return '
                    <a href="' . route('backend.campaign.detail', $query->id) . '" class="btn btn-link text-dark">
                        <i class="fas fa-search-plus"></i>
                    </a>
                    <a href="' . route('backend.campaign.edit', $query->id) . '" class="btn btn-link text-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-link text-danger"
                        onclick="deleteData(`' . route('backend.campaign.destroy', $query->id) . '`)">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['path_image', 'short_description', 'status', 'author', 'action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function update_status(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:publish,archieve,pending',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->only('status'));

        $statusText = "";
        if ($request->status == 'publish') {
            $statusText = 'dipublish';
        } elseif ($request->status == 'archieve') {
            $statusText = 'diarsipkan';
        }

        return response()->json(['data' => $campaign, 'message' => 'Data program berhasil ' . $statusText]);
    }

    public function cashout($id)
    {
        $campaign = Campaign::findOrFail($id)->load('donations', 'cashouts');

        if ($campaign->user_id != auth()->id()) {
            abort(404);
        }

        return view('backend.pages.campaign.cashout', compact('campaign'));
    }

    public function cashout_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required|exists:campaigns,id',
            'user_id' => 'required|exists:users,id',
            'bank_id' => 'required|exists:banks,id',
            'total' => 'required|integer',
            'cashout_amount' => 'required|regex:/^[0-9.]+$/',
            'cashout_fee' => 'required|regex:/^[0-9.]+$/',
            'amount_received' => 'required|regex:/^[0-9.]+$/',
            'remaining_amount' => 'required|regex:/^[0-9.]+$/'
        ], [
            'bank_id.required' => 'Silahkan lengkapi rekening tujuan terlebih dahulu.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attributes = $request->only('campaign_id', 'user_id', 'bank_id', 'total');
        $attributes['status'] = 'pending';
        foreach ($request->only('cashout_amount', 'cashout_fee', 'amount_received', 'remaining_amount') as $key => $value) {
            $attributes[$key] = str_replace('.', '', $value);
        }

        $cashout = Cashout::create($attributes);

        return response()->json([
            'data' => $cashout,
            'message' => 'Cashout berhasil dikirimkan, silahkan konfirmasi Admin untuk segera memproses request Anda.'
        ]);
    }
}
