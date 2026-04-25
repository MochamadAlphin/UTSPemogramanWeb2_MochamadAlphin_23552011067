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
        :root {
            --utb-blue: #2d2a70;
            --utb-orange: #ed6b23;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            box-shadow: 4px 0 15px rgba(0,0,0,0.03);
            z-index: 1000;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 10px 15px;
            margin-bottom: 30px;
            border-bottom: 1px solid #f3f4f6;
        }

        .nav-link {
            color: #6b7280;
            font-weight: 600;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border: none;
            background: none;
            width: 100%;
            text-decoration: none;
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(45, 42, 112, 0.05);
            color: var(--utb-blue);
        }

        .nav-link.active {
            background: var(--utb-blue) !important;
            color: white !important;
        }

        .nav-link.text-danger:hover {
            background: #fff5f6;
            color: #dc3545 !important;
        }

        /* Main Content Adjustment */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            padding: 20px;
        }

        .top-navbar {
            background: white;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer {
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand text-center">
        <img src="{{ asset('assets/img/utb_panjang.png') }}" alt="Logo" style="height: 50px;">
    </div>
    
    <div class="nav flex-column mb-auto">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Mahasiswa
        </a>

        <a href="{{ route('jurusan.index') }}" class="nav-link {{ request()->is('jurusan*') ? 'active' : '' }}">
            <i class="bi bi-mortarboard"></i> Jurusan
        </a>

        <a href="{{ route('matakuliah.index') }}" class="nav-link {{ request()->is('matakuliah*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> Mata Kuliah
        </a>
    </div>

    <div class="border-top pt-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100" style="text-align: left;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-wrapper">
    <header class="top-navbar">
        <h5 class="mb-0 fw-bold text-dark">Sistem Informasi Akademik</h5>
        <div class="d-flex align-items-center">
            <span class="me-3 small text-muted">Halo, <strong>{{ Auth::user()->name }}</strong></span>
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                <i class="bi bi-person text-dark"></i>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        @yield('content')
    </div>

    <footer class="text-center mt-5 py-4 text-muted small">
        &copy; 2026 &bull; <strong>23552011067_MochamadAlphin_TIF23CNS-A</strong>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>