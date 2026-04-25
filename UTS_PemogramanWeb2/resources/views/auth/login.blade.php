<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik - UTB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
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

        /* BAGIAN KIRI: ILUSTRASI SEBAGAI BACKGROUND */
        .bg-section {
            flex: 1;
            background: url("{{ asset('assets/img/utb_ilustrasi_imut.png') }}");
            background-size: cover;
            background-position: 0% center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        /* Overlay halus agar gambar lebih menyatu */
        .bg-section::after {
            content: '';
            position: absolute;
            top: 0; left: 0 ; right: 0; bottom: 0;
            background: linear-gradient(to right, rgba(255,255,255,0.1), rgba(255,255,255,0));
        }

        /* BAGIAN KANAN: PANEL LOGIN FULL HEIGHT */
        .login-panel {
            width: 550px;
            background: rgba(255, 255, 255, 1); /* Diubah ke solid agar input tetap kontras */
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 100px;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.05);
            z-index: 10;
        }

        .local-logo {
            height: 70px;
            margin-bottom: 40px;
            object-fit: contain;
            align-self: flex-start;
        }

        h2 {
            color: #1a1a1a;
            font-weight: 800;
            letter-spacing: -1px;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 40px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid #f3f4f6;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 1rem;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #fff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .input-group-text {
            background: #f9fafb;
            border: 2px solid #f3f4f6;
            border-left: none;
            border-radius: 0 12px 12px 0;
            color: #9ca3af;
            cursor: pointer;
        }

        .btn-login {
            background: #2563eb;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 20px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #1d4ed8;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.3);
        }

        .footer-text {
            margin-top: auto;
            padding-top: 40px;
            color: #9ca3af;
            font-size: 0.75rem;
            text-align: center;
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
        <div style="position: relative; z-index: 5; color: #fff; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        </div>
    </div>  

    <div class="login-panel">
        <img src="{{ asset('assets/img/utb_panjang.png') }}" class="local-logo" alt="Logo UTB">

        <h2>Sistem Akademik</h2>
        <p class="subtitle">Masuk dengan akun Anda untuk mengakses data akademik</p>

        @if($errors->any())
            <div class="alert alert-danger border-0 small py-2 rounded-3 mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label">Username / Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Masukkan NIM atau Email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" 
                           style="border-right:none;" placeholder="••••••••" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100 text-white">
                Masuk Sekarang
            </button>
        </form>

        <div class="footer-text">
            &copy; Copyright by 23552011067_MochamadAlphin_TIF23CNS-A
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle icon class
        const icon = this.querySelector('i');
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>