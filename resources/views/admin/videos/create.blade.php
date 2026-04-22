@extends('layouts.app')

@section('title', 'Add Video')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Add New Video</h3>
            <p class="text-muted mb-0">Upload a new tutorial or video resource.</p>
        </div>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-light border px-4 rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4 d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="category_id" class="form-label fw-semibold text-dark">Category <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg bg-light" id="category_id" name="category_id" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">Video Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg bg-light" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Onboarding Guide" required>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control bg-light" id="description" name="description" rows="3" placeholder="Explain what the video is about...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Sumber Video <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4 p-3 bg-light rounded-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="video_source" id="source_upload" value="upload" {{ old('video_source', 'upload') == 'upload' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="source_upload text-dark">
                                        <i class="bi bi-file-earmark-arrow-up me-1"></i> Upload File
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="video_source" id="source_youtube" value="youtube" {{ old('video_source') == 'youtube' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="source_youtube text-dark">
                                        <i class="bi bi-youtube me-1"></i> YouTube Link
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="upload_section" class="mb-4 {{ old('video_source', 'upload') == 'upload' ? '' : 'd-none' }}">
                            <label for="video_file" class="form-label fw-semibold text-dark">Video File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control form-control-lg bg-light" id="video_file" name="video_file" accept="video/*">
                            <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i> Max size: 100MB. Use YouTube for larger files.</div>
                            @error('video_file')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="youtube_section" class="mb-4 {{ old('video_source') == 'youtube' ? '' : 'd-none' }}">
                            <label for="external_url" class="form-label fw-semibold text-dark">YouTube URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control form-control-lg bg-light" id="external_url" name="external_url" value="{{ old('external_url') }}" placeholder="https://www.youtube.com/watch?v=...">
                            <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i> Tip: Use the link from your browser's address bar or the "Share" button.</div>
                            @error('external_url')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4">
                                <label for="thumbnail" class="form-label fw-semibold text-dark">Thumbnail Image</label>
                                <input type="file" class="form-control bg-light" id="thumbnail" name="thumbnail" accept="image/*">
                                <div class="form-text mt-2">Max 2MB. Leave blank for auto thumbnail if supported.</div>
                                @error('thumbnail')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <label for="duration" class="form-label fw-semibold text-dark">Duration (Secs)</label>
                                <input type="number" class="form-control bg-light" id="duration" name="duration" value="{{ old('duration') }}" placeholder="e.g. 120">
                            </div>

                            <div class="col-md-3 mb-4">
                                <label for="order" class="form-label fw-semibold text-dark">Order</label>
                                <input type="number" class="form-control bg-light" id="order" name="order" value="{{ old('order', 0) }}">
                            </div>
                        </div>

                        <div class="mb-5 d-flex gap-4">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_public" name="is_public" {{ old('is_public') ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_public">Public Access</label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                <i class="bi bi-save me-1"></i> Upload Video
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sourceUpload = document.getElementById('source_upload');
        const sourceYoutube = document.getElementById('source_youtube');
        const uploadSection = document.getElementById('upload_section');
        const youtubeSection = document.getElementById('youtube_section');

        function toggleSections() {
            if (sourceUpload.checked) {
                uploadSection.classList.remove('d-none');
                youtubeSection.classList.add('d-none');
            } else {
                uploadSection.classList.add('d-none');
                youtubeSection.classList.remove('d-none');
            }
        }

        sourceUpload.addEventListener('change', toggleSections);
        sourceYoutube.addEventListener('change', toggleSections);
        
        // Initial state
        toggleSections();

        // File size validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const videoFile = document.getElementById('video_file');
            const thumbnail = document.getElementById('thumbnail');
            
            // Check video file size (100MB max)
            if (sourceUpload.checked && videoFile.files.length > 0) {
                const fileSize = videoFile.files[0].size / 1024 / 1024; // in MB
                if (fileSize > 120) { // Limit set slightly higher than php.ini for safety buffer
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar!',
                        text: `Ukuran video Anda (${fileSize.toFixed(2)} MB) melebihi batas maksimal 100 MB. Silakan gunakan link YouTube atau perkecil ukuran video.`,
                        confirmButtonColor: '#556b2f'
                    });
                    return;
                }
            }

            // Check thumbnail size (2MB max)
            if (thumbnail.files.length > 0) {
                const thumbSize = thumbnail.files[0].size / 1024 / 1024;
                if (thumbSize > 2) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Thumbnail Terlalu Besar!',
                        text: `Ukuran gambar (${thumbSize.toFixed(2)} MB) melebihi batas maksimal 2 MB.`,
                        confirmButtonColor: '#556b2f'
                    });
                }
            }
        });
    });
</script>
@endpush
