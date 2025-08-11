<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\NotifikasiAdmin;

class PengajarController extends Controller
{
    public function index()
    {
        $pengajars = Pengajar::all();
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();
        return view('admin.pengajar.index', compact('pengajars', 'unreadCount'));
    }

    public function create()
    {
        return view('admin.pengajar.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pengajar' => 'required|string|max:255',
            'foto_pengajar' => 'nullable|image|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // Buat notifikasi admin
        NotifikasiAdmin::create([
            'aksi' => 'Admin Tambah Data Pengajar',
            'deskripsi' => 'Admin menambahkan pengajar bernama ' . $validated['nama_pengajar'],
        ]);        

        // Simpan foto pengajar jika ada
        if ($request->hasFile('foto_pengajar')) {
            $validated['foto_pengajar'] = $request->file('foto_pengajar')->store('foto_pengajar', 'public');
        }

        Pengajar::create($validated);
        return redirect()->route('admin.pengajar.index')->with('success', 'Data pengajar berhasil ditambahkan.');
    }

    public function show(Pengajar $pengajar)
    {
        return view('admin.pengajar.show', compact('pengajar'));
    }

    public function edit(Pengajar $pengajar)
    {
        return view('admin.pengajar.edit', compact('pengajar'));
    }

    public function update(Request $request, Pengajar $pengajar)
    {
        $validated = $request->validate([
            'nama_pengajar' => 'required|string|max:255',
            'foto_pengajar' => 'nullable|image|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);
        
        NotifikasiAdmin::create([
            'aksi' => 'Admin Edit Data Pengajar',
            'deskripsi' => 'Admin mengubah data pengajar bernama ' . $validated['nama_pengajar'],
        ]);
        

        if ($request->hasFile('foto_pengajar')) {
            if ($pengajar->foto_pengajar) {
                Storage::disk('public')->delete($pengajar->foto_pengajar);
            }
            $validated['foto_pengajar'] = $request->file('foto_pengajar')->store('foto_pengajar', 'public');
        }

        $pengajar->update($validated);
        return redirect()->route('admin.pengajar.index')->with('success', 'Data pengajar berhasil diperbarui.');
    }

    public function destroy(Pengajar $pengajar)
    {

        NotifikasiAdmin::create([
            'aksi' => 'Admin Hapus Data Pengajar',
            'deskripsi' => 'Admin menghapus pengajar bernama ' . $pengajar->nama_pengajar,
        ]);
        

        if ($pengajar->foto_pengajar) {
            Storage::disk('public')->delete($pengajar->foto_pengajar);
        }
        $pengajar->delete();
        return redirect()->route('admin.pengajar.index')->with('success', 'Data pengajar berhasil dihapus.');
    }

        public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || count($ids) === 0) {
            return redirect()->route('admin.pengajar.index')->with('error', 'Tidak ada data yang dipilih.');
        }

        $pengajars = Pengajar::whereIn('id_pendaftaran', $ids)->get();

        foreach ($pengajars as $pengajar) {

            foreach ($pengajars as $pengajar) {
                // hapus foto & data
                NotifikasiAdmin::create([
                    'aksi' => 'Admin Hapus Data Pengajar (Bulk)',
                    'deskripsi' => 'Admin menghapus pengajar bernama ' . $pengajar->nama_pengajar,
                ]);
                $pengajar->delete();
            }
            

            if ($pengajar->foto_pengajar && Storage::disk('public')->exists($pengajar->foto_pengajar)) {
                Storage::disk('public')->delete($pengajar->foto_pengajar);
            }
            $pengajar->delete();
        }

        return redirect()->route('admin.pengajar.index')->with('success', count($ids) . ' data pengajar berhasil dihapus.');
    }

        public function infoDataPengajar()
        {
            $pengajars = Pengajar::OrderBy('nama_pengajar', 'asc')->paginate(5);
            return view('pengajar.infoDataPengajar.index', compact('pengajars'));
        }



        
    }
