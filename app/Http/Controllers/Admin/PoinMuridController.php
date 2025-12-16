<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Murid;
use App\Models\MuridAbsensi; 
use App\Models\NotifikasiAdmin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PoinMuridController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Periode (Bulan & Tahun) yang HANYA ada datanya
        $availablePeriods = MuridAbsensi::selectRaw('YEAR(tanggal_absen) as year, MONTH(tanggal_absen) as month')
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // 2. Siapkan List untuk Dropdown
        $periodList = [];
        $namaBulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach($availablePeriods as $p) {
            // Format Value: "2025-02"
            $val = sprintf('%d-%02d', $p->year, $p->month);
            // Format Label: "Februari 2025"
            $label = $namaBulanIndo[$p->month] . ' ' . $p->year;
            
            $periodList[$val] = $label;
        }

        // Handle jika data kosong sama sekali
        if (empty($periodList)) {
            $nowVal = date('Y-m');
            $periodList[$nowVal] = $namaBulanIndo[(int)date('m')] . ' ' . date('Y');
        }

        // 3. Tentukan Periode Terpilih
        // Default ke periode paling baru (array key pertama)
        $defaultPeriod = array_key_first($periodList);
        $selectedPeriod = $request->input('periode', $defaultPeriod);

        // Pecah "2025-02" menjadi Tahun dan Bulan untuk Query
        $parts = explode('-', $selectedPeriod);
        $tahun = $parts[0];
        $bulan = $parts[1];

        // 4. Query Data Murid
        $dataMurid = Murid::withCount(['absensis as total_hadir' => function ($query) use ($bulan, $tahun) {
            $query->where('jenis_status', 'Hadir')
                  ->whereMonth('tanggal_absen', $bulan)
                  ->whereYear('tanggal_absen', $tahun);
        }])->get();

        $dataMurid = $dataMurid->sortByDesc('total_hadir');

        // 5. Data Pendukung Lainnya
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();

        // Variabel untuk judul halaman
        $judulPeriode = $namaBulanIndo[(int)$bulan] . ' ' . $tahun;

        return view('admin.poinMuridTpa.index', compact(
            'dataMurid', 
            'unreadCount', 
            'notifikasi',
            'periodList',
            'selectedPeriod',
            'judulPeriode'
        ));
    }
}