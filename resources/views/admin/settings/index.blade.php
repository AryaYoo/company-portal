@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">System Settings</h3>
            <p class="text-muted mb-0">Configure look and feel of the portal.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-5">
                            <h5 class="fw-bold mb-3"><i class="bi bi-image text-primary me-2"></i> Login Page Customization</h5>
                            <p class="text-muted small">The wallpaper will be displayed on the left section of the login and register pages.</p>
                            
                            <div class="row align-items-center mt-4">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <label class="form-label fw-semibold">Upload Wallpaper</label>
                                    <input type="file" class="form-control bg-light @error('login_wallpaper') is-invalid @enderror" name="login_wallpaper" accept="image/*">
                                    <div class="form-text mt-2">Recommended resolution: 1920x1080. Max size: 5MB.</div>
                                    @error('login_wallpaper')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 text-center">
                                    <div class="p-2 border rounded-4 bg-light d-inline-block shadow-sm">
                                        @if($loginWallpaper)
                                            <img src="{{ asset('storage/' . $loginWallpaper) }}" alt="Current Wallpaper" class="rounded-3 object-fit-cover" style="width: 100%; max-width: 250px; height: 150px;">
                                            <div class="mt-2 small text-muted">Current Wallpaper Preview</div>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center text-muted rounded-3" style="width: 250px; height: 150px; background: #eee; border: 2px dashed #ccc;">
                                                <div class="text-center">
                                                    <i class="bi bi-image fs-1 opacity-25"></i>
                                                    <p class="small mb-0">No wallpaper set</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5 opacity-10">

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                <i class="bi bi-check2-circle me-1"></i> Save All Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-gear-wide-connected fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Centralized Config</h5>
                    <p class="text-muted small mb-0">Changes made here will take effect immediately across the portal for all unauthenticated and authenticated users.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
