@extends('layouts.app')

@section('title', 'Manage Videos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Tutorial Videos</h3>
            <p class="text-muted mb-0">Manage training and tutorial videos</p>
        </div>
        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add Video
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0" style="width: 5%">#</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Video Details</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Category</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Duration</th>
                        <th class="py-3 px-4 text-muted fw-semibold border-bottom-0">Status</th>
                        <th class="py-3 px-4 text-muted fw-semibold text-end border-bottom-0" style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($videos as $key => $video)
                        <tr>
                            <td class="px-4 text-muted py-3">{{ $key + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-3">
                                        @if($video->thumbnail)
                                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="rounded bg-light object-fit-cover shadow-sm" style="width: 80px; height: 50px;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center text-secondary border shadow-sm" style="width: 80px; height: 50px;">
                                                <i class="bi bi-camera-video fs-4"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $video->title }}</h6>
                                        <span class="text-muted small">ID: {{ $video->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $video->category->name }}</span>
                            </td>
                            <td class="px-4 py-3 text-muted">
                                @if($video->duration)
                                    <i class="bi bi-clock me-1"></i> {{ floor($video->duration / 60) }}m {{ $video->duration % 60 }}s
                                @else
                                    <span class="text-black-50">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column gap-1">
                                    @if($video->is_active)
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2"><i class="bi bi-circle-fill small me-1"></i> Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2"><i class="bi bi-circle small me-1"></i> Inactive</span>
                                    @endif

                                    @if($video->is_public)
                                        <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2"><i class="bi bi-globe me-1"></i> Public</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 text-end py-3">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-sm btn-light text-primary rounded-3 px-2 py-1" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline">
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
                                    <i class="bi bi-play-btn fs-1 d-block mb-3"></i>
                                    <p class="mb-1">No videos found</p>
                                    <a href="{{ route('admin.videos.create') }}" class="btn btn-link text-decoration-none">Add your first video</a>
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
