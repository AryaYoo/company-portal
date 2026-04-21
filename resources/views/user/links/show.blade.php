@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="d-flex border-bottom pb-4 mb-4 mt-2 justify-content-between align-items-end">
        <div>
            <a href="{{ route('user.links.index') }}" class="btn btn-sm btn-light border rounded-pill mb-3">
                <i class="bi bi-arrow-left me-1"></i> Back to Categories
            </a>
            <h2 class="fw-bold mb-1"><i class="bi bi-folder2-open text-primary me-2"></i> {{ $category->name }}</h2>
            @if($category->description)
                <p class="text-muted mb-0"><i class="bi bi-info-circle me-1"></i> {{ $category->description }}</p>
            @endif
        </div>
        <div class="d-none d-md-block text-end">
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fs-6">
                {{ $links->count() }} Link(s)
            </span>
        </div>
    </div>

    @if($links->count() > 0)
        <div class="row g-4">
            @foreach($links as $link)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden link-card">
                        <div class="card-img-wrapper position-relative bg-light">
                            @if($link->cover_image)
                                <img src="{{ asset('storage/' . $link->cover_image) }}" class="w-100 object-fit-cover" alt="{{ $link->title }}" style="height: 160px; filter: brightness(0.9);">
                            @else
                                <div class="w-100 d-flex align-items-center justify-content-center" style="height: 160px; background: linear-gradient(135deg, #f4f5f1 0%, #e9ecef 100%);">
                                    <i class="bi bi-link-45deg text-secondary opacity-50" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <a href="{{ $link->url }}" target="_blank" class="btn btn-light rounded-circle shadow p-3 view-btn text-primary">
                                    <i class="bi bi-box-arrow-up-right fs-5"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $link->title }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ $link->description ? Str::limit($link->description, 90) : 'No description provided.' }}
                            </p>
                            <a href="{{ $link->url }}" target="_blank" class="btn btn-outline-primary d-block mt-3 rounded-pill">
                                Access Link
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-light">
            <div class="card-body">
                <i class="bi bi-folder2-open fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-medium text-dark">Empty Folder</h5>
                <p class="text-muted mb-0">No links have been added to this category yet.</p>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .link-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .link-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .card-img-wrapper {
        position: relative;
    }
    .card-img-wrapper .overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(85, 107, 47, 0.4);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .card-img-wrapper:hover .overlay {
        opacity: 1;
    }
    .view-btn {
        transform: scale(0.5);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .card-img-wrapper:hover .view-btn {
        transform: scale(1);
    }
</style>
@endpush
