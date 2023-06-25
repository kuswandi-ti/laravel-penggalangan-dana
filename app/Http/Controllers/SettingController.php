<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact(['setting']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
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

        if ($request->has('tab') && $request->tab == 'logo') {
            $rules = [
                'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
                'path_image_header' => 'nullable|mimes:png,jpg,jpeg|max:2048',
                'path_image_footer' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            ];
        }

        $this->validate($request, $rules);

        $data = $request->except('path_image', 'path_image_header', 'path_image_footer', 'tab');

        if ($request->hasFile('path_image')) {
            if (!empty($setting->path_image)) {
                if (Storage::disk('public')->exists($setting->path_image)) {
                    Storage::disk('public')->delete($setting->path_image);
                }
            }
            $data['path_image'] = upload('setting', $request->file('path_image'), 'setting_favicon');
        }

        if ($request->hasFile('path_image_header')) {
            if (!empty($setting->path_image_header)) {
                if (Storage::disk('public')->exists($setting->path_image_header)) {
                    Storage::disk('public')->delete($setting->path_image_header);
                }
            }
            $data['path_image_header'] = upload('setting', $request->file('path_image_header'), 'setting_image_header');
        }

        if ($request->hasFile('path_image_footer')) {
            if (!empty($setting->path_image_footer)) {
                if (Storage::disk('public')->exists($setting->path_image_footer)) {
                    Storage::disk('public')->delete($setting->path_image_footer);
                }
            }
            $data['path_image_footer'] = upload('setting', $request->file('path_image_footer'), 'setting_image_footer');
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Data Setting berhasil diupdate.');
    }
}
