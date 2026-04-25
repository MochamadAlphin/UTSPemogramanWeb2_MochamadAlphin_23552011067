@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8f9fa;
        background-image: url("{{ asset('assets/img/utb_bg.png') }}"); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* Overlay agar konten tetap terbaca jelas */
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(248, 249, 250, 0.85);
        z-index: -1;
    }

    .container-main { padding: 40px 20px; }

    .header-title {
        color: #2d2a70;
        font-weight: 800;
        letter-spacing: -1px;
        font-size: 1.75rem;
    }

    .custom-card {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(45, 42, 112, 0.08);
        padding: 30px;
        backdrop-filter: blur(10px);
    }

    .btn-utb {
        background: #005aff;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 14px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-utb:hover {
        background: #d85a1a;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(237, 107, 35, 0.3);
        color: white;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .table-modern thead th {
        border: none;
        color: #6b7280;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 15px;
    }

    .table-modern tbody tr {
        background: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        transition: all 0.2s;
    }

    .table-modern tbody tr:hover {
        transform: scale(1.005);
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .table-modern tbody td {
        padding: 15px;
        border: none;
        vertical-align: middle;
    }

    .table-modern tbody td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tbody td:last-child { border-radius: 0 15px 15px 0; }

    .badge-jurusan {
        background: rgba(45, 42, 112, 0.1);
        color: #2d2a70;
        font-weight: 700;
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 0.85rem;
    }

    .btn-action {
        width: 38px; height: 38px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 12px; background: #f8f9fa; border: 1px solid #eee; transition: all 0.2s;
    }
    .btn-edit:hover { background: #fff9e6; color: #ffc107; border-color: #ffc107; }
    .btn-delete:hover { background: #fff5f6; color: #dc3545; border-color: #dc3545; }

    /* Search Input */
    .search-container .form-control {
        border: 2px solid #f3f4f6;
        border-radius: 14px 0 0 14px;
        padding: 12px 20px;
    }
    .search-container .input-group-text {
        border: 2px solid #f3f4f6;
        border-left: none;
        border-radius: 0 14px 14px 0;
        background: white;
        color: #9ca3af;
    }

    /* Modal Styling */
    .modal-content { 
        border-radius: 24px; 
        border: none; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
    }
    .modal-header { padding: 25px 30px 10px; }
    .form-control, .form-select { 
        border: 2px solid #f3f4f6; 
        padding: 14px; 
        border-radius: 14px; 
    }
    .form-control:focus, .form-select:focus { 
        border-color: #ed6b23; 
        box-shadow: 0 0 0 4px rgba(237, 107, 35, 0.1); 
    }
</style>

<div class="container container-main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="header-title mb-1">Manajemen Mahasiswa</h2>
            <p class="text-muted small mb-0">Kelola data akademik mahasiswa Universitas Teknologi Bandung</p>
        </div>
        <button class="btn btn-utb shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Mahasiswa
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px; background: #dcfce7; color: #166534;">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    </div>
    @endif

    <div class="custom-card">
        {{-- Search Filter --}}
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-4">
            <div class="input-group search-container" style="max-width: 400px;">
                <input type="text" name="search" class="form-control" placeholder="Cari NIM atau Nama..." value="{{ request('search') }}">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">NIM</th>
                        <th>NAMA LENGKAP</th>
                        <th>JURUSAN</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $mhs)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $mhs->nim }}</td>
                        <td class="fw-semibold" style="color: #2d2a70;">{{ $mhs->nama }}</td>
                        <td><span class="badge-jurusan">{{ $mhs->jurusan->nama_jurusan }}</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn-action btn-edit text-warning" 
                                        data-bs-toggle="modal" data-bs-target="#modalEdit{{ $mhs->id_mahasiswa }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('mahasiswa.destroy', $mhs->id_mahasiswa) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete text-danger" 
                                            onclick="return confirm('Hapus data mahasiswa {{ $mhs->nama }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Data mahasiswa tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{ $mahasiswa->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="fw-bold" style="color: #2d2a70;">Tambah Mahasiswa Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Contoh: 23552011..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Mahasiswa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Jurusan</label>
                        <select name="id_jurusan" class="form-select" required>
                            <option value="" disabled selected>Pilih Jurusan...</option>
                            @foreach($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-utb">Simpan Mahasiswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($mahasiswa as $mhs)
<div class="modal fade" id="modalEdit{{ $mhs->id_mahasiswa }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="fw-bold" style="color: #2d2a70;">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mahasiswa.update', $mhs->id_mahasiswa) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">NIM</label>
                        <input type="text" name="nim" class="form-control bg-light" value="{{ $mhs->nim }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $mhs->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Jurusan</label>
                        <select name="id_jurusan" class="form-select">
                            @foreach($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}" {{ $mhs->id_jurusan == $j->id_jurusan ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-utb">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection