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
    $bulanList = MuridAbsensi::selectRaw('DATE_FORMAT(tanggal_absen, "%Y-%m") as bulan')
        ->distinct()
        ->orderByDesc('bulan')
        ->pluck('bulan');

    $bulanDipilih = $request->bulan ?? now()->format('Y-m');

    $carbonBulan = Carbon::createFromFormat('Y-m', $bulanDipilih);
    $start = $carbonBulan->startOfMonth();
    $end = $carbonBulan->endOfMonth();

    // Ambil jumlah hari dalam bulan
    $jumlahHari = $carbonBulan->daysInMonth;

    // Ambil tanggal yang dipilih
    $tanggalDipilih = $request->tanggal;

    // Jika tanggal valid
    $absensiTanggal = collect();
    if ($tanggalDipilih && $tanggalDipilih >= 1 && $tanggalDipilih <= $jumlahHari) {
        $tanggalFormat = Carbon::createFromFormat('Y-m-d', $bulanDipilih . '-' . str_pad($tanggalDipilih, 2, '0', STR_PAD_LEFT));

        $absensiTanggal = MuridAbsensi::whereDate('tanggal_absen', $tanggalFormat)
            ->orderBy('tanggal_absen', 'desc')
            ->get();
    }

    // Ambil data absensi berdasarkan bulan
$absensi = MuridAbsensi::whereMonth('tanggal_absen', Carbon::parse($request->bulan)->month)
    ->whereYear('tanggal_absen', Carbon::parse($request->bulan)->year)
    ->where('jenis_status', 'Hadir')
    ->whereIn(DB::raw('DAYNAME(tanggal_absen)'), ['Friday', 'Saturday', 'Sunday'])
    ->get();

// Hitung rekap per murid
$rekap = $absensi->groupBy('nama_murid')->map(function ($group) {
    return $group->count();
})->toArray(); // ubah ke array agar Blade tidak error saat count = 0

// Ambil data harian jika ada parameter tanggal
$riwayatHarian = null;
if ($request->tanggal) {
    $tanggalTerpilih = Carbon::parse($request->bulan . '-' . $request->tanggal);
    $riwayatHarian = MuridAbsensi::whereDate('tanggal_absen', $tanggalTerpilih)->get();
}

    return view('pengajar.riwayatMuridAbsensi.index', [
        'bulanList' => $bulanList,
        'bulanDipilih' => $bulanDipilih,
        'tanggalDipilih' => $tanggalDipilih,
        'jumlahHari' => $jumlahHari,
        'absensiTanggal' => $absensiTanggal,
        'rekap' => $rekap,
        'riwayatHarian' => $riwayatHarian,
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
