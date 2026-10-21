@extends('layouts.app')

@section('title', 'Tambah Simpanan - KoperasiKu')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Simpanan Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('simpanan.store') }}" method="POST">
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

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Simpanan</label>
                                <select name="jenis_simpanan" class="form-select @error('jenis_simpanan') is-invalid @enderror" required>
                                    <option value="pokok" {{ old('jenis_simpanan') === 'pokok' ? 'selected' : '' }}>Simpanan Pokok</option>
                                    <option value="wajib" {{ old('jenis_simpanan') === 'wajib' ? 'selected' : '' }}>Simpanan Wajib</option>
                                    <option value="sukarela" {{ old('jenis_simpanan') === 'sukarela' ? 'selected' : '' }}>Simpanan Sukarela</option>
                                </select>
                                @error('jenis_simpanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Simpan</label>
                                <input type="date" name="tanggal_simpan" class="form-control @error('tanggal_simpan') is-invalid @enderror" value="{{ old('tanggal_simpan', date('Y-m-d')) }}" required>
                                @error('tanggal_simpan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Jumlah Simpanan (Rp)</label>
                                <input type="number" name="jumlah_simpanan" class="form-control @error('jumlah_simpanan') is-invalid @enderror" value="{{ old('jumlah_simpanan') }}" placeholder="Contoh: 100000" min="1000" required>
                                @error('jumlah_simpanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                                <a href="{{ route('simpanan.index') }}" class="btn btn-light border">Batal</a>
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection