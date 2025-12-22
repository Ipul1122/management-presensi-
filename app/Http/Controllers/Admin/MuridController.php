<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use Illuminate\Support\Facades\Storage;
use App\Models\NotifikasiAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use Barryvdh\DomPDF\Facade\Pdf;

class MuridController extends Controller
{
    public function index(Request $request)
    {
        // Memulai query dari model Murid
        $query = Murid::query();

        // Filter Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('id_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('ayah', 'like', "%{$search}%")
                  ->orWhere('ibu', 'like', "%{$search}%");
            });
        }

        // Filter Gender
        if ($request->filled('gender')) {
            $query->where('jenis_kelamin', $request->gender);
        }

        // Filter Kitab
        if ($request->filled('kitab')) {
            $query->where('jenis_alkitab', $request->kitab);
        }

        // Filter Kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // Ambil data dengan pagination (urutkan terbaru)
        $murids = $query->orderBy('created_at', 'asc')->paginate(10);
        
        $unreadCount = NotifikasiAdmin::where('is_read', false)->count();

        // Return view dengan membawa data pencarian agar input tidak reset
        return view('admin.murid.index', compact('murids', 'unreadCount'));
    }


    public function create()
{
    return view('admin.murid.create');
}


public function store(Request $request)
{
    Log::info('MuridController@store called', ['request' => $request->all()]);

    // Validasi untuk array
    $validatedData = $request->validate([
        'nama_anak.*' => 'required|string|max:255',
        'foto_anak.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'jenis_kelamin.*' => 'required|in:Laki-laki,Perempuan',
        'alamat.*' => 'required|string',
        'kelas.*' => 'required|string',
        'jenis_alkitab.*' => 'required|in:iqro,Al-Quran',
        'tanggal_daftar.*' => 'required|date',
        'nomor_telepon.*' => 'required|string|max:20',
        'ayah.*' => 'required|string|max:255',
        'ibu.*' => 'required|string|max:255',
    ]);

    $count = count($request->nama_anak); // Jumlah pendaftaran

    for ($i = 0; $i < $count; $i++) {
        $muridData = [
            'nama_anak'      => $request->nama_anak[$i],
            'jenis_kelamin'  => $request->jenis_kelamin[$i],
            'alamat'         => $request->alamat[$i],
            'kelas'          => $request->kelas[$i],
            'jenis_alkitab'  => $request->jenis_alkitab[$i],
            'tanggal_daftar' => $request->tanggal_daftar[$i],
            'nomor_telepon'  => $request->nomor_telepon[$i],
            'ayah'           => $request->ayah[$i],
            'ibu'            => $request->ibu[$i],
        ];

        // Upload foto jika ada
        if (isset($request->foto_anak[$i]) && $request->foto_anak[$i] instanceof \Illuminate\Http\UploadedFile) {
            $muridData['foto_anak'] = $request->foto_anak[$i]->store('foto_anak', 'public');
        }

        // Simpan ke database
        $murid = Murid::create($muridData);

        // Buat notifikasi
        NotifikasiAdmin::create([
            'aksi'       => 'Admin Tambah Data Murid',
            'deskripsi'  => 'Admin menambahkan Murid bernama ' . $murid->nama_anak,
        ]);

        Log::info('MuridController@store success', ['data' => $muridData]);
    }

    return redirect()->route('admin.murid.index')
                    ->with('success', 'Semua data pendaftaran berhasil disimpan.');
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
            'nomor_telepon' => 'required|string|max:20',
            'ayah' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'foto_anak' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // max dalam kilobytes
        ]);        

        NotifikasiAdmin::create([
            'aksi' => 'Admin Edit Data Murid',
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
            'aksi' => 'Admin Hapus Data Murid',
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
                'aksi' => 'Admin Hapus Data murid (Bulk)',
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
            'aksi' => 'Admin Hapus Data Murid (Bulk)',
            'deskripsi' => 'Admin menghapus Murid bernama ' . $ids->nama_murid,
        ]);
        return redirect()->route('admin.murid.index')->with('success', 'Seluruh data murid telah dihapus.');
    }

    // Cetak PDF method
    public function cetakPDF()
{
    // Ambil semua data murid dengan field yang sesuai dengan view PDF
    $murid = Murid::select([
        'id_pendaftaran',
        'nama_anak',
        'jenis_kelamin',
        'alamat',
        'kelas',
        'jenis_alkitab',        // pastikan field ini ada di database
        'nomor_telepon',        // pastikan field ini ada di database
        'ayah',      // pastikan field ini ada di database
        'ibu'        // pastikan field ini ada di database
    ])->get();

    $pdf = Pdf::loadView('admin.murid.pdf', compact('murid'));
    return $pdf->stream('data-murid.pdf');
}

}


