<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('category')->orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::whereIn('type', ['video', 'both'])->where('is_active', true)->orderBy('order')->get();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_source' => 'required|in:upload,youtube',
            'video_file' => 'required_if:video_source,upload|nullable|mimes:mp4,avi,mov,mkv|max:102400', 
            'external_url' => 'required_if:video_source,youtube|nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('video_file')) {
            $validated['video_file'] = $request->file('video_file')->store('videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_public'] = $request->has('is_public');

        Video::create($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dibuat');
    }

    public function edit(Video $video)
    {
        $categories = Category::whereIn('type', ['video', 'both'])->where('is_active', true)->orderBy('order')->get();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_source' => 'required|in:upload,youtube',
            'video_file' => 'nullable|mimes:mp4,avi,mov,mkv|max:102400',
            'external_url' => 'required_if:video_source,youtube|nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('video_file')) {
            if ($video->video_file) {
                \Storage::disk('public')->delete($video->video_file);
            }
            $validated['video_file'] = $request->file('video_file')->store('videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) {
                \Storage::disk('public')->delete($video->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_public'] = $request->has('is_public');

        $video->update($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui');
    }

    public function destroy(Video $video)
    {
        if ($video->video_file) {
            \Storage::disk('public')->delete($video->video_file);
        }
        if ($video->thumbnail) {
            \Storage::disk('public')->delete($video->thumbnail);
        }
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus');
    }
}
