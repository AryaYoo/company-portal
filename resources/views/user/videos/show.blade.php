@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="d-flex border-bottom pb-4 mb-4 mt-2 justify-content-between align-items-end">
        <div>
            <a href="{{ route('user.videos.index') }}" class="btn btn-sm btn-light border rounded-pill mb-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Direktori
            </a>
            <h2 class="fw-bold mb-1"><i class="bi bi-collection-play text-danger me-2"></i> {{ $category->name }}</h2>
            @if($category->description)
                <p class="text-muted mb-0"><i class="bi bi-info-circle me-1"></i> {{ $category->description }}</p>
            @endif
        </div>
        <div class="d-none d-md-block text-end">
            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 fs-6">
                {{ $videos->count() }} Video
            </span>
        </div>
    </div>

    @if($videos->count() > 0)
        <div class="row g-4">
            @foreach($videos as $video)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('videos.play', $video) }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden video-card bg-dark text-white">
                            <div class="card-img-wrapper position-relative">
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-100 object-fit-cover" alt="{{ $video->title }}" style="height: 200px; opacity: 0.7;">
                                @else
                                    <div class="w-100 d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #2c3e50 0%, #000000 100%);">
                                        <i class="bi bi-play-circle text-white opacity-25" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class="bi bi-play-circle-fill text-white opacity-75 play-icon" style="font-size: 4rem;"></i>
                                </div>
                                @if($video->duration)
                                    <div class="position-absolute bottom-0 end-0 m-2">
                                        <span class="badge bg-dark bg-opacity-75 rounded-pill small">
                                            {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-3 text-center">
                                <h6 class="card-title fw-bold mb-1 text-truncate">{{ $video->title }}</h6>
                                <p class="small text-white-50 mb-0 text-truncate">{{ $video->description ?: 'Tonton Video' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-light">
            <div class="card-body">
                <i class="bi bi-camera-video-off fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-medium text-dark">Video Tidak Ditemukan</h5>
                <p class="text-muted mb-0">Belum ada video di dalam kategori ini.</p>
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
        box-shadow: 0 10px 25px rgba(0,0,0,0.3) !important;
    }
    .video-card:hover .play-icon {
        opacity: 1 !important;
        transform: scale(1.1);
    }
    .play-icon {
        transition: all 0.2s ease-in-out;
    }
</style>
@endpush
