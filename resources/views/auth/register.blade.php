<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Company Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #556b2f;
            --primary-hover: #4b5320;
            --bg-color: #f4f5f1;
        }
        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 1rem;
        }
        .card {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }
        .card-header {
            background-color: var(--primary-color);
            border: none;
            padding: 2rem;
            text-align: center;
        }
        .card-header h2 {
            color: white;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .card-body {
            padding: 2rem;
            background-color: #ffffff;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(85, 107, 47, 0.25);
        }
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .btn-login {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(85, 107, 47, 0.3);
        }
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
        }
        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-person-plus-fill"></i> Register</h2>
                <p class="text-white-50 mt-2 mb-0">Create new account</p>
            </div>
            <div class="card-body">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-login">
                        Register Account <i class="bi bi-check-circle ms-1"></i>
                    </button>
                </form>

                <div class="register-link">
                    Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed!',
                    html: `
                        <ul class="text-start mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    `,
                    confirmButtonColor: '#556b2f'
                });
            @endif
        });
    </script>
</body>
</html>
