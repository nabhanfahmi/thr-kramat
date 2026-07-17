<?php

use Illuminate\Support\Facades\Route;

// ================= CONTROLLER =================

// ADMIN
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PemesananController;

// USER
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserGaleriController;
use App\Http\Controllers\User\TiketPemesananController;
use App\Http\Controllers\User\UserTiketController;
use App\Http\Controllers\User\UserBeritaController;
use App\Http\Controllers\User\MidtransCallbackController;
use App\Http\Controllers\User\ProfileController;

// PENGELOLA
use App\Http\Controllers\Pengelola\PemesananController as PengelolaPemesananController;
use App\Http\Controllers\Pengelola\LoginController as PengelolaLoginController;
use App\Http\Controllers\Pengelola\RegisterController as PengelolaRegisterController;
use App\Http\Controllers\Pengelola\DashboardController as PengelolaDashboardController;
use App\Http\Controllers\Pengelola\LaporanController;

// PETUGAS
use App\Http\Controllers\Petugas\LoginController as PetugasLoginController;
use App\Http\Controllers\Petugas\RegisterController as PetugasRegisterController;
use App\Http\Controllers\Petugas\PetugasController;


// ================= HALAMAN UTAMA =================

Route::get('/', [UserGaleriController::class, 'index'])->name('home');

Route::view('/daftar', 'daftar')->name('daftar');


// ================= BERITA =================

Route::get('/berita/{id}', [UserBeritaController::class, 'show'])
    ->name('berita.show');


// ================= TEST MIDTRANS =================

if (app()->environment('local')) {

Route::get('/test-midtrans', function () {

    \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
    \Midtrans\Config::$isProduction = config('services.midtrans.isProduction', false);
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;
    \Midtrans\Config::$appendNotifUrl ='https://retype-conform-twiddling.ngrok-free.dev/user/midtrans/callback';

    $params = [
        'transaction_details' => [
            'order_id' => 'THR-' . time(),
            'gross_amount' => 10000,
        ],

        'customer_details' => [
            'first_name' => 'Test User',
            'email' => 'test@example.com',
        ],
    ];

    return \Midtrans\Snap::getSnapToken($params);
});
}


// ================= ADMIN =================

Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login', [AdminLoginController::class, 'showAdminLogin'])
        ->name('login');

    Route::post('/login', [AdminLoginController::class, 'loginAdmin'])
        ->name('login.submit');

    Route::post('/logout', [AdminLoginController::class, 'logout'])
        ->name('logout');

    // Register
    Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [AdminRegisterController::class, 'register'])
        ->name('register.submit');

    // Admin Area
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('dashboard');

        // Resource
        Route::resource('tiket', TiketController::class);
        Route::resource('galeri', GaleriController::class);
        Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);

        // Hero
        Route::prefix('hero')->name('hero.')->group(function () {

            Route::get('/', [HeroController::class, 'index'])->name('index');

            Route::get('/create', [HeroController::class, 'create'])->name('create');

            Route::post('/', [HeroController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [HeroController::class, 'edit'])->name('edit');

            Route::put('/{id}', [HeroController::class, 'update'])->name('update');

            Route::delete('/{id}', [HeroController::class, 'destroy'])->name('destroy');
        });

        // Pemesanan
        Route::prefix('pemesanan')->name('pemesanan.')->group(function () {

            Route::get('/', [PemesananController::class, 'index'])
                ->name('index');

            Route::get('/export', [PemesananController::class, 'export'])
                ->name('export');

            Route::get('/validate-date', [PemesananController::class, 'validateDate'])
                ->name('validateDate');

            Route::get('/{id}', [PemesananController::class, 'show'])
                ->name('show');

            Route::patch('/{id}/selesai', [PemesananController::class, 'updateStatusSelesai'])
                ->name('updateStatusSelesai');
        });
    });
});


// ================= USER ROUTES =================
Route::prefix('user')->name('user.')->group(function () {

    // Login & Register
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [UserRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'register'])->name('register.submit');

    // ================= MIDTRANS CALLBACK =================
    // JANGAN DI DALAM AUTH
    Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle'])
        ->name('midtrans.callback');

    // ================= USER PANEL =================
    Route::middleware('auth')->group(function () {

        Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');

        Route::put('/profil/update', [ProfileController::class, 'update'])->name('profil.update');

        Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');

        Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/tiket', [UserTiketController::class, 'index'])
            ->name('tiket.index');

        // Pemesanan tiket
        Route::get('/tiket/{id}/pesan', [TiketPemesananController::class, 'create'])
            ->name('pesan.form');

        Route::post('/tiket/{id}/pesan', [TiketPemesananController::class, 'store'])
            ->name('pesan.store');

        Route::get('/pemesanan', [TiketPemesananController::class, 'index'])
            ->name('pemesanan.index');

        Route::get('/pemesanan/{id}/bayar', [TiketPemesananController::class, 'bayar'])
            ->name('pemesanan.bayar');

        // QR
        Route::get('/tiket/{id}/qr', [UserTiketController::class, 'showQr'])
            ->name('tiket.qr');

        // Download tiket
        Route::get('/tiket/{id}/download', [TiketPemesananController::class, 'download'])
            ->name('tiket.download');

        // Logout
        Route::post('/logout', [UserLoginController::class, 'logout'])
            ->name('logout');
    });
});


// ================= PENGELOLA =================

Route::prefix('pengelola')->name('pengelola.')->group(function () {

    // Login
    Route::get('/login', [PengelolaLoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [PengelolaLoginController::class, 'login'])
        ->name('login.submit');

        // Register
    Route::get('/register', [PengelolaRegisterController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [PengelolaRegisterController::class, 'register'])
        ->name('register.submit');

    // Pengelola Area
    Route::middleware('auth:pengelola')->group(function () {

        Route::get('/dashboard', [PengelolaDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [PengelolaLoginController::class, 'logout'])
            ->name('logout');

        Route::get('/pemesanan', [PengelolaPemesananController::class, 'index'])
            ->name('pemesanan.index');

        Route::get('/pemesanan/export/{type?}', [PemesananController::class, 'export'])
            ->name('pemesanan.export');

        Route::get('/pemesanan/export-excel', [PengelolaPemesananController::class, 'exportExcel'])
            ->name('pemesanan.export.excel');

        Route::get('/pemesanan/export-pdf', [PengelolaPemesananController::class, 'exportPdf'])
            ->name('pemesanan.export.pdf');
    });

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');
});


// ================= PETUGAS =================

Route::prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/login', [PetugasLoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [PetugasLoginController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [PetugasRegisterController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [PetugasRegisterController::class, 'register'])
        ->name('register.submit');

    Route::post('/logout', [PetugasLoginController::class, 'logout'])
        ->name('logout');

    // Petugas Area
    Route::middleware('auth:petugas')->group(function () {
        Route::get('/dashboard', [PetugasController::class, 'index'])
            ->name('dashboard');

        Route::get('/scan', [PetugasController::class, 'scanner'])
            ->name('scan');

        Route::post('/scan', [PetugasController::class, 'scan'])
            ->name('scan.submit');

        Route::get('/pemesanan/{kode_qr}', [PetugasController::class, 'showTiket'])
            ->name('konfirmasi');

        Route::post('/pemesanan/{kode_qr}/validasi', [PetugasController::class, 'validasiTiket'])
            ->name('validasi');
    });
});