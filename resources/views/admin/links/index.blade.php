@extends('layouts.app')

@section('title', 'Manage Links')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Internal Links</h3>
            <p class="text-muted mb-0">Manage internal and external links</p>
        </div>
        <a href="{{ route('admin.links.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add Link
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0" style="width: 5%">#</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Link Details</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Category</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Status</th>
                        <th class="py-3 px-4 text-muted fw-semibold text-end border-bottom-0" style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($links as $key => $link)
                        <tr>
                            <td class="px-4 text-muted py-3">{{ $key + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    @if($link->cover_image)
                                        <img src="{{ asset('storage/' . $link->cover_image) }}" alt="{{ $link->title }}" class="rounded bg-light object-fit-cover me-3" style="width: 40px; height: 40px;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center me-3 text-secondary" style="width: 40px; height: 40px;">
                                            <i class="bi bi-link-45deg fs-4"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $link->title }}</h6>
                                        <a href="{{ $link->url }}" target="_blank" class="text-muted small text-decoration-none hover-primary">
                                            {{ Str::limit($link->url, 40) }} <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 0.7rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $link->category->name }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column gap-1">
                                    @if($link->is_active)
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2"><i class="bi bi-circle-fill small me-1"></i> Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2"><i class="bi bi-circle small me-1"></i> Inactive</span>
                                    @endif

                                    @if($link->is_public)
                                        <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2"><i class="bi bi-globe me-1"></i> Public</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 text-end py-3">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.links.edit', $link) }}" class="btn btn-sm btn-light text-primary rounded-3 px-2 py-1" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.links.destroy', $link) }}" method="POST" class="d-inline">
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
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-link-45deg fs-1 d-block mb-3"></i>
                                    <p class="mb-1">No links found</p>
                                    <a href="{{ route('admin.links.create') }}" class="btn btn-link text-decoration-none">Add your first link</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .hover-primary:hover { color: var(--primary-color) !important; }
</style>
@endpush

@push('scripts')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
