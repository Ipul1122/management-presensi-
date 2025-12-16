<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\NotifikasiAdmin;
use Carbon\Carbon;

class MataPelajaranController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. SETUP FILTER PERIODE ---
        $availablePeriods = MataPelajaran::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
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
        
        $parts = explode('-', $selectedPeriod);
        $tahun = $parts[0];
        $bulan = $parts[1];
        $judulPeriode = $periodList[$selectedPeriod] ?? 'Periode Ini';

        // --- 2. SETUP FILTER PENGAJAR (BARU) ---
        // Ambil daftar nama pengajar yang pernah input data
        $daftarPengajar = MataPelajaran::select('nama_pengajar')
                            ->distinct()
                            ->orderBy('nama_pengajar')
                            ->pluck('nama_pengajar');

        $selectedPengajar = $request->input('pengajar');

        // --- 3. QUERY DATA (REKAP & AKTIVITAS) ---
        
        // Base Query untuk filter tahun, bulan, dan pengajar (jika ada)
        $queryBase = MataPelajaran::whereYear('created_at', $tahun)
                        ->whereMonth('created_at', $bulan)
                        ->when($selectedPengajar, function($q) use ($selectedPengajar) {
                            return $q->where('nama_pengajar', $selectedPengajar);
                        });

        // A. REKAP TOTAL (Clone query base agar tidak bentrok)
        $rekapNilai = (clone $queryBase)
                        ->selectRaw('
                            nama_murid, 
                            nama_pengajar, 
                            SUM(nilai) as total_nilai, 
                            COUNT(id) as jumlah_input, 
                            MAX(created_at) as last_update
                        ')
                        ->groupBy('nama_murid', 'nama_pengajar')
                        ->orderByDesc('total_nilai')
                        ->paginate(10, ['*'], 'rekap_page')
                        ->appends(['periode' => $selectedPeriod, 'pengajar' => $selectedPengajar]);

        // B. RIWAYAT AKTIVITAS (Clone query base)
        $aktivitas = (clone $queryBase)
                        ->latest()
                        ->paginate(20, ['*'], 'log_page') // Dibatasi 10 per halaman
                        ->appends(['periode' => $selectedPeriod, 'pengajar' => $selectedPengajar]);

        // --- 4. DATA NOTIFIKASI ---
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();

        return view('admin.mataPelajaran.index', compact(
            'rekapNilai', 
            'aktivitas', 
            'unreadCount', 
            'notifikasi',
            'periodList',
            'selectedPeriod',
            'judulPeriode',
            'daftarPengajar',    // Variable baru ke View
            'selectedPengajar'   // Variable baru ke View
        ));
    }

    public function destroy($id)
    {
        $nilai = MataPelajaran::findOrFail($id);
        $nilai->delete();

        return redirect()->back()->with('success', 'Data penilaian berhasil dihapus.');
    }
}