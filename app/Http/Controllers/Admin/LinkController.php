<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use App\Models\Category;
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
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        return view('admin.links.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('links', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_public'] = $request->has('is_public');

        Link::create($validated);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil dibuat');
    }

    public function edit(Link $link)
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        return view('admin.links.edit', compact('link', 'categories'));
    }

    public function update(Request $request, Link $link)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($link->cover_image) {
                \Storage::disk('public')->delete($link->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('links', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_public'] = $request->has('is_public');

        $link->update($validated);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil diperbarui');
    }

    public function destroy(Link $link)
    {
        if ($link->cover_image) {
            \Storage::disk('public')->delete($link->cover_image);
        }
        $link->delete();
        return redirect()->route('admin.links.index')->with('success', 'Link berhasil dihapus');
    }
}
