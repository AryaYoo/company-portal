@extends('layouts.app')

@section('title', 'Playing: ' . $video->title)

@section('content')
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <a href="{{ route('user.videos.show', $video->category) }}" class="btn btn-sm btn-light border rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to {{ $video->category->name }}
        </a>
        <div class="d-none d-md-block">
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                <i class="bi bi-tag-fill me-1 text-primary"></i> {{ $video->category->name }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Video Player Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 bg-black">
                <div class="ratio ratio-16x9">
                    @if($video->video_source === 'youtube' && $video->youtube_id)
                        <iframe 
                            src="https://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0&showinfo=0&autoplay=1" 
                            title="{{ $video->title }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            referrerpolicy="strict-origin-when-cross-origin" 
                            allowfullscreen>
                        </iframe>
                    @elseif($video->video_source === 'upload' && $video->video_file)
                        <video controls controlsList="nodownload" poster="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : '' }}" class="w-100" autoplay>
                            <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div class="d-flex align-items-center justify-content-center text-white-50 h-100 flex-column gap-3">
                            <i class="bi bi-exclamation-triangle fs-1"></i>
                            <p>Video source unavailable or invalid.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Video Info Card -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h2 class="fw-bold mb-0 text-dark">{{ $video->title }}</h2>
                        @if($video->duration)
                            <span class="text-muted bg-light px-3 py-1 rounded-pill small mt-1">
                                <i class="bi bi-clock me-1"></i> {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        @endif
                    </div>
                    
                    <hr class="my-4 opacity-10">
                    
                    <div>
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-justify-left text-primary me-2"></i> Description</h5>
                        <div class="text-muted lh-base">
                            @if($video->description)
                                {!! nl2br(e($video->description)) !!}
                            @else
                                <p class="fst-italic opacity-50">No description available for this video tutorial.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Recommendations Sidebar -->
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 py-4 px-4 overflow-hidden position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-5"></div>
                    <h5 class="mb-0 fw-bold position-relative"><i class="bi bi-collection-play-fill text-primary me-2"></i> Up Next</h5>
                </div>
                <div class="card-body p-0">
                    @php
                        $otherVideos = $video->category->videos()
                            ->where('is_active', true)
                            ->where('id', '!=', $video->id)
                            ->orderBy('order')
                            ->limit(10)
                            ->get();
                    @endphp
                    
                    @if($otherVideos->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($otherVideos as $otherVideo)
                                <a href="{{ route('user.videos.play', $otherVideo) }}" class="list-group-item list-group-item-action py-3 px-4 border-0 hover-bg-light transition">
                                    <div class="d-flex gap-3">
                                        <div class="position-relative flex-shrink-0">
                                            @if($otherVideo->thumbnail)
                                                <img src="{{ asset('storage/' . $otherVideo->thumbnail) }}" alt="Thumb" class="rounded object-fit-cover shadow-sm" style="width: 100px; height: 60px;">
                                            @else
                                                <div class="rounded bg-dark d-flex align-items-center justify-content-center text-white-50 border shadow-sm" style="width: 100px; height: 60px;">
                                                    <i class="bi bi-play-circle fs-4"></i>
                                                </div>
                                            @endif
                                            @if($otherVideo->duration)
                                                <span class="position-absolute bottom-0 end-0 m-1 bg-dark bg-opacity-75 text-white rounded-1 px-1 py-0 small" style="font-size: 0.65rem;">
                                                    {{ floor($otherVideo->duration / 60) }}:{{ str_pad($otherVideo->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 min-w-0">
                                            <h6 class="mb-1 text-dark fw-bold text-truncate" style="font-size: 0.9rem;">{{ $otherVideo->title }}</h6>
                                            <small class="text-muted d-block text-truncate">{{ Str::limit($otherVideo->description, 40) }}</small>
                                            <div class="mt-1">
                                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill small" style="font-size: 0.7rem;">Play Now</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-camera-video-off fs-1 d-block mb-3 opacity-25"></i>
                            <p class="small mb-0">No more videos in this category.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .hover-bg-light:hover {
        background-color: #f8f9fa;
    }
    .transition {
        transition: all 0.2s ease-in-out;
    }
    .ratio-16x9 video {
        object-fit: contain;
    }
</style>
@endpush
