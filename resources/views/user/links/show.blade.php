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
                    <a href="{{ $link->url }}" target="_blank" class="text-decoration-none h-100 d-block">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-lift bg-white">
                            @if($link->banner_image)
                                <div class="position-relative bg-light" style="height: 140px;">
                                    <img src="{{ asset('storage/' . $link->banner_image) }}" class="w-100 h-100 object-fit-cover" alt="Banner">
                                    <div class="position-absolute top-0 start-0 p-3 d-flex flex-wrap gap-1" style="z-index: 3;">
                                        @foreach($link->units as $unit)
                                            <span class="px-2 py-1 rounded-pill text-white fw-bold shadow-sm" style="background-color: {{ $unit->color }} !important; font-size: 0.6rem; letter-spacing: 0.5px;">
                                                {{ $unit->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center position-relative" style="height: 100px;">
                                    <i class="bi bi-image text-muted opacity-25 fs-1"></i>
                                    <div class="position-absolute top-0 start-0 p-3 d-flex flex-wrap gap-1" style="z-index: 3;">
                                        @foreach($link->units as $unit)
                                            <span class="px-2 py-1 rounded-pill text-white fw-bold shadow-sm" style="background-color: {{ $unit->color }} !important; font-size: 0.6rem; letter-spacing: 0.5px;">
                                                {{ $unit->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start mb-3">
                                    @if($link->cover_image)
                                        <div class="bg-white p-1 rounded shadow-sm me-3 flex-shrink-0" style="margin-top: -35px; z-index: 2; position: relative;">
                                            <img src="{{ asset('storage/' . $link->cover_image) }}" class="rounded shadow-sm" alt="{{ $link->title }}" style="width: 55px; height: 55px; object-fit: cover;">
                                        </div>
                                    @else
                                        <div class="bg-white p-1 rounded shadow-sm me-3 flex-shrink-0" style="margin-top: -35px; z-index: 2; position: relative;">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 55px; height: 55px;">
                                                <i class="bi bi-link-45deg fs-3"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="min-w-0 {{ $link->banner_image ? '' : 'mt-2' }}">
                                        <h5 class="fw-bold text-dark mb-0 line-clamp-2">{{ $link->title }}</h5>
                                    </div>
                                </div>
                                <div class="text-muted small mb-0">
                                    {!! $link->description ? nl2br(e(Str::limit($link->description, 160))) : '<span class="fst-italic">Buka Tautan</span>' !!}
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
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
@endpush
