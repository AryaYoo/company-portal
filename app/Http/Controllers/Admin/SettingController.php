<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $loginWallpaper = Setting::get('login_wallpaper');
        $portalLogo = Setting::get('portal_logo');
        $portalName = Setting::get('portal_name', 'Portal RSIA IBI');
        return view('admin.settings.index', compact('loginWallpaper', 'portalLogo', 'portalName'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'login_wallpaper' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'portal_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'portal_name' => 'nullable|string|max:255',
        ]);

        if ($request->has('portal_name')) {
            Setting::set('portal_name', $request->portal_name);
        }

        if ($request->hasFile('login_wallpaper')) {
            $oldPath = Setting::get('login_wallpaper');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('login_wallpaper')->store('settings', 'public');
            Setting::set('login_wallpaper', $path);
        }

        if ($request->hasFile('portal_logo')) {
            $oldPath = Setting::get('portal_logo');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('portal_logo')->store('settings', 'public');
            Setting::set('portal_logo', $path);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
