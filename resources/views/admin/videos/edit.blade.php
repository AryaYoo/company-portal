@extends('layouts.app')

@section('title', 'Edit Video')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Edit Video</h3>
            <p class="text-muted mb-0">Update video details or replace file.</p>
        </div>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-light border px-4 rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4 d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="category_id" class="form-label fw-semibold text-dark">Category <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg bg-light" id="category_id" name="category_id" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $video->category_id) == $category->id ? 'selected' : '' }}>
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
                            <input type="text" class="form-control form-control-lg bg-light" id="title" name="title" value="{{ old('title', $video->title) }}" required>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control bg-light" id="description" name="description" rows="3">{{ old('description', $video->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Sumber Video <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4 p-3 bg-light rounded-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="video_source" id="source_upload" value="upload" {{ old('video_source', $video->video_source) == 'upload' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="source_upload text-dark">
                                        <i class="bi bi-file-earmark-arrow-up me-1"></i> Upload File
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="video_source" id="source_youtube" value="youtube" {{ old('video_source', $video->video_source) == 'youtube' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="source_youtube text-dark">
                                        <i class="bi bi-youtube me-1"></i> YouTube Link
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="upload_section" class="mb-4 {{ old('video_source', $video->video_source) == 'upload' ? '' : 'd-none' }}">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <label for="video_file" class="form-label fw-semibold text-dark">Replace Video File</label>
                                    <input type="file" class="form-control bg-light" id="video_file" name="video_file" accept="video/*">
                                    <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i> Max size: 100MB. Leave blank to keep current file.</div>
                                    @error('video_file')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 text-center mt-3 mt-md-0">
                                    @if($video->video_source == 'upload' && $video->video_file)
                                        <a href="{{ asset('storage/' . $video->video_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-3">
                                            <i class="bi bi-play-circle me-1"></i> Preview Current
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="youtube_section" class="mb-4 {{ old('video_source', $video->video_source) == 'youtube' ? '' : 'd-none' }}">
                            <label for="external_url" class="form-label fw-semibold text-dark">YouTube URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control form-control-lg bg-light" id="external_url" name="external_url" value="{{ old('external_url', $video->external_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                            <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i> Current URL: {{ $video->external_url ?: 'None' }}</div>
                            @error('external_url')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4">
                                <label for="thumbnail" class="form-label fw-semibold text-dark">Thumbnail Image</label>
                                <input type="file" class="form-control bg-light" id="thumbnail" name="thumbnail" accept="image/*">
                                <div class="form-text mt-2">Max 2MB. Leave blank to keep current image.</div>
                                @error('thumbnail')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2 mb-4 text-center">
                                @if($video->thumbnail)
                                    <div class="mt-2">
                                        <p class="mb-1 small fw-semibold text-muted">Current:</p>
                                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Preview" class="rounded object-fit-cover shadow-sm border" style="height: 60px; width: 80px;">
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-2 mb-4">
                                <label for="duration" class="form-label fw-semibold text-dark">Duration (s)</label>
                                <input type="number" class="form-control bg-light px-2" id="duration" name="duration" value="{{ old('duration', $video->duration) }}">
                            </div>

                            <div class="col-md-2 mb-4">
                                <label for="order" class="form-label fw-semibold text-dark">Order</label>
                                <input type="number" class="form-control bg-light px-2" id="order" name="order" value="{{ old('order', $video->order) }}">
                            </div>
                        </div>

                        <div class="mb-5 d-flex gap-4">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" {{ old('is_active', $video->is_active) ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_public" name="is_public" {{ old('is_public', $video->is_public) ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_public">Public Access</label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                <i class="bi bi-save me-1"></i> Update Video
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
    });
</script>
@endpush
