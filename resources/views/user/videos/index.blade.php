@extends('layouts.app')

@section('title', 'Video Folders')

@section('content')
    <div class="mb-5 text-center text-md-start">
        <h2 class="fw-bold mb-2"><i class="bi bi-collection-play text-primary me-2"></i> Tutorial Directory</h2>
        <p class="text-muted">Browse video tutorials categorized by topic.</p>
    </div>

    @if($categories->count() > 0)
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative hover-lift">
                        <div class="position-absolute top-0 start-0 w-100 bg-danger" style="height: 4px;"></div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-folder-video fs-4"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-0 text-dark">{{ $category->name }}</h5>
                            </div>
                            
                            <p class="card-text text-muted small flex-grow-1 mb-4">
                                @if($category->description)
                                    {{ Str::limit($category->description, 90) }}
                                @else
                                    Access all videos related to {{ $category->name }}.
                                @endif
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <span class="badge bg-light text-secondary border px-2 py-1">
                                    <i class="bi bi-play-circle"></i> {{ $category->videos()->count() }} Videos
                                </span>
                                <a href="{{ route('user.videos.show', $category) }}" class="btn btn-sm btn-outline-danger rounded-pill stretched-link px-3">
                                    Browse
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 text-center py-5">
            <div class="card-body">
                <i class="bi bi-collection-play fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-medium text-dark">No Categories Available</h5>
                <p class="text-muted mb-0">Check back later or contact your administrator.</p>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
</style>
@endpush
