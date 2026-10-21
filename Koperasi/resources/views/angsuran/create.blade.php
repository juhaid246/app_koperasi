@extends('layouts.app')

@section('title', 'Catat Angsuran - KoperasiKu')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold mb-4"><i class="bi bi-plus-circle me-2 text-primary"></i>Catat Pembayaran Angsuran</h4>

                    <form action="{{ route('angsuran.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Pinjaman Anggota</label>
                            <select name="pinjaman_id" class="form-select @error('pinjaman_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Pinjaman (Anggota) --</option>
                                @foreach($pinjamans as $pinjaman)
                                    <option value="{{ $pinjaman->id }}" {{ old('pinjaman_id') == $pinjaman->id ? 'selected' : '' }}>
                                        {{ $pinjaman->anggota->nama ?? 'Anggota #'.$pinjaman->anggota_id }} - Pinjaman: Rp {{ number_format($pinjaman->jumlah_pengajuan, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pinjaman_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Angsuran Ke-</label>
                                <input type="number" name="angsuran_ke" class="form-control @error('angsuran_ke') is-invalid @enderror" value="{{ old('angsuran_ke', 1) }}" min="1" required>
                                @error('angsuran_ke')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Bayar</label>
                                <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                                @error('tanggal_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Tagihan (Rp)</label>
                                <input type="number" name="jumlah_tagihan" class="form-control @error('jumlah_tagihan') is-invalid @enderror" value="{{ old('jumlah_tagihan') }}" placeholder="Contoh: 500000" required>
                                @error('jumlah_tagihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Dibayar (Rp)</label>
                                <input type="number" name="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar') }}" placeholder="Contoh: 500000" required>
                                @error('jumlah_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jatuh Tempo (Opsional)</label>
                                <input type="date" name="jatuh_tempo" class="form-control" value="{{ old('jatuh_tempo') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status Pembayaran</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="sebagian" {{ old('status') == 'sebagian' ? 'selected' : '' }}>Sebagian</option>
                                    <option value="tertunggak" {{ old('status') == 'tertunggak' ? 'selected' : '' }}>Tertunggak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('angsuran.index') }}" class="btn btn-light border px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-semibold">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection