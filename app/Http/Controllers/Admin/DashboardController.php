<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Pengajar;
use App\Models\NotifikasiAdmin;
use App\Models\Jadwal;


class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMurid = Murid::count();
        $jumlahPengajar = Pengajar::count();
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();
        // Ambil 5 jadwal terdekat
        $jadwals = Jadwal::orderBy('tanggal_jadwal', 'asc')->take(5)->get();

        return view('admin.dashboard', compact('jumlahMurid', 'jumlahPengajar', 'unreadCount', 'jadwals', 'notifikasi'));
    }

    
}
