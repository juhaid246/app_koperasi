@extends('layouts.app')

@section('title', 'Masuk Akun - KoperasiKu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    <!-- Logo / Icon Header -->
                    <div class="text-center mb-4">
                        <div class="bg-primary-subtle text-primary d-inline-flex p-3 rounded-circle mb-3">
                            <i class="bi bi-bank fs-1"></i>
                        </div>
                        <h4 class="fw-bold text-dark">KoperasiKu</h4>
                        <p class="text-muted small">Masuk ke akun kamu untuk mengakses sistem</p>
                    </div>

                    <!-- Session Status Error/Success -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label fw-semibold mb-0">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none">Lupa password?</a>
                                @endif
                            </div>
                            <div class="input-group mt-1">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label small text-muted" for="remember_me">Ingat saya di perangkat ini</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-2.5 fw-bold shadow-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                        </button>
                    </form>

                    @if (Route::has('register'))
                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="small text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Daftar Anggota</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection