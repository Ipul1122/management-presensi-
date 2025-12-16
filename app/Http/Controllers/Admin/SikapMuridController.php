<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoinSikap;
use App\Models\NotifikasiAdmin;
use Illuminate\Support\Facades\DB;


class SikapMuridController extends Controller
{
    public function index(Request $request)
    {
        // 1. DATA FILTER (Periode & Pengajar)
        // ... (Bagian ini TETAP SAMA seperti sebelumnya) ...
        $availablePeriods = PoinSikap::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
            ->distinct()->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

        $periodList = [];
        $namaBulanIndo = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];

        foreach($availablePeriods as $p) {
            $periodList[sprintf('%d-%02d', $p->year, $p->month)] = $namaBulanIndo[$p->month] . ' ' . $p->year;
        }
        if (empty($periodList)) $periodList[date('Y-m')] = $namaBulanIndo[(int)date('m')] . ' ' . date('Y');

        $defaultPeriod = array_key_first($periodList);
        $selectedPeriod = $request->input('periode', $defaultPeriod);
        $parts = explode('-', $selectedPeriod);
        $tahun = $parts[0]; 
        $bulan = $parts[1];

        $pengajarList = PoinSikap::select('nama_pengajar')->distinct()->orderBy('nama_pengajar')->pluck('nama_pengajar');
        $selectedPengajar = $request->input('filter_pengajar');

        // 2. QUERY DATA
        // Base Query (Filter Tahun & Bulan)
        $queryBase = PoinSikap::whereYear('created_at', $tahun)
                              ->whereMonth('created_at', $bulan);

        // Filter Pengajar (Jika dipilih)
        if ($selectedPengajar) {
            $queryBase->where('nama_pengajar', $selectedPengajar);
        }

        // A. Klasemen (Top Murid) - TETAP SAMA
        $dataSikap = (clone $queryBase)
                        ->select('nama_murid', DB::raw('SUM(jumlah_poin) as total_poin'))
                        ->groupBy('nama_murid')
                        ->orderByDesc('total_poin')
                        ->get();

        // B. Riwayat Detail - [DIPERBARUI]
        // Menggunakan take(10) agar hanya ambil 10 data terbaru
        $riwayatPenilaian = (clone $queryBase)
                                ->latest()
                                ->take(10) // Limit 10 data saja
                                ->get();   // Eksekusi query (bukan paginate)

        // 3. DATA PENDUKUNG
        $judulPeriode = $periodList[$selectedPeriod] ?? 'Periode Ini';
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        $notifikasi = NotifikasiAdmin::latest()->take(10)->get();

        return view('admin.sikapMuridTpa.index', compact(
            'dataSikap', 'riwayatPenilaian', 'unreadCount', 'notifikasi',
            'periodList', 'selectedPeriod', 'judulPeriode',
            'pengajarList', 'selectedPengajar'
        ));
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID, jika tidak ada tampilkan 404
        $log = PoinSikap::findOrFail($id);

        // Simpan info nama untuk pesan notifikasi
        $namaMurid = $log->nama_murid;
        $pengajar = $log->nama_pengajar;

        // Hapus data
        $log->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', "Log penilaian untuk $namaMurid oleh $pengajar berhasil dihapus.");
    }
}
