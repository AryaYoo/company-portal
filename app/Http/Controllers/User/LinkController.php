<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function index()
    {
        $categories = Category::whereIn('type', ['link', 'both'])->where('is_active', true)->orderBy('order')->get();
        return view('user.links.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $links = $category->links()->with('units')->where('is_active', true)->orderBy('order')->get();
        $categories = Category::whereIn('type', ['link', 'both'])->where('is_active', true)->orderBy('order')->get();
        return view('user.links.show', compact('category', 'links', 'categories'));
    }
}
