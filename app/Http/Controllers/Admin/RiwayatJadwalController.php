<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jadwal;

class RiwayatJadwalController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        
        // Ambil tahun-tahun tersedia dari jadwal lama
        $availableYears = Jadwal::selectRaw('YEAR(tanggal_jadwal) as tahun')
                                ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
                                ->distinct()
                                ->pluck('tahun')
                                ->sortDesc();

        // Ambil data jadwal yang tersedia per bulan dan tahun untuk popover
        $jadwalData = Jadwal::selectRaw('MONTH(tanggal_jadwal) as bulan, YEAR(tanggal_jadwal) as tahun, COUNT(*) as jumlah')
                            ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
                            ->groupBy('bulan', 'tahun')
                            ->get()
                            ->keyBy(function ($item) {
                                return $item->tahun . '-' . $item->bulan;
                            });

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $groupedByMonth = collect(); // default kosong

        if ($bulan && $tahun) {
            $riwayatJadwal = Jadwal::whereMonth('tanggal_jadwal', $bulan)
                ->whereYear('tanggal_jadwal', $tahun)
                ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
                ->orderBy('tanggal_jadwal', 'desc')
                ->get();

            $groupedByMonth = $riwayatJadwal->groupBy(function ($item) {
                return Carbon::parse($item->tanggal_jadwal)->format('F Y');
            });
        }

        return view('admin.riwayatJadwal.index', compact('groupedByMonth', 'availableYears', 'jadwalData'));
    }
}