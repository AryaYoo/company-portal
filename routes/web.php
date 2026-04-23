<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LinkController as AdminLinkController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\LinkController as UserLinkController;
use App\Http\Controllers\User\VideoController as UserVideoController;
use App\Models\Link;
use App\Models\Video;
use App\Models\Setting;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    $publicLinks = Link::with('category')->where('is_active', true)->where('is_public', true)->orderBy('order')->get();
    $publicVideos = Video::with('category')->where('is_active', true)->where('is_public', true)->orderBy('order')->get();
    
    $groupedLinks = $publicLinks->groupBy(function($item) {
        return $item->category ? $item->category->name : 'Uncategorized';
    });
    
    $groupedVideos = $publicVideos->groupBy(function($item) {
        return $item->category ? $item->category->name : 'Uncategorized';
    });

    $loginWallpaper = Setting::get('login_wallpaper');
    return view('auth.login', compact('groupedLinks', 'groupedVideos', 'loginWallpaper'));
})->middleware('guest')->name('login');

Route::post('/login', function () {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, request('remember'))) {
        request()->session()->regenerate();
        return redirect()->intended(auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->middleware('guest')->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', function () {
    $validated = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'user',
    ]);

    Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']]);
    return redirect()->route('user.dashboard');
})->middleware('guest')->name('register.post');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Categories Management
        Route::resource('categories', CategoryController::class)->except(['show']);
        
        // Links Management
        Route::resource('links', AdminLinkController::class)->except(['show']);
        
        // Videos Management
        Route::resource('videos', AdminVideoController::class)->except(['show']);

        // System Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Unit Management
        Route::resource('units', UnitController::class)->except(['show', 'create', 'edit']);
    });

    // User Routes
    Route::middleware('user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        
        // Links View
        Route::get('/links', [UserLinkController::class, 'index'])->name('links.index');
        Route::get('/links/{category}', [UserLinkController::class, 'show'])->name('links.show');
        
        // Videos View
        Route::get('/videos', [UserVideoController::class, 'index'])->name('videos.index');
        Route::get('/videos/category/{category}', [UserVideoController::class, 'show'])->name('videos.show');
    });

});

// Public/Guest allowed Play Route (Handled in Controller)
Route::get('/videos/{video}/play', [UserVideoController::class, 'play'])->name('videos.play');

