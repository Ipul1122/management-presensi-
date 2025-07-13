<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MuridAbsensi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatMuridController extends Controller
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
        $start = $carbonBulan->copy()->startOfMonth();
        $end = $carbonBulan->copy()->endOfMonth();

        // Ambil jumlah hari dalam bulan
        $jumlahHari = $carbonBulan->daysInMonth;

        // Ambil tanggal yang dipilih
        $tanggalDipilih = $request->tanggal;
        
        // Ambil murid yang dipilih
        $muridDipilih = $request->murid;

        // Ambil tanggal-tanggal yang memiliki data absensi dalam bulan ini
        $tanggalDenganData = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
            ->whereYear('tanggal_absen', $carbonBulan->year)
            ->selectRaw('DISTINCT DAY(tanggal_absen) as tanggal')
            ->orderBy('tanggal')
            ->pluck('tanggal')
            ->toArray();

        // Ambil daftar murid yang pernah diabsen dalam bulan ini
        $daftarMurid = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
            ->whereYear('tanggal_absen', $carbonBulan->year)
            ->leftJoin('murids', 'murid_absensis.nama_murid', '=', 'murids.nama_anak')
            ->select('murid_absensis.nama_murid', 'murids.jenis_kelamin')
            ->distinct()
            ->orderBy('nama_murid')
            ->get();

        // Jika tanggal valid, ambil data absensi untuk tanggal tersebut
$absensiTanggal = collect();
if ($tanggalDipilih && $tanggalDipilih >= 1 && $tanggalDipilih <= $jumlahHari) {
    $tanggalFormat = Carbon::createFromFormat('Y-m-d', $bulanDipilih . '-' . str_pad($tanggalDipilih, 2, '0', STR_PAD_LEFT));

    $query = MuridAbsensi::whereDate('tanggal_absen', $tanggalFormat)
        ->leftJoin('murids', 'murid_absensis.nama_murid', '=', 'murids.nama_anak')
        ->select('murid_absensis.*', 'murids.jenis_kelamin')
        ->orderBy('tanggal_absen', 'desc')
        ->orderBy('nama_murid', 'asc');

    // Tambahkan filter murid jika dipilih
    if ($muridDipilih) {
        $query->where('nama_murid', $muridDipilih);
    }

    $absensiTanggal = $query->get();
}

        // Jika murid dipilih, ambil riwayat absensi murid tersebut dalam bulan ini
        $riwayatMurid = collect();
        $tanggalAbsensiMurid = [];
        if ($muridDipilih) {
            $riwayatMurid = MuridAbsensi::where('nama_murid', $muridDipilih)
                ->whereMonth('tanggal_absen', $carbonBulan->month)
                ->whereYear('tanggal_absen', $carbonBulan->year)
                ->leftJoin('murids', 'murid_absensis.nama_murid', '=', 'murids.nama_anak')
                ->select('murid_absensis.*', 'murids.jenis_kelamin')
                ->orderBy('tanggal_absen', 'desc')
                ->get();

            // Ambil tanggal-tanggal absensi murid untuk highlight kalender
            $tanggalAbsensiMurid = $riwayatMurid->map(function($item) {
                return Carbon::parse($item->tanggal_absen)->day;
            })->toArray();
        }

        // Ambil data absensi berdasarkan bulan untuk rekap
        $absensi = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
            ->whereYear('tanggal_absen', $carbonBulan->year)
            ->where('jenis_status', 'Hadir')
            ->whereIn(DB::raw('DAYNAME(tanggal_absen)'), ['Friday', 'Saturday', 'Sunday'])
            ->get();

        // Hitung rekap per murid
        $rekap = $absensi->groupBy('nama_murid')->map(function ($group) {
            return $group->count();
        })->toArray();

        return view('admin.riwayatMurid.index', [
            'bulanList' => $bulanList,
            'bulanDipilih' => $bulanDipilih,
            'tanggalDipilih' => $tanggalDipilih,
            'muridDipilih' => $muridDipilih,
            'jumlahHari' => $jumlahHari,
            'tanggalDenganData' => $tanggalDenganData,
            'daftarMurid' => $daftarMurid,
            'riwayatMurid' => $riwayatMurid,
            'tanggalAbsensiMurid' => $tanggalAbsensiMurid,
            'absensiTanggal' => $absensiTanggal,
            'rekap' => $rekap,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $absensi = MuridAbsensi::findOrFail($id);
        return view('admin.riwayatMurid.edit', compact('absensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_murid' => 'required|string|max:255',
            'tanggal_absen' => 'required|date',
            'jenis_status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'catatan' => 'nullable|string|max:500',
        ]);

        $absensi = MuridAbsensi::findOrFail($id);
        $absensi->update([
            'nama_murid' => $request->nama_murid,
            'tanggal_absen' => $request->tanggal_absen,
            'jenis_status' => $request->jenis_status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.riwayatMurid.index', [
            'bulan' => Carbon::parse($request->tanggal_absen)->format('Y-m'),
            'tanggal' => Carbon::parse($request->tanggal_absen)->day
        ])->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = MuridAbsensi::findOrFail($id);
        $bulan = Carbon::parse($absensi->tanggal_absen)->format('Y-m');
        $tanggal = Carbon::parse($absensi->tanggal_absen)->day;
        
        $absensi->delete();
        
        return redirect()->route('admin.riwayatMurid.index', [
            'bulan' => $bulan,
            'tanggal' => $tanggal
        ])->with('success', 'Data absensi berhasil dihapus.');
    }

    
    public function exportPdf(Request $request)
{
    $bulanDipilih = $request->bulan ?? now()->format('Y-m');
    $carbonBulan = Carbon::createFromFormat('Y-m', $bulanDipilih);

    // Ambil semua data absensi dalam bulan yang dipilih
    $dataAbsensi = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
        ->whereYear('tanggal_absen', $carbonBulan->year)
        ->orderBy('tanggal_absen', 'asc')
        ->orderBy('nama_murid', 'asc')
        ->get()
        ->groupBy(function($item) {
            return Carbon::parse($item->tanggal_absen)->format('l, d F Y');
        });

    $pdf = Pdf::loadView('admin.riwayatMurid.pdf', [
        'bulan' => $carbonBulan->translatedFormat('F Y'),
        'groupedAbsensi' => $dataAbsensi
    ])->setPaper('A4', 'portrait');

    return $pdf->stream('absensi_bulan_' . $carbonBulan->format('Y_m') . '.pdf');
}


}