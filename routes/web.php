<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Pengajar\LoginController as PengajarLoginController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// Root
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// ERROR MESSAGE
// Route fallback untuk tampilan pesan error jika tidak login
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');



// ADMIN
// ================== ADMIN ==================

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'admin.role'])->name('dashboard');
});
/*
|--------------------------------------------------------------------------
| PENGAJAR ROUTES
|--------------------------------------------------------------------------
*/

// Halaman Login Pengajar
Route::prefix('pengajar')->name('pengajar.')->group(function () {
    Route::get('/login', [PengajarLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [PengajarLoginController::class, 'login']);
    Route::post('/logout', [PengajarLoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('pengajar.dashboard');
    })->middleware(['auth:pengajar', 'pengajar.role'])->name('dashboard');
});