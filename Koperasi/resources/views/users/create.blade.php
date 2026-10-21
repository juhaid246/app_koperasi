@extends('layouts.app')

@section('title', 'Tambah User - KoperasiKu')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 mb-0 fw-bold">Tambah User Baru</h1>
        <p class="text-muted mb-0">Buat akun baru untuk pengguna sistem.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Role Hak Akses</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="bendahara" {{ old('role') === 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                            <option value="anggota" {{ old('role') === 'anggota' ? 'selected' : '' }}>Anggota</option>
                            <option value="pengurus" {{ old('role') === 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Akun Langsung Aktif
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Simpan User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection