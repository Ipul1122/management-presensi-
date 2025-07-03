<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jadwal;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatJadwalController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        $availableYears = Jadwal::selectRaw('YEAR(tanggal_jadwal) as tahun')
            ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
            ->distinct()
            ->pluck('tahun')
            ->sortDesc();

        $jadwalData = Jadwal::selectRaw('MONTH(tanggal_jadwal) as bulan, YEAR(tanggal_jadwal) as tahun, COUNT(*) as jumlah')
            ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
            ->groupBy('bulan', 'tahun')
            ->get()
            ->keyBy(function ($item) {
                return $item->tahun . '-' . $item->bulan;
            });

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $groupedByMonth = collect();

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

public function exportPdf(Request $request)
{
   $bulan = (int) $request->bulan; // cast ke int
$tahun = (int) $request->tahun;

    if (!$bulan || !$tahun) {
        return redirect()->back()->with('error', 'Bulan dan tahun harus dipilih.');
    }

    $data = Jadwal::whereMonth('tanggal_jadwal', $bulan)
                ->whereYear('tanggal_jadwal', $tahun)
                ->orderBy('tanggal_jadwal', 'asc')
                ->get();

    // Cek jika data kosong
    if ($data->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada data jadwal untuk bulan dan tahun tersebut.');
    }

    $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');
$judul = "Riwayat Jadwal - $namaBulan $tahun";
    $jadwals = $data;

    $pdf = Pdf::loadView('admin.riwayatJadwal.pdf', compact('judul', 'jadwals'))
                ->setPaper('A4', 'portrait');

    return $pdf->download("riwayat-jadwal-$bulan-$tahun.pdf");
}
}
