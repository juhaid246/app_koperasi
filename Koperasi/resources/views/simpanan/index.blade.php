@extends('layouts.app')

@section('title', 'Data Simpanan - KoperasiKu')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold">Data Simpanan</h1>
            <p class="text-muted mb-0">Kelola riwayat simpanan anggota koperasi.</p>
        </div>
        <a href="{{ route('simpanan.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> + Tambah Simpanan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3 border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('simpanan.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari NIK atau Nama Anggota..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search me-1"></i> Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Anggota</th>
                            <th class="py-3">Tgl Simpan</th>
                            <th class="py-3">Jenis Simpanan</th>
                            <th class="py-3">Jumlah</th>
                            <th class="py-3" style="min-width: 160px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($simpanans as $item)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $item->anggota->nama ?? '-' }}</div>
                                    <small class="text-muted">NIK: {{ $item->anggota->nik ?? '-' }}</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_simpan)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $item->jenis_simpanan === 'pokok' ? 'primary' : ($item->jenis_simpanan === 'wajib' ? 'warning' : 'info') }} px-3 py-2">
                                        {{ ucfirst($item->jenis_simpanan) }}
                                    </span>
                                </td>
                                <td class="fw-semibold text-success">
                                    Rp {{ number_format($item->jumlah_simpanan, 0, ',', '.') }}
                                </td>
                                <td>
                                    <a href="{{ route('simpanan.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal" 
                                            data-url="{{ route('simpanan.destroy', $item->id) }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada data simpanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $simpanans->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-1 fs-6">Yakin ingin menghapus data simpanan ini?</p>
                <small class="text-muted">Data yang dihapus tidak bisa dikembalikan.</small>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 fw-semibold">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                document.getElementById('deleteForm').action = url;
            });
        }
    });
</script>
@endsection