<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Entry - Company Name</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-olive: #556b2f;
            --primary-light: #6b8e23;
            --accent-olive: #8fbc8f;
            --bg-neutral: #f8f9fa;
        }

        body {
            background-color: white;
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Split Screen Layout */
        .page-wrapper {
            display: flex;
            flex: 1;
            min-height: 100vh;
        }

        /* Left Section: Information Hub */
        .info-hub {
            flex: 1.4;
            background-color: var(--bg-neutral);
            padding: 4rem;
            overflow-y: auto;
            border-right: 1px solid #edf2f7;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        @if($loginWallpaper)
            .info-hub {
                background-image: url("{{ asset('storage/' . $loginWallpaper) }}");
                background-size: cover;
                background-position: center;
            }

            .info-hub::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(85, 107, 47, 0.6) 100%);
                z-index: 0;
            }

            .info-hub>* {
                position: relative;
                z-index: 1;
            }

            .brand-logo {
                color: white !important;
            }

            .section-title {
                color: rgba(255, 255, 255, 0.95) !important;
            }

            .info-hub .text-muted {
                color: rgba(255, 255, 255, 0.7) !important;
            }

            .resource-tile,
            .tutorial-item {
                background: rgba(255, 255, 255, 0.05) !important;
                backdrop-filter: blur(10px);
                border-color: rgba(255, 255, 255, 0.1) !important;
                color: white !important;
            }

            .resource-tile:hover {
                background: rgba(255, 255, 255, 0.15) !important;
                border-color: var(--accent-olive) !important;
            }

            .tutorial-item h6 {
                color: white !important;
            }

            .info-hub i {
                color: white !important;
            }

        @endif

        /* Right Section: Login Portal */
        .login-portal {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem;
            background: white;
        }

        @media (max-width: 992px) {
            .page-wrapper {
                flex-direction: column-reverse;
            }

            .info-hub {
                padding: 2rem;
                border-right: none;
            }

            .login-portal {
                padding: 3rem 2rem;
            }
        }

        .brand-header {
            margin-bottom: 3rem;
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-olive);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #2d3436;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Quick Access Tiles */
        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .resource-tile {
            background: white;
            padding: 1.25rem;
            border-radius: 16px;
            text-decoration: none;
            color: inherit;
            border: 1px solid #edf2f7;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .resource-tile:hover {
            border-color: var(--primary-olive);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            color: var(--primary-olive);
        }

        /* Tutorial Cards */
        .tutorial-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .tutorial-item {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #edf2f7;
            transition: all 0.3s;
        }

        .tutorial-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .thumb-box {
            position: relative;
            background: #000;
            aspect-ratio: 16/9;
        }

        .thumb-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.85;
        }

        .play-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 44px;
            height: 44px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-olive);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Login Card */
        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .form-floating>.form-control {
            border-radius: 12px;
            border: 1.5px solid #edf2f7;
        }

        .form-floating>.form-control:focus {
            border-color: var(--primary-olive);
            box-shadow: 0 0 0 4px rgba(85, 107, 47, 0.1);
        }

        .btn-portal {
            background: var(--primary-olive);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-portal:hover {
            background: #3d4a21;
            transform: scale(1.02);
            color: white;
        }

        /* Floating Helpdesk Button */
        .btn-help {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary-olive);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(85, 107, 47, 0.3);
            z-index: 1000;
            transition: all 0.3s;
        }

        .btn-help:hover {
            background: var(--primary-light);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(85, 107, 47, 0.4);
        }

        .btn-help i {
            font-size: 1.25rem;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <!-- LEFT: Information Hub -->
        <section class="info-hub">
            <div class="brand-header">
                <div class="brand-logo">
                    <i class="bi bi-buildings-fill fs-3"></i> PORTAL RSIA IBI
                </div>
            </div>

            <div class="content-body">
                <h3 class="section-title"><i class="bi bi-lightning-charge text-warning"></i> Quick Access Resources
                </h3>
                @forelse($groupedLinks as $categoryName => $links)
                    <h5 class="mt-4 mb-3 fw-bold text-dark opacity-75 fs-6 text-uppercase" style="letter-spacing: 0.5px;">{{ $categoryName }}</h5>
                    <div class="resource-grid">
                        @foreach($links as $link)
                            <a href="{{ $link->url }}" target="_blank" class="resource-tile p-2 pe-3">
                                @if($link->cover_image)
                                    <img src="{{ asset('storage/' . $link->cover_image) }}" alt="{{ $link->title }}" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bi bi-link-45deg fs-4 text-primary"></i>
                                    </div>
                                @endif
                                <span class="text-truncate fw-medium ms-1">{{ $link->title }}</span>
                            </a>
                        @endforeach
                    </div>
                @empty
                    <div class="text-muted small fst-italic">No public links available.</div>
                @endforelse

                <h3 class="section-title mt-5"><i class="bi bi-play-circle text-danger"></i> Common Tutorials</h3>
                @forelse($groupedVideos as $categoryName => $videos)
                    <h5 class="mt-4 mb-3 fw-bold text-dark opacity-75 fs-6 text-uppercase" style="letter-spacing: 0.5px;">{{ $categoryName }}</h5>
                    <div class="tutorial-container mb-4">
                        @foreach($videos as $video)
                            <a href="{{ route('videos.play', $video) }}" class="text-decoration-none h-100">
                                <div class="tutorial-item">
                                    <div class="thumb-box">
                                        @if($video->thumbnail)
                                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}">
                                        @else
                                            <div
                                                class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center text-white-50">
                                                <i class="bi bi-image" style="font-size: 2rem;"></i>
                                            </div>
                                        @endif
                                        <div class="play-indicator">
                                            <i class="bi bi-play-fill"></i>
                                        </div>
                                        @if($video->duration)
                                            <div class="position-absolute bottom-0 end-0 m-2 bg-dark bg-opacity-75 text-white px-2 py-0 small rounded"
                                                style="font-size: 0.7rem;">
                                                {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-3">
                                        <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $video->title }}</h6>
                                        <p class="text-muted small mb-0">{{ Str::limit($video->description, 50) }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @empty
                    <div class="text-muted small fst-italic">No public tutorials available.</div>
                @endforelse
            </div>
        </section>

        <!-- RIGHT: Login Portal -->
        <section class="login-portal">
            <div class="login-container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Welcome Back</h2>
                    <p class="text-muted">Sign in to your account to continue</p>
                </div>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="emailInput" value="{{ old('email') }}"
                            placeholder="name@company.com" required autofocus>
                        <label for="emailInput">Email Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="passwordInput"
                            placeholder="Password" required>
                        <label for="passwordInput">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label text-muted small" for="remember">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-portal mb-3">
                        Login to Portal <i class="bi bi-arrow-right ms-1"></i>
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted">Need an account? <a href="{{ route('register') }}"
                                class="text-primary fw-600 text-decoration-none">Register here</a></small>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <!-- Floating Helpdesk Button -->
    <a href="http://192.168.100.177/mastolongmas/public" target="_blank" class="btn-help">
        <i class="bi bi-life-preserver"></i>
        <span>Helpdesk</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            @if(session('error'))
                Toast.fire({ icon: 'error', title: '{{ session('error') }}' });
            @endif

            @if($errors->any())
                Toast.fire({ icon: 'warning', title: '{{ $errors->first() }}' });
            @endif
        });
    </script>
</body>

</html>