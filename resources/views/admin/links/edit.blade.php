@extends('layouts.app')

@section('title', 'Edit Link')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Edit Link</h3>
            <p class="text-muted mb-0">Update information for this link.</p>
        </div>
        <a href="{{ route('admin.links.index') }}" class="btn btn-light border px-4 rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.links.update', $link) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4 d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="category_id" class="form-label fw-semibold text-dark">Category <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg bg-light" id="category_id" name="category_id" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $link->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">Link Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg bg-light" id="title" name="title" value="{{ old('title', $link->title) }}" required>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="url" class="form-label fw-semibold text-dark">Destination URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control form-control-lg bg-light" id="url" name="url" value="{{ old('url', $link->url) }}" required>
                            @error('url')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control bg-light" id="description" name="description" rows="3">{{ old('description', $link->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4">
                                <label for="cover_image" class="form-label fw-semibold text-dark">Cover Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control bg-light" id="cover_image" name="cover_image" accept="image/*">
                                </div>
                                <div class="form-text">Max 2MB. Leave blank to keep current image.</div>
                                @error('cover_image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                @if($link->cover_image)
                                    <div class="mt-2">
                                        <p class="mb-1 small fw-semibold text-muted">Current Image:</p>
                                        <img src="{{ asset('storage/' . $link->cover_image) }}" alt="Preview" class="rounded object-fit-cover shadow-sm border" style="height: 60px; width: 60px;">
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <span class="text-muted small border px-2 py-1 rounded bg-light">No Image</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="order" class="form-label fw-semibold text-dark">Display Order</label>
                                <input type="number" class="form-control bg-light" id="order" name="order" value="{{ old('order', $link->order) }}">
                            </div>
                        </div>

                        <div class="mb-5 d-flex gap-4">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" {{ old('is_active', $link->is_active) ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_public" name="is_public" {{ old('is_public', $link->is_public) ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_public">Public Access</label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                <i class="bi bi-save me-1"></i> Update Link
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
