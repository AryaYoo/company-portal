@extends('layouts.app')

@section('title', 'Manage Units')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Unit Management</h3>
            <p class="text-muted mb-0">Create and manage department labels for links.</p>
        </div>
        <button type="button" class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addUnitModal">
            <i class="bi bi-plus-lg me-1"></i> Add Unit
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="px-4 py-3 text-uppercase small fw-bold">Name</th>
                            <th class="px-4 py-3 text-uppercase small fw-bold">Color</th>
                            <th class="px-4 py-3 text-uppercase small fw-bold text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($units as $unit)
                            <tr>
                                <td class="px-4">
                                    <span class="px-2 py-1 rounded-pill text-white small" style="background-color: {{ $unit->color }} !important; font-size: 0.75rem;">
                                        {{ $unit->name }}
                                    </span>
                                </td>
                                <td class="px-4">
                                    <code>{{ $unit->color }}</code>
                                </td>
                                <td class="px-4 text-end">
                                    <button class="btn btn-sm btn-light border rounded-pill px-3 me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUnitModal{{ $unit->id }}">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.units.destroy', $unit) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border rounded-pill px-3" onclick="return confirm('Hapus unit ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">No units found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addUnitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <form action="{{ route('admin.units.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Add New Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Unit Name</label>
                            <input type="text" name="name" class="form-control form-control-lg bg-light" placeholder="e.g. IT, HR, Radiology" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold text-dark">Label Color</label>
                            <div class="d-flex gap-3 align-items-center">
                                <input type="color" name="color" class="form-control form-control-color border-0 p-0" style="width: 60px; height: 45px;" value="#6c757d" title="Choose color">
                                <input type="text" class="form-control bg-light fw-mono" value="#6c757d" readonly style="width: 120px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Unit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Unit Modals Loop -->
    @foreach($units as $unit)
        <div class="modal fade text-start" id="editUnitModal{{ $unit->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <form action="{{ route('admin.units.update', $unit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold text-dark">Edit Unit Label</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">Unit Name</label>
                                <input type="text" name="name" class="form-control form-control-lg bg-light" value="{{ $unit->name }}" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold text-dark">Label Color</label>
                                <div class="d-flex gap-3 align-items-center">
                                    <input type="color" name="color" class="form-control form-control-color border-0 p-0" style="width: 60px; height: 45px;" value="{{ $unit->color }}" title="Choose color">
                                    <input type="text" class="form-control bg-light fw-mono" value="{{ $unit->color }}" readonly style="width: 120px;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Update Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sync color picker with text input
        const pickers = document.querySelectorAll('input[type="color"]');
        pickers.forEach(picker => {
            picker.addEventListener('input', function() {
                const textInput = this.nextElementSibling;
                if (textInput) textInput.value = this.value;
            });
        });
    });
</script>
@endpush
