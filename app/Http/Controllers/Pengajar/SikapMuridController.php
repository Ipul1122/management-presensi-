<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\PoinSikap;
use App\Models\NotifikasiAdmin;
use Carbon\Carbon;

class SikapMuridController extends Controller
{
    public function index()
    {
        // 1. Ambil Nama Pengajar yang sedang Login
        $user = auth()->guard('pengajar')->user();
        
        // UPDATE DISINI: Tambahkan pengecekan '$user->username'
        $namaPengajar = $user->nama_pengajar ?? $user->nama ?? $user->username ?? 'Pengajar';

        // 2. Ambil Riwayat Hari Ini KHUSUS Pengajar Ini
        $riwayatHariIni = PoinSikap::where('nama_pengajar', $namaPengajar)
                            ->whereDate('created_at', Carbon::today())
                            ->latest()
                            ->get();

        $murids = Murid::orderBy('nama_anak')->get();

        return view('pengajar.sikapMuridTpa.index', compact('murids', 'riwayatHariIni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_murid' => 'required',
            'sikap' => 'required|array|min:1' 
        ]);

        $pilihanSikap = $request->sikap;
        $totalPoin = count($pilihanSikap); 

        // 1. Ambil Nama Pengajar (Fix: Gunakan username)
        $user = auth()->guard('pengajar')->user();
        
        // UPDATE DISINI JUGA:
        $namaPengajar = $user->nama_pengajar ?? $user->nama ?? $user->username ?? 'Pengajar';

        // 2. Simpan ke Database
        PoinSikap::create([
            'nama_murid' => $request->nama_murid,
            'nama_pengajar' => $namaPengajar, // Sekarang akan terisi "Syaiful", "Rini", dll
            'jumlah_poin' => $totalPoin,
            'detail_sikap' => $pilihanSikap 
        ]);

        // Notifikasi ke Admin
        NotifikasiAdmin::create([
            'aksi' => 'Penilaian Sikap',
            'deskripsi' => $namaPengajar . ' memberi ' . $totalPoin . ' poin sikap ke ' . $request->nama_murid,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Poin sikap berhasil ditambahkan!');
    }
    
    public function destroy($id)
    {
        $sikap = PoinSikap::findOrFail($id);
        $sikap->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}