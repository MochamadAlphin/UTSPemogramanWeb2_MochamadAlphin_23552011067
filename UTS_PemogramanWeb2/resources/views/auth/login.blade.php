<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik UTB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --utb-blue: #2d2a70;
            --utb-orange: #ed6b23;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        .main-wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* BAGIAN KIRI: ILUSTRASI */
        .bg-section {
            flex: 1;
            background: linear-gradient(rgba(45, 42, 112, 0.3), rgba(45, 42, 112, 0.3)), 
                        url("{{ asset('assets/img/utb_ilustrasi_imut.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
        }

        .bg-content {
            position: relative;
            z-index: 5;
            color: #fff;
            max-width: 500px;
        }

        /* BAGIAN KANAN: PANEL LOGIN */
        .login-panel {
            width: 500px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 80px;
            box-shadow: -15px 0 35px rgba(0, 0, 0, 0.05);
            z-index: 10;
        }

        .local-logo {
            height: 60px;
            margin-bottom: 35px;
            object-fit: contain;
        }

        h2 {
            color: var(--utb-blue);
            font-weight: 800;
            letter-spacing: -1px;
            font-size: 1.85rem;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 35px;
            line-height: 1.5;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .form-control {
            border: 2px solid #f3f4f6;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.95rem;
            background: #f9fafb;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--utb-blue);
            box-shadow: 0 0 0 4px rgba(45, 42, 112, 0.1);
        }

        .input-group-text {
            background: #f9fafb;
            border: 2px solid #f3f4f6;
            border-left: none;
            border-radius: 0 12px 12px 0;
            color: #9ca3af;
        }

        .btn-login {
            background: var(--utb-blue);
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            margin-top: 15px;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #1a184a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 42, 112, 0.2);
            color: white;
        }

        .footer-text {
            margin-top: 40px;
            color: #9ca3af;
            font-size: 0.7rem;
            text-align: center;
            border-top: 1px solid #f3f4f6;
            padding-top: 20px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .bg-section { display: none; }
            .login-panel { width: 100%; padding: 40px; }
        }
    </style>
</head>

<body>

<div class="main-wrapper">
    <div class="bg-section d-none d-lg-flex">
        <div class="bg-content">
            <h1 class="display-5 fw-bold mb-3">Membangun Masa Depan Digital</h1>
            <p class="lead opacity-75">Platform integrasi akademik untuk mendukung kreativitas dan inovasi mahasiswa UTB.</p>
        </div>
    </div>  

    <div class="login-panel">
        <img src="{{ asset('assets/img/utb_panjang.png') }}" class="local-logo" alt="Logo UTB">

        <h2>Selamat Datang</h2>
        <p class="subtitle">Silakan masuk untuk mengelola dashboard akademik Anda.</p>

        @if ($errors->any())
        <div class="alert alert-danger border-0 small py-2 mb-4" style="border-radius: 10px;">
            <i class="bi bi-exclamation-circle-fill me-2"></i> Username atau Password salah.
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email / NIM</label>
                <input type="text" name="email" class="form-control" placeholder="user@example.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-end">
                    <label class="form-label">Password</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" style="border-right:none;" placeholder="••••••••" required>
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                </div>
                <a href="#" class="small text-decoration-none" style="color: var(--utb-orange); font-weight: 600;">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Masuk Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
            </button>
        </form>

        <div class="footer-text">
            &copy; 2026 &bull; <strong>23552011067_MochamadAlphin_TIF23CNS-A</strong>
        </div>
    </div>
</div>

<script>
    // Fitur Show/Hide Password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>