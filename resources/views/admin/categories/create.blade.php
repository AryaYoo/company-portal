@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Add New Category</h3>
            <p class="text-muted mb-0">Create a new category for grouping content.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-light border px-4 rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg bg-light" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. IT Tutorials" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control bg-light" id="description" name="description" rows="4" placeholder="Brief description about this category...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="order" class="form-label fw-semibold text-dark">Display Order</label>
                                    <input type="number" class="form-control bg-light" id="order" name="order" value="{{ old('order', 0) }}">
                                    <div class="form-text">Lower numbers appear first.</div>
                                    @error('order')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} value="1">
                                <label class="form-check-label ms-2 fs-6 mt-1" for="is_active">Set category as Active</label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                <i class="bi bi-save me-1"></i> Save Category
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
