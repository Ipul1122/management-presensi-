<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MuridController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajarController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\JadwalController;


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

// ERROR MESSAGE
// Route fallback untuk tampilan pesan error jika tidak login
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');


// ADMIN
// ================== ADMIN ==================


Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Routes dengan middleware auth:admin
    Route::middleware(['auth:admin', 'admin.role'])->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Murid resource route
        Route::resource('murid', MuridController::class);
        // Pengajar Resource Route
        Route::resource('pengajar', PengajarController::class);
        // Jadwal
        Route::resource('jadwal', JadwalController::class);

        
        
        
        // Tambahan fitur khusus
        Route::delete('/murid-delete-selected', [MuridController::class, 'bulkDelete'])->name('murid.bulkDelete');
        Route::delete('/murid-delete-all', [MuridController::class, 'deleteAll'])->name('murid.deleteAll');
        // Additional Pengajar routes
        Route::delete('/pengajar-delete-selected', [PengajarController::class, 'bulkDelete'])->name('pengajar.bulkDelete');
        Route::delete('/pengajar-delete-all', [PengajarController::class, 'deleteAll'])->name('pengajar.deleteAll');
        
        // NOTIFIKASI
        Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        // HAPUS BEBERAPA PILIHAN NOTIFIKASI
        Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::delete('/notifikasi-delete-selected', [NotifikasiController::class, 'bulkDelete'])->name('notifikasi.bulkDelete');
        Route::get('/notifikasi-delete-all', [NotifikasiController::class, 'deleteAll'])->name('notifikasi.deleteAll');
        
        // JADWAL
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get(' jadwal/{id}' , [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put(' jadwal/{id}' , [JadwalController::class, 'update'])->name('jadwal.update');
        // JADWAL HAPUS BEBERAPA PILIHAN ATAU SEMUA
        Route::delete('/jadwal-delete-selected', [JadwalController::class, 'bulkDelete'])->name('jadwal.bulkDelete');
        Route::get('/jadwal-delete-all', [JadwalController::class, 'deleteAll'])->name('jadwal.deleteAll');
    
        
    });
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