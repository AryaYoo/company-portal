@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold"><i class="bi bi-person-badge"></i> Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="text-muted fs-6">Explore the company's internal links and video tutorials here.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 80px; height: 80px;">
                            <i class="bi bi-link-45deg" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Internal Links</h5>
                    <p class="card-text text-muted mb-4">Quickly access all important company resources and tools.</p>
                    <a href="{{ route('user.links.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                        Browse Links <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle" style="width: 80px; height: 80px;">
                            <i class="bi bi-play-circle" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Video Tutorials</h5>
                    <p class="card-text text-muted mb-4">Watch guided tutorials and procedures provided by the team.</p>
                    <a href="{{ route('user.videos.index') }}" class="btn btn-outline-danger px-4 py-2 rounded-pill">
                        Watch Videos <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
