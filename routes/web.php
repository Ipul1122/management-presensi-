<?php

// ADMIN CONTROLLER
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MuridController;
use App\Http\Controllers\Admin\RiwayatMuridController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajarController;
use App\Http\Controllers\Admin\DaftarMuridController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\RiwayatJadwalController;
use App\Http\Controllers\Admin\TestimoniUserController;
use App\Http\Controllers\Admin\PoinMuridController;
use App\Http\Controllers\Admin\SikapMuridController as AdminSikapController;

// Pengajar Controllers
use App\Http\Controllers\Pengajar\MuridAbsensiController;
use App\Http\Controllers\Pengajar\RiwayatMuridAbsensiController;
use App\Http\Controllers\Pengajar\LoginController as PengajarLoginController;
use App\Http\Controllers\Pengajar\DashboardPengajarController;
use App\Http\Controllers\Pengajar\JadwalJadwalPengajar;
use App\Http\Controllers\Pengajar\RiwayatJadwalPengajarController;
use App\Http\Controllers\Pengajar\panduanPengajarController;
use App\Http\Controllers\Pengajar\SikapMuridController as PengajarSikapController;


// USER CONTROLLERS
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InformasiController;
use App\Http\Controllers\User\GaleriController;
use App\Http\Controllers\User\PendaftaranController;
use App\Http\Controllers\User\DaftarController;  
use App\Http\Controllers\User\KontakController;
use App\Http\Controllers\User\TestimoniController;
use App\Http\Controllers\User\DataPengajarController;
use App\Http\Controllers\User\VisiDanMisiController;
use App\Http\Controllers\User\DataMuridController;
use App\Http\Controllers\User\JadwalUserController;
// use App\Http\Controllers\User\RiwayatJadwalUserController;
use App\Http\Controllers\User\RiwayatMuridAbsensiUserController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
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
    // Auth Routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Routes dengan middleware auth:admin
    Route::middleware(['auth:admin', 'admin.role', 'prevent-back-history'])->group(function () {
        
        // Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::match(['GET', 'DELETE'], '/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        

        // Murid resource route
        Route::resource('murid', MuridController::class);

        // Cetak PDF route
        Route::get('/admin/data-murid/cetak-pdf', [MuridController::class, 'cetakPDF'])->name('murid.pdf');

        // Riwayat Murid
        Route::get('riwayatMurid', [RiwayatMuridController::class, 'index'])->name('riwayatMurid.index');
        // Route::put('riwayatMurid/{id}', [RiwayatMuridController::class, 'update'])->name('riwayatMurid.update');
        Route::delete('riwayatMurid/{id}', [RiwayatMuridController::class, 'destroy'])->name('riwayatMurid.hapus');
        Route::resource('riwayatMurid', RiwayatMuridController::class);
        // PDF Export
        // PDF export route dengan nama berbeda
        Route::get('riwayatMuridExportPdf', [RiwayatMuridController::class, 'exportPdf'])->name('riwayatMurid.exportPdf');


        // DataMurid Satuan Route
        Route::get('dataMurid', [MuridController::class, 'dataMurid'])->name('dataMurid');


        // Pengajar Resource Route
        Route::resource('pengajar', PengajarController::class);
        // Jadwal
        Route::resource('jadwal', JadwalController::class);
        // bulk delete & delete all
        Route::delete('/jadwal', [JadwalController::class, 'bulkDestroy'])->name('jadwal.bulkDestroy');


        // Riwayat Jadwal
        Route::get('riwayatJadwal', [RiwayatJadwalController::class, 'index'])->name('riwayatJadwal.index');
        Route::get('riwayatJadwal/pdf', [RiwayatJadwalController::class, 'exportPdf'])->name('riwayatJadwal.pdf');
        Route::delete('riwayatJadwal/bulk-delete', [RiwayatJadwalController::class, 'bulkDelete'])->name('riwayatJadwal.bulkDelete');
        Route::delete('riwayatJadwal/delete-all', [RiwayatJadwalController::class, 'deleteAll'])->name('riwayatJadwal.deleteAll');
        Route::get('riwayatJadwal/{id}/edit', [RiwayatJadwalController::class, 'edit'])->name('riwayatJadwal.edit');
        Route::delete('riwayatJadwal/{id}', [RiwayatJadwalController::class, 'destroy'])->name('riwayatJadwal.destroy');
        Route::put('riwayatJadwal/{id}', [RiwayatJadwalController::class, 'update'])->name('riwayatJadwal.update');

        
        // Tambahan fitur khusus
        Route::delete('/murid-delete-selected', [MuridController::class, 'bulkDelete'])->name('murid.bulkDelete');
        Route::delete('/murid-delete-all', [MuridController::class, 'deleteAll'])->name('murid.deleteAll');
        // Additional Pengajar routes
        Route::delete('/pengajar-delete-selected', [PengajarController::class, 'bulkDelete'])->name('pengajar.bulkDelete');
        Route::delete('/pengajar-delete-all', [PengajarController::class, 'deleteAll'])->name('pengajar.deleteAll');
        
        // NOTIFIKASI
        Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
            Route::get('/', [NotifikasiController::class, 'index'])->name('index');
            Route::delete('/delete-selected', [NotifikasiController::class, 'bulkDelete'])->name('bulkDelete');
            Route::delete('/delete-all', [NotifikasiController::class, 'deleteAll'])->name('deleteAll');
            Route::get('/times', [NotifikasiController::class, 'getNotificationTimes'])->name('times');
        });

        // JADWAL
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        // Route::get(' jadwal/{id}' , [JadwalController::class, 'edit'])->name('jadwal.edit');
        // Route::put(' jadwal/{id}' , [JadwalController::class, 'update'])->name('jadwal.update');
        // JADWAL HAPUS BEBERAPA PILIHAN ATAU SEMUA
        Route::delete('/jadwal-delete-selected', [JadwalController::class, 'bulkDelete'])->name('jadwal.bulkDelete');
        Route::get('/jadwal-delete-all', [JadwalController::class, 'deleteAll'])->name('jadwal.deleteAll');
        
        // Admin Daftar from User
        Route::get('/daftar-murid', [DaftarMuridController::class, 'index'])->name('daftarMurid.index');
        Route::post('daftar-murid/{id}/terima', [DaftarMuridController::class, 'terima'])->name('daftarMurid.terima');
        Route::delete('daftar-murid/{id}/tolak', [DaftarMuridController::class, 'tolak'])->name('daftarMurid.tolak');

         // ADMIN TESTIMONI FROM USER
        Route::get('/testimoniUser', [TestimoniUserController::class, 'index'])->name('testimoniUser.index');
        Route::post('/testimoniUser/{id}/approve', [TestimoniUserController::class, 'approve'])->name('testimoniUser.approve');
        Route::post('/testimoniUser/{id}/reject', [TestimoniUserController::class, 'reject'])->name('testimoniUser.reject');
        // ADMIN HAPUS TESTIMONI USER
        Route::post('/testimoniUser/bulk-delete',  [TestimoniUserController::class, 'bulkDelete'])->name('testimoniUser.bulkDelete');
        Route::delete('/testimoniUser/delete-all', [TestimoniUserController::class, 'deleteAll'])->name('testimoniUser.deleteAll');

        Route::get('/poin-murid-tpa', [PoinMuridController::class, 'index'])->name('poinMuridTpa.index');
        Route::get('/sikap-murid-tpa', [AdminSikapController::class, 'index'])->name('sikapMurid.index');
        // [BARU] Route untuk menghapus log
        Route::delete('/sikap-murid-tpa/{id}', [AdminSikapController::class, 'destroy'])->name('sikapMurid.destroy');
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
 Route::middleware(['auth:pengajar', 'pengajar.role', 'prevent-back-history'])->group(function () {

    Route::get('/dashboard', [DashboardPengajarController::class, 'index'])->name('dashboard');
    // Route untuk halaman dashboard pengajar

    // Routes Murid Absensis
    Route::resource('muridAbsensi', MuridAbsensiController::class);
    Route::get('muridAbsensi/create', [MuridAbsensiController::class, 'create'])->name('muridAbsensi.create');
    // Route::post('muridAbsensi/store', [MuridAbsensiController::class, 'store'])->name('muridAbsensi.store');

    // Route edit dan hapus muridAbsensi
    Route::get('/muridAbsensi/{id}/edit', [MuridAbsensiController::class, 'edit'])->name('pengajar.muridAbsensi.edit');
    Route::put('/muridAbsensi/{id}', [MuridAbsensiController::class, 'update'])->name('pengajar.muridAbsensi.update');
    Route::delete('/muridAbsensi/{id}', [MuridAbsensiController::class, 'destroy'])->name('pengajar.muridAbsensi.destroy');

    // Riwayat Murid Absensi
    Route::get('riwayatMuridAbsensi', [RiwayatMuridAbsensiController::class, 'index'])->name('riwayatMuridAbsensi.index');
    // Route::get('riwayatMuridAbsensi/{id}/edit', [RiwayatMuridAbsensiController::class, 'edit'])->name('riwayatMuridAbsensi.edit');
    // Route::put('riwayatMuridAbsensi/{id}', [RiwayatMuridAbsensiController::class, 'update'])->name('riwayatMuridAbsensi.update');
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

    // Jadwal Pengajar
    Route::get('jadwal', [JadwalJadwalPengajar::class, 'index'])->name('jadwal.index');

    // Riwayat Jadwal Pengajar
    Route::get('riwayatJadwal', [RiwayatJadwalPengajarController::class, 'index'])->name('riwayatJadwal.index');

    // Panduan Pengajar
    Route::get('panduanPengajar', [panduanPengajarController::class, 'index'])->name('panduanPengajar.index');

    Route::get('/sikap-murid-tpa', [PengajarSikapController::class, 'index'])->name('sikapMurid.index');
    Route::post('/sikap-murid-tpa', [PengajarSikapController::class, 'store'])->name('sikapMurid.store');
    Route::delete('/sikap-murid-tpa/{id}', [App\Http\Controllers\Pengajar\SikapMuridController::class, 'destroy'])->name('sikapMurid.destroy');    
});
    
});


/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/


// Sitemap 
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// user
Route::get('/', [HomeController::class, 'index'])->name('index');

// GROUP USER
Route::prefix('user')->name('user.')->group(function() {
    // INFORMASI USER
    Route::prefix('informasi')->name('informasi.')->group(function(){
        Route::get('/dataPengajar', [DataPengajarController::class, 'index'])->name('dataPengajar.index');
        Route::get('/visiDanMisi', [VisiDanMisiController::class, 'index'])->name('visiDanMisi.index');
        Route::get('/dataMurid', [DataMuridController::class, 'index'])->name('dataMurid.index');
        Route::get('/jadwal', [JadwalUserController::class, 'index'])->name('jadwal.index');
        Route::get('/riwayatMurid', [RiwayatMuridAbsensiUserController::class, 'index'])->name('riwayatMurid.index');
    });
    // GALERI USER
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    // PENDAFTARAN USER
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
   Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar.index'); 
    Route::post('/daftar/store', [DaftarController::class, 'store'])->name('daftar.store');
    
    // KONTAK USER
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    // TESTIMONI USER
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('testimoni.store');

});