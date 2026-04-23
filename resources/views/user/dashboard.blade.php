@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="mb-5 text-center">
        <h2 class="fw-bold"><i class="bi bi-person-badge"></i> Halo, {{ auth()->user()->name }}!</h2>
        <p class="text-muted">Silakan pilih menu di bawah ini</p>
    </div>

    <!-- Global Search -->
    <div class="row justify-content-center mb-5" x-data="{ 
        query: '', 
        links: {{ $allLinks->map(fn($l) => [
            'title' => $l->title,
            'url' => $l->url,
            'category' => $l->category->name ?? 'Uncategorized',
            'units' => $l->units->pluck('name'),
            'description' => $l->description
        ])->toJson() }},
        get filteredLinks() {
            if (this.query.length < 2) return [];
            return this.links.filter(l => 
                l.title.toLowerCase().includes(this.query.toLowerCase()) || 
                l.category.toLowerCase().includes(this.query.toLowerCase()) ||
                (l.description && l.description.toLowerCase().includes(this.query.toLowerCase())) ||
                l.units.some(u => u.toLowerCase().includes(this.query.toLowerCase()))
            ).slice(0, 8);
        }
    }">
        <div class="col-md-8 col-lg-6 position-relative">
            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                <span class="input-group-text bg-white border-0 ps-4">
                    <i class="bi bi-search text-primary"></i>
                </span>
                <input type="text" 
                       x-model="query"
                       class="form-control border-0 py-3 ps-2" 
                       placeholder="Cari aplikasi, departemen, atau layanan..."
                       @keydown.escape="query = ''">
                <button class="btn btn-white border-0 pe-4" x-show="query.length > 0" @click="query = ''" x-cloak>
                    <i class="bi bi-x-lg text-muted"></i>
                </button>
            </div>

            <!-- Search Results Dropdown -->
            <div class="position-absolute w-100 mt-2 shadow-lg rounded-4 bg-white overflow-hidden" 
                 style="z-index: 1000; left: 0;"
                 x-show="query.length >= 2"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-cloak>
                
                <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                    <span class="small fw-bold text-muted text-uppercase">Hasil Pencarian</span>
                    <span class="badge bg-primary rounded-pill" x-text="filteredLinks.length"></span>
                </div>

                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                    <template x-for="link in filteredLinks" :key="link.url">
                        <a :href="link.url" target="_blank" class="list-group-item list-group-item-action p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark" x-text="link.title"></h6>
                                    <p class="small text-muted mb-2 line-clamp-1" x-text="link.description || 'Buka aplikasi'"></p>
                                    <div class="d-flex flex-wrap gap-1">
                                        <span class="badge bg-light text-primary border rounded-pill" style="font-size: 0.65rem;" x-text="link.category"></span>
                                        <template x-for="unit in link.units">
                                            <span class="badge bg-secondary opacity-75 rounded-pill" style="font-size: 0.65rem;" x-text="unit"></span>
                                        </template>
                                    </div>
                                </div>
                                <i class="bi bi-box-arrow-up-right text-muted small"></i>
                            </div>
                        </a>
                    </template>
                    
                    <div x-show="filteredLinks.length === 0" class="p-5 text-center text-muted">
                        <i class="bi bi-search fs-2 d-block mb-2 opacity-25"></i>
                        Tidak menemukan hasil untuk "<span x-text="query" class="fw-bold"></span>"
                    </div>
                </div>

                <div class="p-2 bg-light text-center border-top">
                    <small class="text-muted">Tekan <kbd>Esc</kbd> untuk menutup</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-5">
            <a href="{{ route('user.links.index') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm hover-lift"
                    style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px;">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow"
                                style="width: 90px; height: 90px;">
                                <i class="bi bi-link-45deg" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h4 class="card-title fw-bold text-dark mb-0">Aplikasi Internal</h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-5">
            <a href="{{ route('user.videos.index') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm hover-lift"
                    style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px;">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle shadow"
                                style="width: 90px; height: 90px;">
                                <i class="bi bi-play-circle" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h4 class="card-title fw-bold text-dark mb-0">Video Tutorial</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .hover-lift {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush