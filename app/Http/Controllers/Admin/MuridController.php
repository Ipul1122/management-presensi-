<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use Illuminate\Support\Facades\Storage;
use App\Models\NotifikasiAdmin;
use Illuminate\Support\Facades\DB;

class MuridController extends Controller
{
        public function index()
    {
        $murids = Murid::orderBy('created_at', 'desc')->paginate(10); // Gunakan paginate
        return view('admin.murid.index', compact('murids'));
    }


    public function create()
{
    return view('admin.murid.create');
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_anak' => 'required|string|max:255',
        'foto_anak' => 'nullable|image|max:2048',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'alamat' => 'required|string',
        'kelas' => 'required|string',
        'jenis_alkitab' => 'required|in:iqro,Al-Quran',
        'tanggal_daftar' => 'required|date',
        ' foto_anak' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // max dalam kilobytes
    ]);


    NotifikasiAdmin::create([
        'aksi' => 'Tambah Data Murid',
        'deskripsi' => 'Admin menambahkan Murid bernama ' . $validatedData['nama_anak'],
    ]);  

    // Simpan foto jika ada
    if ($request->hasFile('foto_anak')) {
        $validatedData['foto_anak'] = $request->file('foto_anak')->store('foto_anak', 'public');
    }

    // Simpan ke database
    $murid = Murid::create($validatedData);

    // Redirect ke halaman show dengan flash message
    return redirect()->route('admin.murid.index', $murid->id_pendaftaran)
                    ->with('success', 'Data telah dibuat.');
}

public function edit($id)
{
    $murid = Murid::findOrFail($id);
    return view('admin.murid.edit', compact('murid'));
}

    public function show()
    {
        $murids = Murid::orderBy('created_at', 'desc')->paginate(10);
    
        return view('admin.murid.show', compact('murids'));
    }

    public function update(Request $request, $id)
    {
        $murid = Murid::findOrFail($id);

        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'kelas' => 'required|string',
            'tanggal_daftar' => 'required|date',
            'jenis_alkitab' => 'required|in:iqro,Al-Quran',
            'foto_anak' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // max dalam kilobytes
        ]);        

        NotifikasiAdmin::create([
            'aksi' => 'Edit Data Murid',
            'deskripsi' => 'Admin mengubah data Murid bernama ' . $request['nama_anak'],
        ]);

        $data = $request->all();

        // Update foto jika ada file baru
        if ($request->hasFile('foto_anak')) {
            if ($murid->foto_anak && Storage::disk('public')->exists($murid->foto_anak)) {
                Storage::disk('public')->delete($murid->foto_anak);
            }

            $data['foto_anak'] = $request->file('foto_anak')->store('foto_anak', 'public');
        }

        $murid->update($data);

        return redirect()->route('admin.murid.index')->with('success', 'Data murid berhasil diperbarui.');
    }

    public function destroy($id)
    {

        
        $murid = Murid::findOrFail($id);
        NotifikasiAdmin::create([
            'aksi' => 'Hapus Data Murid',
            'deskripsi' => 'Admin menghapus Murid bernama ' . $murid->nama_murid,
        ]);
        
        if ($murid->foto_anak && Storage::disk('public')->exists($murid->foto_anak)) {
            Storage::disk('public')->delete($murid->foto_anak);
        }

        $murid->delete();

        return redirect()->route('admin.murid.index')->with('success', 'Data murid berhasil dihapus.');
    }


    // dataMurid method to display statistics

    public function dataMurid()
    {
    $totalLaki = Murid::where('jenis_kelamin', 'Laki-laki')->count();
    $totalPerempuan = Murid::where('jenis_kelamin', 'Perempuan')->count();

    $kelasCounts = Murid::select('kelas', DB::raw('count(*) as total'))
        ->groupBy('kelas')
        ->orderBy('kelas')
        ->get();

    $totalIqro = Murid::where('jenis_alkitab', 'iqro')->count();
    $totalQuran = Murid::where('jenis_alkitab', 'Al-Quran')->count();

    return view('admin.dataMurid', compact(
        'totalLaki', 'totalPerempuan',
        'kelasCounts', 'totalIqro', 'totalQuran'
    ));
    }

    
    
    
    
    
    
    
    /**
     * Bulk delete murids.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);

    if (!is_array($ids) || count($ids) === 0) {
        return redirect()->route('admin.murid.index')->with('error', 'Tidak ada data yang dipilih.');
    }

    $murids = Murid::whereIn('id_pendaftaran', $ids)->get();

    foreach ($murids as $murid) {

        foreach ($murids as $murid) {
            // hapus foto & data
            NotifikasiAdmin::create([
                'aksi' => 'Hapus Data murid (Bulk)',
                'deskripsi' => 'Admin menghapus murid bernama ' . $murid->nama_anak,
            ]);
            $murid->delete();
        }
        

        if ($murid->foto_murid && Storage::disk('public')->exists($murid->foto_murid)) {
            Storage::disk('public')->delete($murid->foto_murid);
        }
        $murid->delete();
    }

    return redirect()->route('admin.murid.index')->with('success', count($ids) . ' data pengajar berhasil dihapus.');
}

    public function deleteAll()
    {
        $ids = Murid::all()->pluck('id');
        Murid::truncate(); // hapus semua data
        NotifikasiAdmin::create([
            'aksi' => 'Hapus Data Murid (Bulk)',
            'deskripsi' => 'Admin menghapus Murid bernama ' . $ids->nama_murid,
        ]);
        return redirect()->route('admin.murid.index')->with('success', 'Seluruh data murid telah dihapus.');
    }


}


