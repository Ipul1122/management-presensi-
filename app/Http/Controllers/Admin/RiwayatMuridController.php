<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MuridAbsensi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;

class RiwayatMuridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        // 1. Ambil daftar bulan untuk dropdown
        $bulanList = MuridAbsensi::selectRaw('DATE_FORMAT(tanggal_absen, "%Y-%m") as bulan')
            ->distinct()
            ->orderByDesc('bulan')
            ->pluck('bulan');

        // 2. Tentukan range tanggal berdasarkan bulan dipilih
        $bulanDipilih = $request->bulan ?? now()->format('Y-m');
        $carbonBulan = Carbon::createFromFormat('Y-m', $bulanDipilih);
        
        // Data pendukung view
        $jumlahHari = $carbonBulan->daysInMonth;
        $tanggalDipilih = $request->tanggal;
        $muridDipilih = $request->murid;

        // 3. Ambil tanggal yang ada datanya (untuk highlight kalender)
        $tanggalDenganData = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
            ->whereYear('tanggal_absen', $carbonBulan->year)
            ->selectRaw('DISTINCT DAY(tanggal_absen) as tanggal')
            ->orderBy('tanggal')
            ->pluck('tanggal')
            ->toArray();

        // 4. Ambil daftar murid (Dropdown/List Nama)
        $daftarMurid = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
            ->whereYear('tanggal_absen', $carbonBulan->year)
            ->leftJoin('murids', 'murid_absensis.nama_murid', '=', 'murids.nama_anak')
            ->select('murid_absensis.nama_murid', 'murids.jenis_kelamin')
            ->distinct()
            ->orderBy('nama_murid')
            ->get();

        // 5. Logika Absensi Harian (Tabel Detail Harian)
        $absensiTanggal = new LengthAwarePaginator([], 0, 5, 1, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        if ($tanggalDipilih && $tanggalDipilih >= 1 && $tanggalDipilih <= $jumlahHari) {
            $tanggalFormat = Carbon::createFromFormat('Y-m-d', $bulanDipilih . '-' . str_pad($tanggalDipilih, 2, '0', STR_PAD_LEFT));

            $query = MuridAbsensi::whereDate('tanggal_absen', $tanggalFormat)
                ->leftJoin('murids', 'murid_absensis.nama_murid', '=', 'murids.nama_anak')
                ->select('murid_absensis.*', 'murids.jenis_kelamin')
                // OPSI: Jika ingin status 'Hadir' selalu di atas pada tabel harian, buka komentar di bawah:
                // ->orderByRaw("FIELD(jenis_status, 'Hadir', 'Izin', 'Sakit', 'Alpha')") 
                ->orderBy('nama_murid', 'asc');

            if ($muridDipilih) {
                $query->where('nama_murid', $muridDipilih);
            }

            $absensiTanggal = $query->paginate(5);
            $absensiTanggal->appends([
                'bulan' => $bulanDipilih,
                'murid' => $muridDipilih,
                'tanggal' => $tanggalDipilih,
            ]);
        }

        // 6. Logika Riwayat Individu
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

            $tanggalAbsensiMurid = $riwayatMurid->map(function($item) {
                return Carbon::parse($item->tanggal_absen)->day;
            })->toArray();
        }

        // 7. PERBAIKAN UTAMA: Hitung Rekap & Urutkan Nilai Terbaik (Terbanyak) ke Atas
        $absensi = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
            ->whereYear('tanggal_absen', $carbonBulan->year)
            ->where('jenis_status', 'Hadir')
            ->whereIn(DB::raw('DAYNAME(tanggal_absen)'), ['Friday', 'Saturday', 'Sunday'])
            ->get();

        $rekap = $absensi->groupBy('nama_murid')
            ->map(function ($group) {
                return $group->count();
            })
            ->sortDesc() // <--- MENAMBAHKAN INI: Mengurutkan dari nilai terbesar ke terkecil
            ->toArray();

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
    // Set locale ke Bahasa Indonesia
    Carbon::setLocale('id');

    // Ambil bulan yang dipilih atau default ke bulan sekarang
    $bulanDipilih = $request->bulan ?? now()->format('Y-m');
    $carbonBulan = Carbon::createFromFormat('Y-m', $bulanDipilih);

    // Ambil semua data absensi dalam bulan yang dipilih
    $dataAbsensi = MuridAbsensi::whereMonth('tanggal_absen', $carbonBulan->month)
        ->whereYear('tanggal_absen', $carbonBulan->year)
        ->orderBy('tanggal_absen', 'asc')
        ->orderBy('nama_murid', 'asc')
        ->get()
        ->groupBy(function($item) {
            // Format tanggal dalam Bahasa Indonesia
            return Carbon::parse($item->tanggal_absen)->translatedFormat('l, d F Y');
        });

    // Buat PDF dengan view dan kirim ke browser
    $pdf = Pdf::loadView('admin.riwayatMurid.pdf', [
        'bulan' => $carbonBulan->translatedFormat('F Y'),
        'groupedAbsensi' => $dataAbsensi
    ])->setPaper('A4', 'portrait');

    return $pdf->stream('rekap-absensi-' . $carbonBulan->format('Y_m') . '.pdf');
}


}