@extends('layouts.app')

@section('title', 'Edit Pinjaman - KoperasiKu')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit / Persetujuan Pinjaman</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Anggota</label>
                                <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror" required>
                                    @foreach($anggotas as $item)
                                        <option value="{{ $item->id }}" {{ old('anggota_id', $pinjaman->anggota_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }} (NIK: {{ $item->nik }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Pengajuan (Rp)</label>
                                <input type="number" name="jumlah_pengajuan" class="form-control @error('jumlah_pengajuan') is-invalid @enderror" value="{{ old('jumlah_pengajuan', $pinjaman->jumlah_pengajuan) }}" min="100000" required>
                                @error('jumlah_pengajuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Disetujui (Rp)</label>
                                <input type="number" name="jumlah_disetujui" class="form-control @error('jumlah_disetujui') is-invalid @enderror" value="{{ old('jumlah_disetujui', $pinjaman->jumlah_disetujui) }}" placeholder="Biarkan kosong untuk samakan pengajuan">
                                @error('jumlah_disetujui') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Bunga (%)</label>
                                <input type="number" step="0.01" name="bunga_persen" class="form-control @error('bunga_persen') is-invalid @enderror" value="{{ old('bunga_persen', $pinjaman->bunga_persen) }}" required>
                                @error('bunga_persen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tenor (Bulan)</label>
                                <input type="number" name="tenor_bulan" class="form-control @error('tenor_bulan') is-invalid @enderror" value="{{ old('tenor_bulan', $pinjaman->tenor_bulan) }}" min="1" max="120" required>
                                @error('tenor_bulan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Status Pinjaman</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="pengajuan" {{ old('status', $pinjaman->status) === 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                                    <option value="disetujui" {{ old('status', $pinjaman->status) === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ old('status', $pinjaman->status) === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="lunas" {{ old('status', $pinjaman->status) === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                                <a href="{{ route('pinjaman.index') }}" class="btn btn-light border">Batal</a>
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Pinjaman</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection