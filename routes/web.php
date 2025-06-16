<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MuridController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajarController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\RiwayatJadwalController;

// Pengajar Controllers
use App\Http\Controllers\Pengajar\MuridAbsensiController;
use App\Http\Controllers\Pengajar\RiwayatMuridAbsensiController;
use App\Http\Controllers\Pengajar\LoginController as PengajarLoginController;
use App\Http\Controllers\Pengajar\DashboardPengajarController;
use App\Http\Controllers\Pengajar\RiwayatJadwalPengajarController;
use App\Http\Controllers\Pengajar\panduanPengajarController;
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
        
        // Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::match(['GET', 'DELETE'], '/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Murid resource route
        Route::resource('murid', MuridController::class);

        // DataMurid Satuan Route
        Route::get('dataMurid', [MuridController::class, 'dataMurid'])->name('dataMurid');


        // Pengajar Resource Route
        Route::resource('pengajar', PengajarController::class);
        // Jadwal
        Route::resource('jadwal', JadwalController::class);
        // Riwayat Jadwal
        Route::get('riwayatJadwal', [RiwayatJadwalController::class, 'index'])->name('riwayatJadwal.index');

        
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

    // Routes dengan middleware auth:pengajar
 Route::middleware(['auth:pengajar', 'pengajar.role'])->group(function () {

    Route::get('/dashboard', [DashboardPengajarController::class, 'index'])->name('dashboard');
    // Route untuk halaman dashboard pengajar

    // Routes Murid Absensis
    Route::resource('muridAbsensi', MuridAbsensiController::class);
    Route::get('muridAbsensi/create', [MuridAbsensiController::class, 'create'])->name('muridAbsensi.create');
    Route::post('muridAbsensi/store', [MuridAbsensiController::class, 'store'])->name('muridAbsensi.store');

    // Route edit dan hapus muridAbsensi
    Route::get('/muridAbsensi/{id}/edit', [MuridAbsensiController::class, 'edit'])->name('pengajar.muridAbsensi.edit');
    Route::put('/muridAbsensi/{id}', [MuridAbsensiController::class, 'update'])->name('pengajar.muridAbsensi.update');
    Route::delete('/muridAbsensi/{id}', [MuridAbsensiController::class, 'destroy'])->name('pengajar.muridAbsensi.destroy');

    // Riwayat Murid Absensi
    Route::get('riwayatMuridAbsensi', [RiwayatMuridAbsensiController::class, 'index'])->name('riwayatMuridAbsensi.index');
    Route::get('riwayatMuridAbsensi/{id}/edit', [RiwayatMuridAbsensiController::class, 'edit'])->name('riwayatMuridAbsensi.edit');
    Route::put('riwayatMuridAbsensi/{id}', [RiwayatMuridAbsensiController::class, 'update'])->name('riwayatMuridAbsensi.update');
    Route::delete('riwayatMuridAbsensi/{id}', [RiwayatMuridAbsensiController::class, 'destroy'])->name('riwayatMuridAbsensi.hapus');
    Route::resource('riwayatMuridAbsensi', RiwayatMuridAbsensiController::class);
        
    // infoDataMurid
    Route::get('infoDataMurid', [MuridAbsensiController::class, 'infoDataMurid'])->name('infoDataMurid.index');

    // InfoDataPengajar
    Route::get('infoDataPengajar', [PengajarController::class, 'infoDataPengajar'])->name('infoDataPengajar.index');
    
    // Fitur otomatisasi ketika memilih murid akan mengisi data secara otomatis
    Route::get('muridAbsensi/get-murid/{nama}', [MuridAbsensiController::class, 'getMurid']);
    Route::get('/muridAbsensi', [MuridAbsensiController::class, 'index'])->name('muridAbsensi.index');

    // Bulk delete & delete all
    Route::delete('/muridAbsensi-delete-selected', [MuridAbsensiController::class, 'bulkDelete'])->name('muridAbsensi.bulkDelete');
    Route::delete('/muridAbsensi-delete-all', [MuridAbsensiController::class, 'deleteAll'])->name('muridAbsensi.deleteAll');

    // Riwayat Jadwal Pengajar
    Route::get('riwayatJadwal', [RiwayatJadwalPengajarController::class, 'index'])->name('riwayatJadwal.index');

    // Panduan Pengajar
    Route::get('panduanPengajar', [panduanPengajarController::class, 'index'])->name('panduanPengajar.index');
    });
});