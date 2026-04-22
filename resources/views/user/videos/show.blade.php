@extends('layouts.app')

@section('title', $category->name . ' - Videos')

@section('content')
    <div class="d-flex border-bottom pb-4 mb-4 mt-2 justify-content-between align-items-end">
        <div>
            <a href="{{ route('user.videos.index') }}" class="btn btn-sm btn-light border rounded-pill mb-3">
                <i class="bi bi-arrow-left me-1"></i> Back to Categories
            </a>
            <h2 class="fw-bold mb-1"><i class="bi bi-collection-play text-danger me-2"></i> {{ $category->name }}</h2>
            @if($category->description)
                <p class="text-muted mb-0"><i class="bi bi-info-circle me-1"></i> {{ $category->description }}</p>
            @endif
        </div>
        <div class="d-none d-md-block text-end">
            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 fs-6">
                {{ $videos->count() }} Video(s)
            </span>
        </div>
    </div>

    @if($videos->count() > 0)
        <div class="row g-4">
            @foreach($videos as $video)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden video-card">
                        <div class="card-img-wrapper position-relative bg-dark">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-100 object-fit-cover" alt="{{ $video->title }}" style="height: 180px; opacity: 0.85;">
                            @else
                                <div class="w-100 d-flex align-items-center justify-content-center" style="height: 180px; background: linear-gradient(135deg, #2c3e50 0%, #000000 100%);">
                                    <i class="bi bi-play-circle text-white opacity-25" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <a href="{{ route('videos.play', $video) }}" class="btn btn-danger rounded-circle shadow p-3 play-btn-main">
                                    <i class="bi bi-play-fill fs-3 text-white"></i>
                                </a>
                            </div>
                            @if($video->duration)
                                <div class="position-absolute bottom-0 end-0 m-2">
                                    <span class="badge bg-dark bg-opacity-75 rounded-pill small">
                                        <i class="bi bi-clock me-1"></i> {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $video->title }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ $video->description ? Str::limit($video->description, 90) : 'No description provided.' }}
                            </p>
                            <div class="d-grid mt-3">
                                <a href="{{ route('videos.play', $video) }}" class="btn btn-outline-danger rounded-pill">
                                    Watch Tutorial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-light">
            <div class="card-body">
                <i class="bi bi-camera-video-off fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-medium text-dark">No Videos Found</h5>
                <p class="text-muted mb-0">There are no videos in this category currently.</p>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .video-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .card-img-wrapper {
        position: relative;
    }
    .card-img-wrapper .overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .card-img-wrapper:hover .overlay {
        opacity: 1;
    }
    .play-btn-main {
        transform: scale(0.5);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .card-img-wrapper:hover .play-btn-main {
        transform: scale(1);
    }
</style>
@endpush
