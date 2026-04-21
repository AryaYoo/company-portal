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
        return view('admin.settings.index', compact('loginWallpaper'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'login_wallpaper' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('login_wallpaper')) {
            // Delete old wallpaper if exists
            $oldPath = Setting::get('login_wallpaper');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('login_wallpaper')->store('settings', 'public');
            Setting::set('login_wallpaper', $path);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
