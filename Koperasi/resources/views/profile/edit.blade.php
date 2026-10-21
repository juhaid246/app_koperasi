@extends('layouts.app')

@section('title', 'Profil Saya - KoperasiKu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <!-- Header Profil -->
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary-subtle text-primary p-3 rounded-circle me-3">
                    <i class="bi bi-person-gear fs-2"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">Pengaturan Profil</h3>
                    <p class="text-muted mb-0">Perbarui informasi akun dan kata sandi Anda.</p>
                </div>
            </div>

            <!-- Notifikasi Sukses Update Profil -->
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> Informasi profil berhasil diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Notifikasi Sukses Update Password -->
            @if (session('status') === 'password-updated')
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <i class="bi bi-shield-check me-2"></i> Kata sandi berhasil diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- 1. Form Update Informasi Akun -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold"><i class="bi bi-person me-2 text-primary"></i>Informasi Akun</h5>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" class="form-control bg-light @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary px-4 fw-semibold">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <!-- 2. Form Update Kata Sandi (Password) -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold"><i class="bi bi-shield-lock me-2 text-warning"></i>Ubah Kata Sandi</h5>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Kata Sandi Saat Ini</label>
                            <input type="password" class="form-control bg-light @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                            <input type="password" class="form-control bg-light @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="form-control bg-light @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-warning text-dark px-4 fw-semibold">
                            <i class="bi bi-key me-1"></i> Perbarui Kata Sandi
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection