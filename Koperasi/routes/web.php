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
Route::resource('anggotas', AnggotaController::class);
Route::resource('simpanans', SimpananController::class);

Route::middleware('role:admin')->group(function () {
    Route::resource('users', UserController::class);
}); // <-- Kurung kurawal penutup group ditambahkan di sini

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dan Pengurus
Route::middleware(['auth', 'role:admin,pengurus'])->group(function () {
    // Route CRUD Anggota
    Route::resource('anggota', AnggotaController::class)->parameters(['anggota' => 'anggota']);
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
});

// Admin dan Bendahara
Route::middleware(['auth', 'role:admin,bendahara'])->group(function () {
    Route::resource('simpanan', SimpananController::class);
    Route::resource('angsuran', AngsuranController::class);
});


// Admin, Pengurus, dan Bendahara
Route::middleware(['auth', 'role:admin,pengurus,bendahara'])->group(function () {
    
    // Aksi khusus pinjaman (harus diletakkan di atas resource)
    Route::post('/pinjaman/{pinjaman}/approve', [PinjamanController::class, 'approve'])->name('pinjaman.approve');
    Route::post('/pinjaman/{pinjaman}/reject', [PinjamanController::class, 'reject'])->name('pinjaman.reject');
    Route::post('/pinjaman/{pinjaman}/disburse', [PinjamanController::class, 'disburse'])->name('pinjaman.disburse');
    Route::post('/pinjaman/{pinjaman}/paid', [PinjamanController::class, 'markPaid'])->name('pinjaman.paid');
    Route::post('/pinjaman/{pinjaman}/cancel', [PinjamanController::class, 'cancel'])->name('pinjaman.cancel');

    // Resource Route
    Route::resource('pinjaman', PinjamanController::class)->parameters([
        'pinjaman' => 'pinjaman'
    ]);

});

// Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
