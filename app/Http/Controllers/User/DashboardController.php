<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $allLinks = Link::with(['category', 'units'])->where('is_active', true)->get();
        return view('user.dashboard', compact('allLinks'));
    }
}
