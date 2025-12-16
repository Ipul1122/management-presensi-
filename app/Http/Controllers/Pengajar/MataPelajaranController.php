<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\MataPelajaran;
use App\Models\NotifikasiAdmin;
use Carbon\Carbon;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $murids = Murid::orderBy('nama_anak')->get();
        
        // Ambil nama pengajar
        $user = auth()->guard('pengajar')->user();
        $namaPengajar = $user->username ?? $user->nama ?? 'Pengajar';

        // Riwayat input hari ini (Opsional, agar mirip fitur sebelumnya)
        // UPDATE: Dibatasi maksimal 10 data terbaru. 
        // Data ke-11 dan seterusnya tidak akan diambil (seolah-olah tertimpa di tampilan).
        $riwayat = MataPelajaran::where('nama_pengajar', $namaPengajar)
                    ->whereDate('created_at', Carbon::today())
                    ->latest()
                    ->take(1) // Membatasi hanya 10 record
                    ->get();

        return view('pengajar.mataPelajaran.index', compact('murids', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_murid' => 'required',
            'nilai' => 'required|integer|min:1|max:10',
            'deskripsi' => 'nullable|string'
        ]);

        $user = auth()->guard('pengajar')->user();
        $namaPengajar = $user->username ?? $user->nama ?? 'Pengajar';

        MataPelajaran::create([
            'nama_murid' => $request->nama_murid,
            'nama_pengajar' => $namaPengajar,
            'nilai' => $request->nilai,
            'deskripsi' => $request->deskripsi
        ]);

        // Notifikasi ke Admin
        NotifikasiAdmin::create([
            'aksi' => 'Penilaian Mapel',
            'deskripsi' => "$namaPengajar memberi nilai {$request->nilai} ke {$request->nama_murid}",
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }

    // ... method index & store ...

    public function destroy($id)
    {
        $nilai = MataPelajaran::findOrFail($id);
        
        // Cek Otorisasi: Pastikan pengajar hanya menghapus datanya sendiri
        $user = auth()->guard('pengajar')->user();
        $namaPengajar = $user->username ?? $user->nama ?? 'Pengajar';

        if ($nilai->nama_pengajar !== $namaPengajar) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk menghapus data ini.');
        }

        $nilai->delete();

        return redirect()->back()->with('success', 'Penilaian berhasil dihapus.');
    }
}