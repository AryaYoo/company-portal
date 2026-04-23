<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::with('category')->orderBy('order')->get();
        return view('admin.links.index', compact('links'));
    }

    public function create()
    {
        $categories = Category::whereIn('type', ['link', 'both'])->where('is_active', true)->orderBy('order')->get();
        $units = Unit::orderBy('name')->get();
        return view('admin.links.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
            'units' => 'nullable|array',
            'units.*' => 'exists:units,id',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('links/icons', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('links/banners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_public'] = $request->has('is_public');

        $link = Link::create($validated);

        if ($request->has('units')) {
            $link->units()->sync($request->units);
        }

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil dibuat');
    }

    public function edit(Link $link)
    {
        $categories = Category::whereIn('type', ['link', 'both'])->where('is_active', true)->orderBy('order')->get();
        $units = Unit::orderBy('name')->get();
        return view('admin.links.edit', compact('link', 'categories', 'units'));
    }

    public function update(Request $request, Link $link)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
            'units' => 'nullable|array',
            'units.*' => 'exists:units,id',
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($link->cover_image) {
                \Storage::disk('public')->delete($link->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('links/icons', 'public');
        }

        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($link->banner_image) {
                \Storage::disk('public')->delete($link->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('links/banners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_public'] = $request->has('is_public');

        $link->update($validated);
        
        $link->units()->sync($request->units ?? []);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil diperbarui');
    }

    public function destroy(Link $link)
    {
        if ($link->cover_image) {
            \Storage::disk('public')->delete($link->cover_image);
        }
        if ($link->banner_image) {
            \Storage::disk('public')->delete($link->banner_image);
        }
        $link->delete();
        return redirect()->route('admin.links.index')->with('success', 'Link berhasil dihapus');
    }
}
