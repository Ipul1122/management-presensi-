<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Pengajar;
use App\Models\NotifikasiAdmin;
use App\Models\Jadwal;
use Carbon\Carbon;  

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jumlahMurid = Murid::count();
        $jumlahPengajar = Pengajar::count();
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();
        // Ambil 5 jadwal terdekat
        $jadwals = Jadwal::orderBy('tanggal_jadwal', 'asc')->take(5)->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if ($request->has('hapus_semua')) {
        $now = Carbon::now();

        Jadwal::whereMonth('tanggal_jadwal', $now->month)
            ->whereYear('tanggal_jadwal', $now->year)
            ->delete();

        return redirect()->back()->with('success', 'Jadwal bulan ini berhasil dihapus.');
    }

        $jadwalBulanIni = Jadwal::whereMonth('tanggal_jadwal', now()->month)
                            ->whereYear('tanggal_jadwal', now()->year)
                            ->get();

        return view('admin.dashboard', compact(
            'jumlahMurid', 
            'jumlahPengajar', 
            'unreadCount', 
            'jadwals', 
            'notifikasi',
            'jadwalBulanIni'
        ));
    }

}
