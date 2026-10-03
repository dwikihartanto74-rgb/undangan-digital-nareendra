<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvitationSetting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = InvitationSetting::first() ?? new InvitationSetting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = InvitationSetting::first();
        if (!$setting) {
            $setting = new InvitationSetting();
        }

        $data = $request->except(['_token', 'cover_image', 'baby_photo', 'music_file']);

        if ($request->hasFile('cover_image')) {
            if ($setting->cover_image) Storage::disk('public')->delete($setting->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('uploads', 'public');
        }

        if ($request->hasFile('baby_photo')) {
            if ($setting->baby_photo) Storage::disk('public')->delete($setting->baby_photo);
            $data['baby_photo'] = $request->file('baby_photo')->store('uploads', 'public');
        }

        if ($request->hasFile('music_file')) {
            if ($setting->music_file) Storage::disk('public')->delete($setting->music_file);
            $data['music_file'] = $request->file('music_file')->store('uploads', 'public');
        }

        $setting->fill($data)->save();

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}
