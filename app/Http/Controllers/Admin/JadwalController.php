<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Pengajar; 
use App\Models\NotifikasiAdmin;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::whereMonth('tanggal_jadwal', Carbon::now()->month)
                     ->whereYear('tanggal_jadwal', Carbon::now()->year)
                     ->orderBy('tanggal_jadwal', 'asc')
                     ->paginate(5); 
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();

    return view('admin.jadwal.index', compact('jadwals', 'unreadCount'));
    }

    public function create()
    {
          $pengajars = Pengajar::all(); // Ambil semua pengajar
        return view('admin.jadwal.create', compact('pengajars'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'nama_jadwal' => 'required|array|min:1',
        'nama_jadwal.*' => 'required|string',
        'tanggal_jadwal' => 'required|array|min:1',
        'tanggal_jadwal.*' => 'required|date',
        'pukul_jadwal' => 'required|array|min:1',
        'pukul_jadwal.*' => 'required|string',
        'kegiatan_jadwal' => 'required|array|min:1',
        'kegiatan_jadwal.*' => 'required|string',
        'nama_pengajar_jadwal' => 'required|array|min:1',
    ]);

    $jumlahJadwal = count($request->nama_jadwal);

    for ($i = 0; $i < $jumlahJadwal; $i++) {
        // Ambil pengajar untuk jadwal ini
        $pengajarJadwal = $request->nama_pengajar_jadwal[$i] ?? [];
        $jumlahPengajar = count($pengajarJadwal);
        $gaji = $jumlahPengajar * 50000;

        // Simpan jadwal
        $jadwal = Jadwal::create([
            'nama_jadwal' => $request->nama_jadwal[$i],
            'tanggal_jadwal' => $request->tanggal_jadwal[$i],
            'pukul_jadwal' => $request->pukul_jadwal[$i],
            'kegiatan_jadwal' => $request->kegiatan_jadwal[$i],
            'nama_pengajar_jadwal' => implode(', ', $pengajarJadwal),
            'gaji' => $gaji,
        ]);

        // Simpan notifikasi untuk setiap jadwal baru
        NotifikasiAdmin::create([
            'pesan' => 'Admin menambahkan jadwal baru: ' . $request->nama_jadwal[$i],
            'aksi' => 'Admin Tambah Jadwal',
            'deskripsi' => 'Jadwal baru telah ditambahkan dengan nama: ' . $request->nama_jadwal[$i]
        ]);
    }

    return redirect()->route('admin.dashboard')->with('success', 'Semua jadwal berhasil ditambahkan');
}


    public function edit($id)
    {
    
        $jadwal = Jadwal::findOrFail($id);
        $pengajarTerpilih = explode(', ', $jadwal->nama_pengajar_jadwal); // Mengubah string menjadi array
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jadwal' => 'required',
            'tanggal_jadwal' => 'required|date',
            'pukul_jadwal' => 'required',
            'nama_pengajar_jadwal' => 'required',
            'kegiatan_jadwal' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        // Pada form edit, nama_pengajar_jadwal dikirim sebagai string, bukan array
        // Hitung jumlah pengajar berdasarkan koma
        $pengajarString = $request->nama_pengajar_jadwal;
        $pengajars = array_map('trim', explode(',', $pengajarString));
        $pengajars = array_filter($pengajars, function($v) { return $v !== ''; }); // hilangkan kosong
        $jumlahPengajar = count($pengajars);
        $gaji = $jumlahPengajar * 50000;

        $jadwal->update([
            'nama_jadwal' => $request->nama_jadwal,
            'tanggal_jadwal' => $request->tanggal_jadwal,
            'pukul_jadwal' => $request->pukul_jadwal,
            'kegiatan_jadwal' => $request->kegiatan_jadwal,
            'nama_pengajar_jadwal' => $pengajarString,
            'gaji' => $gaji,
        ]);

        NotifikasiAdmin::create([
            'pesan' => 'Admin mengubah jadwal: ' . $request->nama_jadwal,
            'aksi' => 'Admin Ubah Jadwal',
            'deskripsi' => 'Jadwal telah diperbarui dengan nama: ' . $request->nama_jadwal
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.dashboard', compact('jadwal'));
    }

    public function destroy($id)
    {

        
        $jadwal = Jadwal::findOrFail($id);
        NotifikasiAdmin::create([
        'pesan' => 'Admin menghapus jadwal: ' . $jadwal->nama_jadwal,
        'aksi' => 'Admin Hapus Jadwal',
        'deskripsi' => 'Jadwal telah dihapus dengan nama: ' . $jadwal->nama_jadwal
        ]);
        $jadwal->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil dihapus');
    }

    // Fungsi untuk menghapus semua jadwal atau jadwal terpilih
public function bulkDelete(Request $request)
{
    $action = $request->input('action');

    if ($action === 'selected' && $request->has('selected_jadwals')) {
        $jadwals = Jadwal::whereIn('id', $request->selected_jadwals)->get();

        foreach ($jadwals as $jadwal) {
            NotifikasiAdmin::create([
                'pesan' => 'Admin menghapus jadwal: ' . $jadwal->nama_jadwal,
                'aksi' => 'Admin Hapus Jadwal',
                'deskripsi' => 'Jadwal telah dihapus dengan nama: ' . $jadwal->nama_jadwal
            ]);
            $jadwal->delete();
        }

    } elseif ($action === 'all') {
        // Hapus hanya jadwal pada bulan dan tahun saat ini
        $now = now();
        $jadwals = Jadwal::whereMonth('tanggal_jadwal', $now->month)
                        ->whereYear('tanggal_jadwal', $now->year)
                        ->get();

        foreach ($jadwals as $jadwal) {
            NotifikasiAdmin::create([
                'pesan' => 'Admin menghapus jadwal: ' . $jadwal->nama_jadwal,
                'aksi' => 'Admin Hapus Jadwal',
                'deskripsi' => 'Jadwal telah dihapus dengan nama: ' . $jadwal->nama_jadwal
            ]);
            $jadwal->delete();
        }
    }

    return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil dihapus.');
}

// DELETE ALL JADWAL
public function bulkDestroy(Request $request)
{
    $ids = $request->selected_ids;
    if ($ids) {
        Jadwal::whereIn('id', $ids)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal terpilih berhasil dihapus.');
    }
    return redirect()->route('admin.jadwal.index')->with('success', 'Tidak ada jadwal yang dipilih.');
}


}


