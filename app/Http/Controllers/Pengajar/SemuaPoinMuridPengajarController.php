<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\MuridAbsensi;
use App\Models\MataPelajaran;
use App\Models\PoinSikap;
use App\Models\NotifikasiAdmin;

class SemuaPoinMuridPengajarController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. SETUP FILTER PERIODE ---
        $availablePeriods = MuridAbsensi::selectRaw('YEAR(tanggal_absen) as year, MONTH(tanggal_absen) as month')
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $periodList = [];
        $namaBulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach($availablePeriods as $p) {
            $val = sprintf('%d-%02d', $p->year, $p->month);
            $label = $namaBulanIndo[$p->month] . ' ' . $p->year;
            $periodList[$val] = $label;
        }

        if (empty($periodList)) {
            $periodList[date('Y-m')] = $namaBulanIndo[(int)date('m')] . ' ' . date('Y');
        }

        $defaultPeriod = array_key_first($periodList);
        $selectedPeriod = $request->input('periode', $defaultPeriod);
        $search = $request->input('search');

        $parts = explode('-', $selectedPeriod);
        $tahun = $parts[0];
        $bulan = $parts[1];

        // --- 2. AMBIL DATA ---
        
        // [BARU] Ambil semua daftar nama murid untuk dropdown search suggestion
        $allMurids = Murid::orderBy('nama_anak', 'asc')->pluck('nama_anak');

        // A. Data Murid (Master) dengan Filter Pencarian
        $queryMurid = Murid::query();

        if ($search) {
            $queryMurid->where('nama_anak', 'LIKE', "%{$search}%");
        }

        $murids = $queryMurid->orderBy('nama_anak', 'asc')->get();

        // B. Rekap Absensi
        $rekapAbsensi = MuridAbsensi::whereYear('tanggal_absen', $tahun)
            ->whereMonth('tanggal_absen', $bulan)
            ->where('jenis_status', 'Hadir') 
            ->selectRaw('nama_murid, count(*) as total') 
            ->groupBy('nama_murid')
            ->pluck('total', 'nama_murid');

        // C. Rekap Mata Pelajaran
        $rekapMapel = MataPelajaran::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->selectRaw('nama_murid, SUM(nilai) as total')
            ->groupBy('nama_murid')
            ->pluck('total', 'nama_murid');

        // D. Rekap Sikap
        $rekapSikap = PoinSikap::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->selectRaw('nama_murid, SUM(jumlah_poin) as total')
            ->groupBy('nama_murid')
            ->pluck('total', 'nama_murid');

        // --- 3. MAPPING DATA ---
        $dataGabungan = $murids->map(function($murid) use ($rekapAbsensi, $rekapMapel, $rekapSikap) {
            $jumlahHadir = $rekapAbsensi[$murid->nama_anak] ?? 0;
            $poinHadir = $jumlahHadir * 1; 
            $poinMapel = $rekapMapel[$murid->nama_anak] ?? 0;
            $poinSikap = $rekapSikap[$murid->nama_anak] ?? 0;
            $totalSemua = $poinHadir + $poinMapel + $poinSikap;

            $murid->poin_hadir = $poinHadir;
            $murid->jumlah_hadir = $jumlahHadir;
            $murid->poin_mapel = $poinMapel;
            $murid->poin_sikap = $poinSikap;
            $murid->total_poin_akhir = $totalSemua;

            return $murid;
        });

        $dataGabungan = $dataGabungan->sortByDesc('total_poin_akhir');

        // --- 4. VIEW ---
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();
        $judulPeriode = $periodList[$selectedPeriod] ?? 'Periode Terpilih';

        return view('pengajar.semuaPoinMuridPengajar.index', compact(
            'dataGabungan',
            'unreadCount',
            'notifikasi',
            'periodList',
            'selectedPeriod',
            'judulPeriode',
            'search',
            'allMurids' // Kirim variabel baru ini
        ));
    }
}