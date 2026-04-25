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
        background: #ed6b23;
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

    .badge-sks {
        background: rgba(45, 42, 112, 0.1);
        color: #2d2a70;
        font-weight: 700;
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 0.85rem;
    }

    .badge-jurusan {
        background: #fff4ed;
        color: #ed6b23;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        border: 1px solid rgba(237, 107, 35, 0.2);
    }

    .btn-action {
        width: 38px; height: 38px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 12px; background: #f8f9fa; border: 1px solid #eee; transition: all 0.2s;
    }
    .btn-edit:hover { background: #fff9e6; color: #ffc107; border-color: #ffc107; }
    .btn-delete:hover { background: #fff5f6; color: #dc3545; border-color: #dc3545; }

    .modal-content { 
        border-radius: 24px; 
        border: none; 
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
    }
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
            <h2 class="header-title mb-1">Mata Kuliah</h2>
            <p class="text-muted small mb-0">Manajemen kurikulum per program studi UTB</p>
        </div>
        <button class="btn btn-utb shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah MK
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px; background: #dcfce7; color: #166534;">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    </div>
    @endif

    <div class="custom-card">
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>NAMA MATA KULIAH</th>
                        <th>PROGRAM STUDI</th>
                        <th>BOBOT</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matakuliah as $mk)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">#{{ $mk->id_matakuliah }}</td>
                        <td class="fw-semibold" style="color: #2d2a70;">{{ $mk->nama_matakuliah }}</td>
                        <td>
                            <span class="badge-jurusan">
                                <i class="bi bi-mortarboard-fill me-1"></i>
                                {{ $mk->jurusan->nama_jurusan ?? 'Tidak Ada Jurusan' }}
                            </span>
                        </td>
                        <td><span class="badge-sks">{{ $mk->sks }} SKS</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn-action btn-edit text-warning" 
                                        data-bs-toggle="modal" data-bs-target="#modalEdit{{ $mk->id_matakuliah }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <form action="{{ route('matakuliah.destroy', $mk->id_matakuliah) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete text-danger" 
                                            onclick="return confirm('Hapus mata kuliah {{ $mk->nama_matakuliah }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold" style="color: #2d2a70;">Tambah Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" class="form-control" placeholder="Contoh: Pemrograman Web" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Pilih Jurusan</label>
                        <select name="id_jurusan" class="form-select" required>
                            <option value="" disabled selected>Pilih Program Studi...</option>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold small text-muted text-uppercase">Jumlah SKS</label>
                        <input type="number" name="sks" class="form-control" placeholder="Contoh: 3" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-utb">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($matakuliah as $mk)
<div class="modal fade" id="modalEdit{{ $mk->id_matakuliah }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold" style="color: #2d2a70;">Edit Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('matakuliah.update', $mk->id_matakuliah) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" class="form-control" value="{{ $mk->nama_matakuliah }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Pilih Jurusan</label>
                        <select name="id_jurusan" class="form-select" required>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}" {{ $mk->id_jurusan == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold small text-muted text-uppercase">Jumlah SKS</label>
                        <input type="number" name="sks" class="form-control" value="{{ $mk->sks }}" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-utb">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection