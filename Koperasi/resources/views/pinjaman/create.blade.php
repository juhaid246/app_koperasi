@extends('layouts.app')

@section('title', 'Tambah Pinjaman - KoperasiKu')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-plus-circle me-2"></i>Form Pengajuan Pinjaman</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pinjaman.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Pilih Anggota</label>
                                <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach($anggotas as $item)
                                        <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }} (NIK: {{ $item->nik }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Jumlah Pengajuan (Rp)</label>
                                <input type="number" name="jumlah_pengajuan" class="form-control @error('jumlah_pengajuan') is-invalid @enderror" value="{{ old('jumlah_pengajuan') }}" placeholder="Contoh: 5000000" min="100000" required>
                                @error('jumlah_pengajuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Bunga (%)</label>
                                <input type="number" step="0.01" name="bunga_persen" class="form-control @error('bunga_persen') is-invalid @enderror" value="{{ old('bunga_persen', 0) }}" required>
                                @error('bunga_persen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tenor (Bulan)</label>
                                <input type="number" name="tenor_bulan" class="form-control @error('tenor_bulan') is-invalid @enderror" value="{{ old('tenor_bulan', 12) }}" min="1" max="120" required>
                                @error('tenor_bulan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                                <a href="{{ route('pinjaman.index') }}" class="btn btn-light border">Batal</a>
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Pengajuan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection