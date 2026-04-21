@extends('layouts.app')

@section('title', 'Category Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Categories</h3>
            <p class="text-muted mb-0">Manage category for links and videos</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add Category
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0" style="width: 5%">#</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Category Name</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Description</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0" style="width: 10%">Order</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0" style="width: 15%">Status</th>
                        <th class="py-3 px-4 text-muted fw-semibold text-end border-bottom-0" style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($categories as $key => $category)
                        <tr>
                            <td class="px-4 text-muted py-3">{{ $key + 1 }}</td>
                            <td class="px-4 fw-medium text-dark py-3">{{ $category->name }}</td>
                            <td class="px-4 text-muted py-3">{{ Str::limit($category->description, 50) ?: '-' }}</td>
                            <td class="px-4 py-3">{{ $category->order }}</td>
                            <td class="px-4 py-3">
                                @if($category->is_active)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2"><i class="bi bi-circle-fill small me-1"></i> Active</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2"><i class="bi bi-circle small me-1"></i> Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 text-end py-3">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-light text-primary rounded-3 px-2 py-1" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light text-danger btn-delete rounded-3 px-2 py-1" data-bs-toggle="tooltip" title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                                    <p class="mb-1">No categories found</p>
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-link text-decoration-none">Create your first category</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
