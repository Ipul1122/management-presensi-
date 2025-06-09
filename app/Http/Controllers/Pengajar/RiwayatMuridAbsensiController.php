<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MuridAbsensi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiwayatMuridAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
            */
        public function index(Request $request)
        {
        // Ambil semua data absensi sebelum hari ini
        $riwayatAbsensi = MuridAbsensi::whereDate('tanggal_absen', '<', Carbon::today())
            ->orderBy('tanggal_absen', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal_absen)->format('F Y'); // Contoh: Juni 2025
            })
            ->map(function ($group) {
                return $group->groupBy(function ($item) {
                    return Carbon::parse($item->tanggal_absen)->format('l, d F Y'); // Contoh: Jumat, 06 Juni 2025
                });
            });


            // / Ambil daftar bulan unik dari absensi
    $bulanList = MuridAbsensi::selectRaw('DATE_FORMAT(tanggal_absen, "%Y-%m") as bulan')
        ->distinct()
        ->orderByDesc('bulan')
        ->pluck('bulan');

    // Bulan yang dipilih (default: bulan sekarang)
    $bulanDipilih = $request->bulan ?? now()->format('Y-m');

    // Ambil tanggal awal dan akhir dari bulan yang dipilih
    $start = Carbon::createFromFormat('Y-m', $bulanDipilih)->startOfMonth();
    $end = Carbon::createFromFormat('Y-m', $bulanDipilih)->endOfMonth();

    // Ambil absensi hadir antara tanggal tersebut & hanya Jumat, Sabtu, Minggu
    $absensi = MuridAbsensi::whereBetween('tanggal_absen', [$start, $end])
        ->where('jenis_status', 'Hadir')
        ->get()
        ->filter(function ($item) {
            return in_array(Carbon::parse($item->tanggal_absen)->dayOfWeek, [Carbon::FRIDAY, Carbon::SATURDAY, Carbon::SUNDAY]);
        });

    // Hitung kehadiran per murid
    $rekap = $absensi->groupBy('nama_murid')->map(function ($group) {
        return $group->count();
    });

// Tambahkan ke view return
return view('pengajar.riwayatMuridAbsensi.index', [
    'riwayatAbsensi' => $riwayatAbsensi, // data absen bulanan
    'bulanList' => $bulanList,           // semua bulan yang tersedia
    'rekap' => $rekap,                   // hasil rekap per murid
]);
    
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $absensi = MuridAbsensi::findOrFail($id);
    return view('pengajar.riwayatMuridAbsensi.edit', compact('absensi'));
}

public function update(Request $request, $id)
{
    $absensi = MuridAbsensi::findOrFail($id);
    $absensi->update([
        'nama_murid'     => $request->nama_murid,
        'tanggal_absen'  => $request->tanggal_absen,
        'jenis_status'   => $request->jenis_status,
        'catatan'        => $request->catatan,
    ]);

    return redirect()->route('pengajar.riwayatMuridAbsensi.index')->with('success', 'Absensi berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    MuridAbsensi::findOrFail($id)->delete();
    return back()->with('success', 'Absensi berhasil dihapus.');
}

}
