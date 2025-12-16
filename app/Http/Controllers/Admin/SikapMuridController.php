<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoinSikap;
use App\Models\NotifikasiAdmin;
use Illuminate\Support\Facades\DB;

class SikapMuridController extends Controller
{
    public function index()
    {
        // 1. Data untuk Leaderboard (Total Poin per Murid)
        $dataSikap = PoinSikap::select('nama_murid', DB::raw('SUM(jumlah_poin) as total_poin'))
                        ->groupBy('nama_murid')
                        ->orderByDesc('total_poin')
                        ->get();

        // 2. [BARU] Data Riwayat Penilaian (Untuk melihat siapa pengajarnya)
        $riwayatPenilaian = PoinSikap::latest()->paginate(10); // Menampilkan 10 data terbaru

        // 3. Data Notifikasi Navbar
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();

        return view('admin.sikapMuridTpa.index', compact('dataSikap', 'riwayatPenilaian', 'unreadCount', 'notifikasi'));
    }
}