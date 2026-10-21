@extends('layouts.app')

@section('title', 'Dashboard - KoperasiKu')

@section('content')
<div class="container py-4">
    <!-- Header / Banner Selamat Datang -->
    <div class="card border-0 bg-primary text-white shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2"><i class="bi bi-speedometer2 me-2"></i>Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="mb-0 opacity-75">
                    Anda masuk sebagai <span class="badge bg-light text-primary fw-bold text-uppercase px-3 py-2 ms-1">{{ Auth::user()->role }}</span>
                </p>
            </div>
            <div class="d-none d-md-block fs-1 opacity-50">
                <i class="bi bi-bank2"></i>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik (Stat Cards) -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary-subtle text-primary p-3 rounded-3 me-3">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-semibold text-uppercase">Total Anggota</small>
                        <h3 class="fw-bold mb-0">{{ \App\Models\Anggota::count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success-subtle text-success p-3 rounded-3 me-3">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-semibold text-uppercase">Total Simpanan</small>
                        <h3 class="fw-bold mb-0">
                            Rp {{ number_format(\App\Models\Simpanan::sum('jumlah_simpanan'), 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-warning-subtle text-warning p-3 rounded-3 me-3">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-semibold text-uppercase">Total Pinjaman</small>
                        <h3 class="fw-bold mb-0">
                            Rp {{ number_format(\App\Models\Pinjaman::sum('jumlah_pengajuan'), 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Akses Cepat / Pintasan Fitur Sesuai Role -->
    @if(auth()->user()->role !== 'anggota')
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-grid-fill text-primary me-2"></i>Pintasan Modul</h5>
        <div class="row g-3">
            
            {{-- Hanya Admin & Pengurus --}}
            @if(in_array(auth()->user()->role, ['admin', 'pengurus']))
                <div class="col-md-4">
                    <a href="{{ route('anggota.index') }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-people fs-2 text-primary me-3"></i>
                                    <h6 class="fw-bold text-dark mb-0">Kelola Anggota</h6>
                                </div>
                                <p class="text-muted small mb-0">Lihat, tambah, dan sunting data anggota koperasi.</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- Hanya Admin & Bendahara --}}
            @if(in_array(auth()->user()->role, ['admin', 'bendahara']))
                <div class="col-md-4">
                    <a href="{{ route('simpanan.index') }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-wallet2 fs-2 text-success me-3"></i>
                                    <h6 class="fw-bold text-dark mb-0">Kelola Simpanan</h6>
                                </div>
                                <p class="text-muted small mb-0">Catat transaksi simpanan pokok, wajib, dan sukarela.</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- Admin, Pengurus, & Bendahara --}}
            @if(in_array(auth()->user()->role, ['admin', 'pengurus', 'bendahara']))
                <div class="col-md-4">
                    <a href="{{ route('pinjaman.index') }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-cash-coin fs-2 text-warning me-3"></i>
                                    <h6 class="fw-bold text-dark mb-0">Kelola Pinjaman</h6>
                                </div>
                                <p class="text-muted small mb-0">Pengajuan, persetujuan tenor, dan kalkulasi bunga.</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

        </div>
    @else
        {{-- Tampilan Khusus Jika yang Login adalah Anggota --}}
        <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 mt-2">
            <h5 class="fw-bold text-dark"><i class="bi bi-info-circle-fill text-info me-2"></i>Informasi Keanggotaan</h5>
            <p class="mb-0 text-dark">Selamat datang di KoperasiKu. Saat ini Anda masuk sebagai <strong>Anggota</strong>. Segala bentuk proses pencatatan data simpanan dan pengajuan pinjaman dikelola secara langsung oleh pihak Pengurus dan Bendahara koperasi.</p>
        </div>
    @endif
</div>

<style>
    .card-hover {
        transition: transform 0.2s ease, shadow 0.2s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
</style>
@endsection