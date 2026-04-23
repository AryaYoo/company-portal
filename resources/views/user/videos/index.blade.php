@extends('layouts.app')

@section('title', 'Video Tutorial')

@section('content')
    <div class="mb-5 text-center">
        <h2 class="fw-bold mb-2"><i class="bi bi-collection-play text-danger me-2"></i> Direktori Video</h2>
        <p class="text-muted">Pilih kategori video di bawah ini</p>
    </div>

    @if($categories->count() > 0)
        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-md-4 col-lg-3">
                    <a href="{{ route('user.videos.show', $category) }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center hover-lift">
                            <div class="card-body p-4">
                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-folder-video fs-2"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ $category->name }}</h5>
                                <span class="badge bg-light text-secondary border rounded-pill">
                                    <i class="bi bi-play-circle"></i> {{ $category->videos()->count() }} Video
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-collection-play fs-1 text-muted mb-3 d-block"></i>
            <h5 class="fw-medium text-dark">Tidak ada kategori</h5>
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
