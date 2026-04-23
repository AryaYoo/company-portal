@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="d-flex border-bottom pb-4 mb-4 mt-2 justify-content-between align-items-end">
        <div>
            <a href="{{ route('user.links.index') }}" class="btn btn-sm btn-light border rounded-pill mb-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Direktori
            </a>
            <h2 class="fw-bold mb-1"><i class="bi bi-folder2-open text-primary me-2"></i> {{ $category->name }}</h2>
            @if($category->description)
                <p class="text-muted mb-0"><i class="bi bi-info-circle me-1"></i> {{ $category->description }}</p>
            @endif
        </div>
        <div class="d-none d-md-block text-end">
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fs-6">
                {{ $links->count() }} Tautan
            </span>
        </div>
    </div>

    @if($links->count() > 0)
        <div class="row g-4">
            @foreach($links as $link)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-lift bg-light">
                            <div class="card-body p-4 d-flex align-items-center">
                                @if($link->cover_image)
                                    <img src="{{ asset('storage/' . $link->cover_image) }}" class="rounded shadow-sm me-3 flex-shrink-0" alt="{{ $link->title }}" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-primary bg-opacity-10 text-primary rounded d-flex align-items-center justify-content-center me-3 shadow-sm flex-shrink-0" style="width: 60px; height: 60px;">
                                        <i class="bi bi-link-45deg fs-2"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <h5 class="fw-bold text-dark mb-1 text-truncate">{{ $link->title }}</h5>
                                    <p class="text-muted small mb-0 text-truncate">{{ $link->description ? Str::limit($link->description, 60) : 'Buka Tautan' }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-light">
            <div class="card-body">
                <i class="bi bi-folder2-open fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-medium text-dark">Folder Kosong</h5>
                <p class="text-muted mb-0">Belum ada tautan di dalam kategori ini.</p>
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
