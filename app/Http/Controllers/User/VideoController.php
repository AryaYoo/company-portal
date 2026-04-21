<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        return view('user.videos.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $videos = $category->videos()->where('is_active', true)->orderBy('order')->get();
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        return view('user.videos.show', compact('category', 'videos', 'categories'));
    }

    public function play(Video $video)
    {
        if (!$video->is_public && !auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to watch this video.');
        }
        return view('user.videos.play', compact('video'));
    }
}
