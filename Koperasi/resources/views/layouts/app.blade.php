<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KoperasiKu')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }
        .card {
            border-radius: 12px;
            border: none;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
        }
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                <i class="bi bi-wallet2 me-2"></i>KoperasiKu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <!-- MENU KIRI (Teks Link Navbar Sesuai Role) -->
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        @if(in_array(auth()->user()->role, ['admin', 'pengurus']))
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('anggota.index') }}">Data Anggota</a>
                            </li>
                        @endif

                        @if(in_array(auth()->user()->role, ['admin', 'bendahara']))
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('simpanan.index') }}">Data Simpanan</a>
                            </li>
                        @endif

                        @if(in_array(auth()->user()->role, ['admin', 'pengurus', 'bendahara']))
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('pinjaman.index') }}">Data Pinjaman</a>
                            </li>
                        @endif
                        @if(in_array(auth()->user()->role, ['admin', 'bendahara']))
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('angsuran.index') }}">Data Angsuran</a>
                            </li>
                        @endif
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('users.index') }}">Kelola User</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- MENU KANAN (Nama User, Profil & Form Logout) -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2 text-muted"></i> Profil Saya
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar (Logout)
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <!-- Tampil Jika Belum Login -->
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold" href="{{ route('login') }}">Masuk</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('register') }}">Daftar</a>
                            </li>
                        @endif
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA HALAMAN (Dashboard, Form, Tabel, dll) MASUK KE SINI -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS (Wajib ada agar dropdown & tombol menu HP bisa diklik) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>