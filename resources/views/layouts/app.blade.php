<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Company Portal</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #556b2f; /* Olive Green */
            --primary-hover: #4b5320;
            --bg-color: #f4f5f1;
            --sidebar-bg: #2C3529;
            --sidebar-hover: #3b4637;
            --sidebar-active: #556b2f;
            --text-main: #333333;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
        }
        /* Sidebar Styling */
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            padding: 1.5rem 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            color: #ffffff;
            transform: translateX(3px);
        }
        .sidebar a.active {
            background-color: var(--sidebar-active);
            color: #ffffff;
            border-left: 4px solid #a4c639;
        }
        /* Main Content */
        .main-content {
            padding: 2.5rem;
            min-height: 100vh;
        }
        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            margin-bottom: 1.5rem;
            background-color: #fff;
        }
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            color: #1a202c;
        }
        /* Button Styling */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: 0 4px 6px rgba(85, 107, 47, 0.2);
        }
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-bottom: 2rem;
            padding: 1rem 1.5rem;
        }
        .btn-group-custom {
            display: flex;
            gap: 0.5rem;
        }
        .table {
            vertical-align: middle;
        }
        /* Utilities */
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(85, 107, 47, 0.25);
        }
        .badge {
            padding: 0.4em 0.8em;
            border-radius: 6px;
            font-weight: 500;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid p-0">
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="sidebar col-auto col-md-3 col-xl-2 px-0 fixed-top" style="position: sticky; top: 0;">
                <div class="sidebar-brand text-white">
                    <i class="bi bi-buildings fs-4"></i>
                    <span class="fs-5 d-none d-md-inline">Portal RSIA IBI</span>
                </div>
                <nav class="mt-3">
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="@if(Route::currentRouteName() === 'admin.dashboard') active @endif">
                            <i class="bi bi-grid-1x2-fill"></i> <span class="d-none d-md-inline">Beranda</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'admin.categories')) active @endif">
                            <i class="bi bi-tags-fill"></i> <span class="d-none d-md-inline">Kategori</span>
                        </a>
                        <a href="{{ route('admin.links.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'admin.links')) active @endif">
                            <i class="bi bi-link-45deg fs-5"></i> <span class="d-none d-md-inline">Tautan</span>
                        </a>
                        <a href="{{ route('admin.videos.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'admin.videos')) active @endif">
                            <i class="bi bi-play-btn-fill"></i> <span class="d-none d-md-inline">Video</span>
                        </a>
                        <a href="{{ route('admin.units.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'admin.units')) active @endif">
                            <i class="bi bi-tag-fill"></i> <span class="d-none d-md-inline">Unit Label</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'admin.settings')) active @endif">
                            <i class="bi bi-gear-fill"></i> <span class="d-none d-md-inline">Pengaturan</span>
                        </a>
                    @elseif(auth()->check() && auth()->user()->role === 'user')
                        <a href="{{ route('user.dashboard') }}" class="@if(Route::currentRouteName() === 'user.dashboard') active @endif">
                            <i class="bi bi-grid-1x2-fill"></i> <span class="d-none d-md-inline">Beranda</span>
                        </a>
                        <a href="{{ route('user.links.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'user.links')) active @endif">
                            <i class="bi bi-link-45deg fs-5"></i> <span class="d-none d-md-inline">Tautan</span>
                        </a>
                        <a href="{{ route('user.videos.index') }}" class="@if(str_starts_with(Route::currentRouteName(), 'user.videos')) active @endif">
                            <i class="bi bi-play-btn-fill"></i> <span class="d-none d-md-inline">Video</span>
                        </a>
                    @endif
                    <hr class="text-secondary mx-3 mt-4">
                    <div class="px-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light w-100 btn-sm py-2 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> <span class="d-none d-md-inline">Keluar</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="main-content flex-grow-1" style="min-width: 0;">
                <div class="navbar-custom d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0 text-dark fw-bold">@yield('title')</h4>
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-muted fw-medium"><i class="bi bi-person-circle fs-5 me-1"></i> {{ auth()->user()->name ?? 'Guest' }}</span>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toast configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#556b2f',
                });
            @endif

            @if($errors->any() && !request()->routeIs('login') && !request()->routeIs('register'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    html: '<ul class="text-start">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    confirmButtonColor: '#556b2f',
                });
            @endif

            // Global Delete Confirmation
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let form = this.closest('form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#aaabad',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
