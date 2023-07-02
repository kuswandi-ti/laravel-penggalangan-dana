<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Http\Request;
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
        $banner = Banner::first();
        return view('backend.setting.index', compact(['setting', 'bank', 'banner']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        // Rules General
        $rules = [
            'email' => 'required|email',
            'owner_name' => 'required',
            'company_name' => 'required',
            'short_description' => 'required',
            'keyword' => 'required',
            'phone' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'province' => 'required',
        ];

        // Rules Image
        if ($request->has('tab') && $request->tab == 'image') {
            $rules = [
                // 'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
                // 'path_image_header' => 'nullable|mimes:png,jpg,jpeg|max:2048',
                // 'path_image_footer' => 'nullable|mimes:png,jpg,jpeg|max:2048',
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

        // Rules Banner
        if ($request->has('tab') && $request->tab == 'banner') {
            $rules = [
                'banner_title' => 'required',
                'banner_description' => 'required'
            ];
        }

        // Rules Validation
        $this->validate($request, $rules);

        // Set Data
        // $data = $request->except('path_image', 'path_image_header', 'path_image_footer', 'tab', 'bank_id', 'account_number', 'account_name');
        $data = $request->except('tab', 'path_image_logo', 'bank_id', 'account_number', 'account_name', 'banner_title', 'banner_description', 'banner_image');

        // Path Image Logo
        if ($request->hasFile('path_image_logo')) {
            if (!empty($setting->path_image)) {
                if (Storage::disk('public')->exists($setting->path_image_logo)) {
                    Storage::disk('public')->delete($setting->path_image_logo);
                }
            }
            $data['path_image_logo'] = upload('images/setting', $request->file('path_image_logo'), 'logo');
        }

        // if ($request->hasFile('path_image')) {
        //     if (!empty($setting->path_image)) {
        //         if (Storage::disk('public')->exists($setting->path_image)) {
        //             Storage::disk('public')->delete($setting->path_image);
        //         }
        //     }
        //     $data['path_image'] = upload('setting', $request->file('path_image'), 'setting_favicon');
        // }

        // if ($request->hasFile('path_image_header')) {
        //     if (!empty($setting->path_image_header)) {
        //         if (Storage::disk('public')->exists($setting->path_image_header)) {
        //             Storage::disk('public')->delete($setting->path_image_header);
        //         }
        //     }
        //     $data['path_image_header'] = upload('setting', $request->file('path_image_header'), 'setting_image_header');
        // }

        // if ($request->hasFile('path_image_footer')) {
        //     if (!empty($setting->path_image_footer)) {
        //         if (Storage::disk('public')->exists($setting->path_image_footer)) {
        //             Storage::disk('public')->delete($setting->path_image_footer);
        //         }
        //     }
        //     $data['path_image_footer'] = upload('setting', $request->file('path_image_footer'), 'setting_image_footer');
        // }

        // Update Data
        $setting->update($data);

        // Table Bank
        if ($request->has('tab') && $request->tab == 'bank') {
            $setting->bank_settings()->attach($request->bank_id, $request->only('account_number', 'account_name'));
        }

        // Action Banner
        if ($request->has('tab') && $request->tab == 'banner') {
            $data = [
                'banner_title' => $request->banner_title,
                'banner_description' => $request->banner_description,
            ];

            $banner = Banner::first();
            if ($request->hasFile('banner_image')) {
                if (!empty($banner->banner_image)) {
                    if (Storage::disk('public')->exists($banner->banner_image)) {
                        Storage::disk('public')->delete($banner->banner_image);
                    }
                }
                $data['banner_image'] = upload('images/banner', $request->file('banner_image'), 'banner');
            }
            if ($banner !== null) {
                $banner->update($data);
            } else {
                Banner::create($data);
            }
        }

        return redirect()->back()->with('success', 'Data Setting berhasil diupdate.');
    }

    public function bank_destroy(Setting $setting, $id)
    {
        $setting->bank_settings()->detach($id);

        return redirect()->back()->with('success', 'Data Bank Terdaftar berhasil diperbaharui.');
    }
}
