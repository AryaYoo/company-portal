@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="mb-5 text-center">
        <h2 class="fw-bold"><i class="bi bi-person-badge"></i> Halo, {{ auth()->user()->name }}!</h2>
        <p class="text-muted">Silakan pilih menu di bawah ini</p>
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