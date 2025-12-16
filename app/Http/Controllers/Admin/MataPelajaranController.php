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
        // 1. SETUP FILTER PERIODE
        // Ambil daftar bulan & tahun yang ada datanya di database
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
            $val = sprintf('%d-%02d', $p->year, $p->month); // Format: 2025-05
            $label = $namaBulanIndo[$p->month] . ' ' . $p->year; // Format: Mei 2025
            $periodList[$val] = $label;
        }

        // Jika data kosong total, default ke bulan sekarang
        if (empty($periodList)) {
            $periodList[date('Y-m')] = $namaBulanIndo[(int)date('m')] . ' ' . date('Y');
        }

        // Tentukan periode terpilih (Default: Periode terbaru)
        $defaultPeriod = array_key_first($periodList);
        $selectedPeriod = $request->input('periode', $defaultPeriod);
        
        // Pecah periode menjadi tahun dan bulan
        $parts = explode('-', $selectedPeriod);
        $tahun = $parts[0];
        $bulan = $parts[1];
        
        $judulPeriode = $periodList[$selectedPeriod] ?? 'Periode Ini';

        // 2. QUERY DATA DENGAN FILTER
        $dataNilai = MataPelajaran::whereYear('created_at', $tahun)
                        ->whereMonth('created_at', $bulan)
                        ->latest()
                        ->paginate(10)
                        ->appends(['periode' => $selectedPeriod]); // Agar filter tidak hilang saat pindah halaman

        // 3. DATA NAVBAR
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();

        return view('admin.mataPelajaran.index', compact(
            'dataNilai', 
            'unreadCount', 
            'notifikasi',
            'periodList',
            'selectedPeriod',
            'judulPeriode'
        ));
    }

    public function destroy($id)
    {
        $nilai = MataPelajaran::findOrFail($id);
        $nilai->delete();

        return redirect()->back()->with('success', 'Data penilaian berhasil dihapus oleh Admin.');
    }
}