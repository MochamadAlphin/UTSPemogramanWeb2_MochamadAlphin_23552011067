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

    /* Overlay agar background tidak terlalu kontras */
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
        transform: scale(1.01);
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .table-modern tbody td {
        padding: 15px;
        border: none;
        vertical-align: middle;
    }

    .table-modern tbody td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tbody td:last-child { border-radius: 0 15px 15px 0; }

    .btn-action {
        width: 38px; height: 38px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 12px; background: #f8f9fa; border: 1px solid #eee; transition: all 0.2s;
        cursor: pointer;
    }
    .btn-edit:hover { background: #fff9e6; color: #ffc107; border-color: #ffc107; }
    .btn-delete:hover { background: #fff5f6; color: #dc3545; border-color: #dc3545; }

    /* Search Input Styling */
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
    .form-control { 
        border: 2px solid #f3f4f6; 
        padding: 14px; 
        border-radius: 14px; 
        transition: all 0.2s;
    }
    .form-control:focus { 
        border-color: #ed6b23; 
        box-shadow: 0 0 0 4px rgba(237, 107, 35, 0.1); 
    }
</style>

<div class="container container-main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="header-title mb-1">Data Program Studi</h2>
            <p class="text-muted small mb-0">Kelola daftar jurusan di Universitas Teknologi Bandung</p>
        </div>
        <button class="btn btn-utb shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJurusan">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Jurusan
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px; background: #dcfce7; color: #166534;">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    </div>
    @endif

    <div class="custom-card">
        {{-- Search Input Section --}}
        <div class="mb-4">
            <div class="input-group search-container" style="max-width: 400px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari ID atau Nama Jurusan...">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-modern align-middle" id="jurusanTable">
                <thead>
                    <tr>
                        <th class="ps-4">ID JURUSAN</th>
                        <th>NAMA JURUSAN</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusan as $j)
                    <tr class="jurusan-row">
                        <td class="ps-4 fw-bold text-dark id-text">#{{ $j->id_jurusan }}</td>
                        <td class="fw-semibold nama-text" style="color: #2d2a70;">{{ $j->nama_jurusan }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn-action btn-edit text-warning" 
                                        data-bs-toggle="modal" data-bs-target="#modalEdit{{ $j->id_jurusan }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <form action="{{ route('jurusan.destroy', $j->id_jurusan) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete text-danger" 
                                            onclick="return confirm('Hapus jurusan {{ $j->nama_jurusan }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="3" class="text-center py-5 text-muted">Belum ada data jurusan.</td>
                    </tr>
                    @endforelse
                    {{-- Row untuk hasil pencarian tidak ditemukan --}}
                    <tr id="noResultRow" style="display: none;">
                        <td colspan="3" class="text-center py-5 text-muted">Data jurusan tidak ditemukan.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahJurusan" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold" style="color: #2d2a70;">Tambah Jurusan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" class="form-control" placeholder="Contoh: Informatika" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-utb">Simpan Jurusan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($jurusan as $j)
<div class="modal fade" id="modalEdit{{ $j->id_jurusan }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $j->id_jurusan }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-bold" style="color: #2d2a70;">Edit Nama Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('jurusan.update', $j->id_jurusan) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" class="form-control" value="{{ $j->nama_jurusan }}" required>
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

{{-- LOGIKA SEARCH REAL-TIME --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('.jurusan-row');
        const noResultRow = document.getElementById('noResultRow');
        const emptyRow = document.getElementById('emptyRow');

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            let visibleCount = 0;

            tableRows.forEach(row => {
                const idText = row.querySelector('.id-text').textContent.toLowerCase();
                const namaText = row.querySelector('.nama-text').textContent.toLowerCase();

                // Cek apakah input cocok dengan ID atau Nama Jurusan
                if (idText.includes(filter) || namaText.includes(filter)) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });

            // Sembunyikan/Tampilkan pesan error jika data tidak ada
            if (visibleCount === 0 && filter !== "") {
                noResultRow.style.display = "";
                if(emptyRow) emptyRow.style.display = "none";
            } else {
                noResultRow.style.display = "none";
                if(emptyRow && filter === "") emptyRow.style.display = "";
            }
        });
    });
</script>

@endsection