<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MuridController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajarController;

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

        // Tambahan fitur khusus
        Route::get('/murid/show', [MuridController::class, 'show'])->name('murid.show');
        Route::delete('/murid-delete-selected', [MuridController::class, 'bulkDelete'])->name('murid.bulkDelete');
        Route::delete('/murid-delete-all', [MuridController::class, 'deleteAll'])->name('murid.deleteAll');
    
        // Pengajar Resource Route
        Route::resource('pengajar', PengajarController::class);
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