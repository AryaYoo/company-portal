@extends('layouts.app')

@section('title', 'Add Link')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Add New Link</h3>
            <p class="text-muted mb-0">Create an internal or external resource link.</p>
        </div>
        <a href="{{ route('admin.links.index') }}" class="btn btn-light border px-4 rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.links.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="mb-4">
                            <label for="units" class="form-label fw-semibold text-dark">Related Units (Labels)</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($units as $unit)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="units[]" value="{{ $unit->id }}" id="unit_{{ $unit->id }}" {{ in_array($unit->id, old('units', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label px-2 py-0 rounded-pill text-white small" for="unit_{{ $unit->id }}" style="background-color: {{ $unit->color }} !important; font-size: 0.75rem;">
                                            {{ $unit->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-text text-muted">Select departments related to this link.</div>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">Link Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg bg-light" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Employee Portal" required>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="url" class="form-label fw-semibold text-dark">Destination URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control form-control-lg bg-light" id="url" name="url" value="{{ old('url') }}" placeholder="https://..." required>
                            @error('url')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control bg-light" id="description" name="description" rows="3" placeholder="Additional details...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="cover_image" class="form-label fw-semibold text-dark">Icon / Logo</label>
                                <input type="file" class="form-control bg-light" id="cover_image" name="cover_image" accept="image/*">
                                <div class="form-text text-muted">Small square image recommended.</div>
                                @error('cover_image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="banner_image" class="form-label fw-semibold text-dark">Banner Image</label>
                                <input type="file" class="form-control bg-light" id="banner_image" name="banner_image" accept="image/*">
                                <div class="form-text text-muted">Large landscape image.</div>
                                @error('banner_image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="order" class="form-label fw-semibold text-dark">Display Order</label>
                                <input type="number" class="form-control bg-light" id="order" name="order" value="{{ old('order', 0) }}">
                                <div class="form-text text-muted">Lower values display first.</div>
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
                                <i class="bi bi-save me-1"></i> Save Link
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
