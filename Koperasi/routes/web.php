<?php
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dan Pengurus
Route::middleware(['auth', 'role:admin,pengurus'])->group(function () {
    // Route CRUD Anggota
    Route::resource('anggota', AnggotaController::class)->parameters([
        'anggota' => 'anggota'
    ]);
});

// Admin dan Bendahara
Route::middleware(['auth', 'role:admin,bendahara'])->group(function () {
    Route::resource('simpanan', SimpananController::class);
    Route::resource('angsuran', AngsuranController::class);
});


// Admin, Pengurus, dan Bendahara
Route::middleware(['auth', 'role:admin,pengurus,bendahara'])->group(function () {
    Route::resource('pinjaman', PinjamanController::class)->parameters([
        'pinjaman' => 'pinjaman'
    ]);
});

// Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
