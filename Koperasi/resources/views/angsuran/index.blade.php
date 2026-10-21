@extends('layouts.app')

@section('title', 'Data Angsuran - KoperasiKu')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="bi bi-receipt me-2 text-primary"></i>Data Angsuran</h3>
            <p class="text-muted mb-0">Kelola riwayat pembayaran cicilan pinjaman anggota.</p>
        </div>
        <a href="{{ route('angsuran.create') }}" class="btn btn-primary fw-semibold shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Catat Pembayaran
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('angsuran.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari nama anggota atau NIK..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-primary px-4" type="submit">Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Anggota</th>
                            <th>Angsuran Ke</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Tagihan</th>
                            <th>Jumlah Bayar</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($angsurans as $index => $item)
                            <tr>
                                <td>{{ $angsurans->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold">{{ $item->pinjaman->anggota->nama ?? '-' }}</div>
                                    <small class="text-muted">NIK: {{ $item->pinjaman->anggota->nik ?? '-' }}</small>
                                </td>
                                <td><span class="badge bg-secondary">Ke-{{ $item->angsuran_ke }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}</td>
                                <td>Rp {{ number_format($item->jumlah_tagihan, 0, ',', '.') }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->status == 'lunas')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1">Lunas</span>
                                    @elseif($item->status == 'sebagian')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1">Sebagian</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1">Tertunggak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('angsuran.edit', $item->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('angsuran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data angsuran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada data angsuran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $angsurans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection