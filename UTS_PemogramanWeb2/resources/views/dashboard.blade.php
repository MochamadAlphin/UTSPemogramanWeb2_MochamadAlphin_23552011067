@extends('layouts.app')

@section('content')
<style>
    /* Background Page yang konsisten dengan login */
    body {
        background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                    url("{{ asset('assets/img/utb_ilustrasi_imut.png') }}");
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }

    .welcome-card {
        background: linear-gradient(135deg, #2d2a70 0%, #1a184a 100%);
        color: white;
        border-radius: 24px;
        padding: 40px;
        position: relative;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(45, 42, 112, 0.2);
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.04);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.08);
    }

    .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 20px;
    }

    .bg-light-blue { background: #eef2ff; color: #2d2a70; }
    .bg-light-orange { background: #fff4ed; color: #fd7e14; }
    .bg-light-green { background: #f0fdf4; color: #166534; }

    .chart-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
    }
</style>

<div class="container-fluid py-2">
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="opacity-75 mb-0">Panel kendali akademik Universitas Teknologi Bandung. Pantau distribusi data mahasiswa, jurusan, dan mata kuliah secara real-time.</p>
                    </div>
                </div>
                <i class="bi bi-mortarboard-fill" style="position: absolute; right: 30px; top: 10px; font-size: 150px; color: rgba(255,255,255,0.1);"></i>
            </div>
        </div>
    </div>

    <div class="row mb-4 g-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-box bg-light-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Total Mahasiswa</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $countMhs }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-box bg-light-orange">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Total Jurusan</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $countJurusan }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-box bg-light-green">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Mata Kuliah</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $countMK }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">Visualisasi Data Akademik</h5>
                        <p class="text-muted small mb-0">Perbandingan jumlah entitas yang terdaftar di database.</p>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 px-3 rounded-pill small">
                        <i class="bi bi-bar-chart-fill me-1"></i> Data Live
                    </span>
                </div>
                
                <div style="height: 350px;">
                    <canvas id="academicChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('academicChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mahasiswa', 'Jurusan', 'Mata Kuliah'],
            datasets: [{
                label: 'Jumlah Data',
                data: [{{ $countMhs }}, {{ $countJurusan }}, {{ $countMK }}],
                backgroundColor: [
                    'rgba(45, 42, 112, 0.8)', // UTB Blue
                    'rgba(253, 126, 20, 0.8)', // UTB Orange
                    'rgba(22, 101, 52, 0.8)'   // Green
                ],
                borderColor: [
                    '#2d2a70',
                    '#fd7e14',
                    '#166534'
                ],
                borderWidth: 2,
                borderRadius: 10,
                barThickness: 60
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Sembunyikan label dataset karena sudah jelas
                },
                tooltip: {
                    padding: 12,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        stepSize: 1, // Karena data adalah jumlah orang/benda (bulat)
                        font: { size: 12 }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: { size: 12, weight: '600' }
                    }
                }
            }
        }
    });
</script>
@endsection