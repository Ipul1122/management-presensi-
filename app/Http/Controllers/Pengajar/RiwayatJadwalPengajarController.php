<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jadwal;

class RiwayatJadwalPengajarController extends Controller
{
    //
    public function index()
{
    $now = Carbon::now();
    $riwayatJadwal = Jadwal::where(function ($query) use ($now) {
        $query->whereYear('tanggal_jadwal', '<', $now->year)
            ->orWhere(function ($query) use ($now) {
                $query->whereYear('tanggal_jadwal', $now->year)
                        ->whereMonth('tanggal_jadwal', '<', $now->month);
            });
    })->orderBy('tanggal_jadwal', 'desc')->get();

    $groupedByMonth = $riwayatJadwal->groupBy(function ($item) {
        return Carbon::parse($item->tanggal_jadwal)->format('F Y'); // contoh: "Mei 2025"
    });

    return view('pengajar.riwayatJadwal.index', compact('groupedByMonth'));
}


}
