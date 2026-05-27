<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\KatalogRuanganController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ManajemenKontakController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManajemenMahasiswa;
use App\Http\Controllers\ManajemenPeminjaman;
use App\Http\Controllers\ManajemenRuang;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TentangController;


Route::get('/', function () {
    $count = session('visit_count', 0) + 1;
    session(['visit_count' => $count]);

    if (!session()->has('first_visit')) {
        session(['first_visit' => now()->translatedFormat('d M Y, H:i:s')]);
    }

    session(['last_visit' => now()->translatedFormat('d M Y, H:i:s')]);

    return view('welcome');
})->name('home');

Route::post('/reset-kunjungan', function () {
    session()->forget(['visit_count', 'first_visit', 'last_visit']);
    return redirect()->back()->with('welcome_toast', 'Statistik kunjungan berhasil di-ulang dari awal!');
})->name('kunjungan.reset');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/tentang/ruangan/{lantai}/{kapasitas}', [TentangController::class, 'filterRuangan']);
Route::get('/kontak', function () { return view('kontak'); })->name('kontak');
Route::get('/ruangan', [KatalogRuanganController::class, 'index'])->name('ruangan.index');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/ruangan/{lantai}/{id}', [KatalogRuanganController::class, 'show'])->name('ruangan.show');
Route::get('/preferensi', [PreferensiController::class, 'index'])->name('preferensi.index');
Route::post('/api/preferensi/simpan', [PreferensiController::class, 'store'])->name('preferensi.store');
Route::post('/chat', [ChatbotController::class, 'chat']);


Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b)->name('hitung');
Route::middleware(['auth', 'cek.admin'])->group(function () {
    Route::get('/manajemen-ruang', [ManajemenRuang::class, 'index'])->name('manajemen-ruang');
    Route::get('/manajemen-ruang/create', [ManajemenRuang::class, 'create'])->name('manajemen-ruang.create');
    Route::post('/manajemen-ruang', [ManajemenRuang::class, 'store'])->name('manajemen-ruang.store');
    Route::delete('/manajemen-ruang/{id}', [ManajemenRuang::class, 'destroy'])->name('manajemen-ruang.destroy');
    Route::post('/api/fasilitas', [ManajemenRuang::class, 'storeFasilitas'])->name('api.fasilitas.store');
    Route::delete('/api/fasilitas/{id}', [ManajemenRuang::class, 'destroyFasilitas'])->name('api.fasilitas.destroy');
    Route::get('/manajemen-ruang/{id}/edit', [ManajemenRuang::class, 'edit'])->name('manajemen-ruang.edit');
    Route::put('/manajemen-ruang/{id}', [ManajemenRuang::class, 'update'])->name('manajemen-ruang.update');
    Route::get('/manajemen-ruang/{id}', [ManajemenRuang::class, 'show'])->name('manajemen-ruang.show');

    Route::get('/manajemen-peminjaman', [ManajemenPeminjaman::class, 'index'])->name('manajemen-peminjaman');
    Route::patch('/manajemen-booking/{id}/status', [ManajemenPeminjaman::class, 'updateStatus'])->name('manajemen-booking.status');
    Route::get('/dashboard', function () {
        session()->flash('success', 'Selamat datang kembali! Dashboard berhasil dimuat.');

        return view('dashboard');
    })->name('dashboard');

    // Manajemen mahasiswa
    Route::get('/manajemen-mahasiswa', [ManajemenMahasiswa::class, 'index'])->name('manajemen-mahasiswa');
    Route::get('/manajemen-mahasiswa/create', [ManajemenMahasiswa::class, 'create'])->name('manajemen-mahasiswa.create');
    Route::post('/manajemen-mahasiswa', [ManajemenMahasiswa::class, 'store'])->name('manajemen-mahasiswa.store');
    Route::get('/manajemen-mahasiswa/{mahasiswa}', [ManajemenMahasiswa::class, 'show'])->name('manajemen-mahasiswa.show');
    Route::get('/manajemen-mahasiswa/{mahasiswa}/edit', [ManajemenMahasiswa::class, 'edit'])->name('manajemen-mahasiswa.edit');
    Route::put('/manajemen-mahasiswa/{mahasiswa}', [ManajemenMahasiswa::class, 'update'])->name('manajemen-mahasiswa.update');
    Route::delete('/manajemen-mahasiswa/{mahasiswa}', [ManajemenMahasiswa::class, 'destroy'])->name('manajemen-mahasiswa.destroy');

    // manajemen kontak
    Route::get('/manajemen-kontak', [ManajemenKontakController::class, 'index'])->name('manajemen-kontak');
});


Route::middleware('auth')->group(function () {

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::post('/booking/{ruangan}', [BookingController::class, 'store'])->name('booking.store');
    Route::patch('/booking/{id}/batal', [BookingController::class, 'batalBooking'])->name('booking.batal');
});

require __DIR__ . '/auth.php';
