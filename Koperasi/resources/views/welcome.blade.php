@extends('layouts.app')

@section('title', 'KoperasiKu - Beranda')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="card-body">
                    <!-- Header KoperasiKu -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary-subtle text-primary p-3 rounded-3 me-3">
                            <i class="bi bi-bank fs-2"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">KoperasiKu</h3>
                            <p class="text-muted mb-0">Aplikasi manajemen koperasi simpan pinjam berbasis web</p>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <!-- Grid 4 Fitur Utama Modul -->
                    <div class="row g-4">
                        <!-- Manajemen Anggota -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="fs-3 text-dark me-3">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Manajemen anggota</h6>
                                    <small class="text-muted">Registrasi, profil, status anggota</small>
                                </div>
                            </div>
                        </div>

                        <!-- Simpanan -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="fs-3 text-dark me-3">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Simpanan</h6>
                                    <small class="text-muted">Pokok, wajib, sukarela</small>
                                </div>
                            </div>
                        </div>

                        <!-- Pinjaman -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="fs-3 text-dark me-3">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Pinjaman</h6>
                                    <small class="text-muted">Pengajuan dan persetujuan</small>
                                </div>
                            </div>
                        </div>

                        <!-- Angsuran dan Laporan -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="fs-3 text-dark me-3">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Angsuran dan laporan</h6>
                                    <small class="text-muted">Pembayaran, tunggakan, rekap transaksi</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi Akses -->
                    <div class="mt-5 pt-3 border-top text-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 fw-semibold">
                                <i class="bi bi-speedometer2 me-1"></i> Masuk ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary px-4 me-2 fw-semibold">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4 fw-semibold">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection