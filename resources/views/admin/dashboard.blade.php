@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold"><i class="bi bi-speedometer2"></i> Admin Overview</h2>
        <p class="text-muted">Manage all portal contents and monitor user access.</p>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 border-start border-primary border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.85rem;">Total Categories</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ \App\Models\Category::count() }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                            <i class="bi bi-tags-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 border-start border-success border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.85rem;">Total Links</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ \App\Models\Link::count() }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success rounded p-3">
                            <i class="bi bi-link-45deg fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 border-start border-danger border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.85rem;">Total Videos</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ \App\Models\Video::count() }}</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 text-danger rounded p-3">
                            <i class="bi bi-play-btn-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 border-start border-info border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.85rem;">Registered Users</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 text-info rounded p-3">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Items -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom-0 pb-0">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-clock-history text-primary me-2"></i> Recent Categories</h5>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
                </div>
                <div class="card-body pt-3">
                    @php
                        $recentCategories = \App\Models\Category::latest()->limit(5)->get();
                    @endphp
                    @if($recentCategories->count() > 0)
                        <div class="list-group list-group-flush rounded border overflow-hidden">
                            @foreach($recentCategories as $category)
                                <a href="{{ route('admin.categories.edit', $category) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 px-4">
                                    <div>
                                        <h6 class="mb-1 text-dark fw-semibold">{{ $category->name }}</h6>
                                        <small class="text-muted">Added {{ $category->created_at->diffForHumans() }}</small>
                                    </div>
                                    <span class="badge {{ $category->is_active ? 'bg-success text-white' : 'bg-secondary text-white' }} rounded-pill px-3 py-2">
                                        <i class="bi {{ $category->is_active ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center p-5 text-muted border rounded bg-light">
                            <i class="bi bi-folder-x fs-1 mb-3 d-block text-black-50"></i>
                            <p class="mb-0">No categories found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom-0 pb-0">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-clock-history text-success me-2"></i> Recent Links</h5>
                    <a href="{{ route('admin.links.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">View All</a>
                </div>
                <div class="card-body pt-3">
                    @php
                        $recentLinks = \App\Models\Link::latest()->limit(5)->get();
                    @endphp
                    @if($recentLinks->count() > 0)
                        <div class="list-group list-group-flush rounded border overflow-hidden">
                            @foreach($recentLinks as $link)
                                <a href="{{ route('admin.links.edit', $link) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 px-4">
                                    <div>
                                        <h6 class="mb-1 text-dark fw-semibold">{{ $link->title }}</h6>
                                        <small class="text-muted"><i class="bi bi-link-45deg"></i> {{ Str::limit($link->url, 30) }}</small>
                                    </div>
                                    <span class="badge {{ $link->is_active ? 'bg-success text-white' : 'bg-secondary text-white' }} rounded-pill px-3 py-2">
                                        <i class="bi {{ $link->is_active ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                                        {{ $link->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center p-5 text-muted border rounded bg-light">
                            <i class="bi bi-link-45deg fs-1 mb-3 d-block text-black-50"></i>
                            <p class="mb-0">No links found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
