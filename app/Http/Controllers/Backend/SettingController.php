<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        $bank = Bank::all()->pluck('name', 'id');
        $banner = Banner::all();
        $bank_setting = DB::table('bank_settings')->get();
        return view('backend.pages.setting.index', compact(['setting', 'bank', 'banner', 'bank_setting']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        // Rules General
        $rules = [
            'owner_name' => 'required',
            'company_name' => 'required',
            'business_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'short_description' => 'required',
            'keyword' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'province' => 'required',
            'contact_person_path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ];

        // Rules Image
        if ($request->has('tab') && $request->tab == 'image') {
            $rules = [
                'path_image_logo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            ];
        }

        // Rules Social Media
        if ($request->has('tab') && $request->tab == 'social_media') {
            $rules = [
                'instagram_link' => 'nullable|url',
                'twitter_link' => 'nullable|url',
                'fanpage_link' => 'nullable|url',
                'google_plus_link' => 'nullable|url',
                'youtube_link' => 'nullable|url',
                'facebook_link' => 'nullable|url',
            ];
        }

        // Rules Bank
        if ($request->has('tab') && $request->tab == 'bank') {
            $rules = [
                'bank_id' => 'required|exists:banks,id|unique:bank_settings,bank_id',
                'account_number' => 'required|unique:bank_settings,account_number',
                'account_name' => 'required',
            ];
        }

        // Rules Validation
        $this->validate($request, $rules);

        // Set Data
        $data = $request->except([
            'tab',
            'contact_person_path_image',
            'path_image_logo',
            'path_image_business',
            'bank_id',
            'account_number',
            'account_name',
            'banner_title',
            'banner_description',
            'banner_image',
        ]);

        // Path Contact Person Image
        if ($request->hasFile('contact_person_path_image')) {
            if (!empty($setting->contact_person_path_image)) {
                if (Storage::disk('public')->exists($setting->contact_person_path_image)) {
                    Storage::disk('public')->delete($setting->contact_person_path_image);
                }
            }
            $data['contact_person_path_image'] = upload('images/contact_person', $request->file('contact_person_path_image'), 'contact_person');
        }

        // Path Image Logo
        if ($request->hasFile('path_image_logo')) {
            if (!empty($setting->path_image_logo)) {
                if (Storage::disk('public')->exists($setting->path_image_logo)) {
                    Storage::disk('public')->delete($setting->path_image_logo);
                }
            }
            $data['path_image_logo'] = upload('images/setting', $request->file('path_image_logo'), 'logo');
        }

        // Path Image Business
        if ($request->hasFile('path_image_business')) {
            if (!empty($setting->path_image_business)) {
                if (Storage::disk('public')->exists($setting->path_image_business)) {
                    Storage::disk('public')->delete($setting->path_image_business);
                }
            }
            $data['path_image_business'] = upload('images/business', $request->file('path_image_business'), 'business');
        }

        // Update Data
        $query = $setting->update($data);

        if ($query) {
            // Table Bank
            if ($request->has('tab') && $request->tab == 'bank') {
                $setting->bank_settings()->attach($request->bank_id, $request->only('account_number', 'account_name'));
            }

            return redirect()->back()->with('success', 'Data Setting berhasil diupdate.');
        }
    }

    public function bank_destroy(Setting $setting, $id)
    {
        $setting->bank_settings()->detach($id);

        return redirect()->back()->with('success', 'Data Bank Terdaftar berhasil diperbaharui.');
    }
}
