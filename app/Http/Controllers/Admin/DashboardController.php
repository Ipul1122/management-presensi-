<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Session;
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

        // Mengambil semua jadwal bulan ini
        $excludedIds = session('pindah_riwayat', []);

        // Menampilkan jadwal bulan ini saja
        $jadwalBulanIni = Jadwal::whereMonth('tanggal_jadwal', date('m'))
        ->whereYear('tanggal_jadwal', date('Y'))
        ->whereNotIn('id_jadwal', $excludedIds)
        ->get();

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
            'jadwalBulanIni',
        ));
    }


public function bulkDelete(Request $request)
{
    $action = $request->input('action');

    if ($action === 'all') {
        // Hapus semua jadwal bulan ini
        $deletedCount = Jadwal::whereMonth('tanggal_jadwal', now()->month)
            ->whereYear('tanggal_jadwal', now()->year)
            ->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', "Semua jadwal bulan ini ($deletedCount jadwal) berhasil dihapus.");
    }

    if ($action === 'selected') {
        $selected = $request->input('selected_jadwals');

        // Validasi input
        if (empty($selected) || !is_array($selected)) {
            return redirect()->route('admin.dashboard')
                ->with('warning', 'Tidak ada jadwal yang dipilih untuk dihapus.');
        }

        // Hapus jadwal yang dipilih
        $deletedCount = Jadwal::whereIn('id', $selected)->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', "Jadwal terpilih ($deletedCount jadwal) berhasil dihapus.");
    }

    return redirect()->route('admin.dashboard')
        ->with('error', 'Aksi tidak dikenali.');
}
}
