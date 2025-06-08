<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\MuridAbsensi;
use App\Models\Murid;
use Illuminate\Http\Request;

class MuridAbsensiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data filter dari request
        $filterNama = $request->nama_murid;
        $filterKelamin = $request->jenis_kelamin;
        $filterBacaan = $request->jenis_bacaan;
        $filterStatus = $request->jenis_status;

        // Query dasar
        $query = MuridAbsensi::query();

        // Terapkan filter jika ada
        if ($filterNama) {
            $query->where('nama_murid', $filterNama);
        }
        if ($filterKelamin) {
            $query->where('jenis_kelamin', $filterKelamin);
        }
        if ($filterBacaan) {
            $query->where('jenis_bacaan', $filterBacaan);
        }
        if ($filterStatus) {
            $query->where('jenis_status', $filterStatus);
        }

        $absensis = $query->latest()->paginate(10)->appends($request->except('page'));

        // Hitung jumlah murid berdasarkan jenis_status (tanpa filter)
        $hadirCount = MuridAbsensi::where('jenis_status', 'Hadir')->count();
        $izinCount = MuridAbsensi::where('jenis_status', 'Izin')->count();

        // Data untuk dropdown filter
        $namaList = MuridAbsensi::select('nama_murid')->distinct()->orderBy('nama_murid')->pluck('nama_murid');
        $kelaminList = MuridAbsensi::select('jenis_kelamin')->distinct()->pluck('jenis_kelamin');
        $bacaanList = MuridAbsensi::select('jenis_bacaan')->distinct()->pluck('jenis_bacaan');
        $statusList = MuridAbsensi::select('jenis_status')->distinct()->pluck('jenis_status');

        return view('pengajar.muridAbsensi.index', compact(
            'absensis', 'hadirCount', 'izinCount',
            'namaList', 'kelaminList', 'bacaanList', 'statusList',
            'filterNama', 'filterKelamin', 'filterBacaan', 'filterStatus'
        ));
    }

    public function create(Request $request)
{
    $murids = Murid::all();
    $selectedMurid = null;

    if ($request->has('nama_murid')) {
        $selectedMurid = Murid::where('nama_anak', $request->nama_murid)->first();
    }

    return view('pengajar.muridAbsensi.create', compact('murids', 'selectedMurid'));
}


    public function edit($id)
    {
        $absensi = MuridAbsensi::findOrFail($id);
        $murids = Murid::all();
        return view('pengajar.muridAbsensi.edit', compact('absensi', 'murids'));   
    }

    public function update(Request $request, $id){
        // Validasi
        $validated  = $request->validate([
            'nama_murid' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jenis_bacaan' => 'required|string',
            'jenis_status' => 'required|in:hadir,izin',
            'tanggal_absen' => 'required|date',
            'catatan' => 'nullable|string',
        ]);
        
        $absensi = MuridAbsensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('pengajar.muridAbsensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy($id){
        $absensi = MuridAbsensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('pengajar.muridAbsensi.index')->with('success', 'Absensi berhasil dihapus.');
    }
    


    public function store(Request $request)
{
    // Validasi
    $validated = $request->validate([
        'nama_murid' => 'required|string',
        'jenis_kelamin' => 'required|string',
        'jenis_bacaan' => 'required|string',
        'jenis_status' => 'required|in:hadir,izin',
        'tanggal_absen' => 'required|date',
        'catatan' => 'nullable|string',
    ]);

    // Simpan ke DB
    MuridAbsensi::create([
        'nama_murid' => $validated['nama_murid'],
        'jenis_kelamin' => $validated['jenis_kelamin'],
        'jenis_bacaan' => $validated['jenis_bacaan'],
        'jenis_status' => $validated['jenis_status'],
        'tanggal_absen' => $validated['tanggal_absen'],
        'catatan' => $validated['catatan'] ?? null,
    ]);

    return redirect()->route('pengajar.muridAbsensi.index')->with('success', 'Absensi berhasil disimpan.');
}



    // Fitur otomatisasi ketika memilih murid akan mengisi data secara otomatis
    public function getMurid($nama)
    {
        $murid = Murid::where('nama_anak', $nama)->first();

        if ($murid) {
            return response()->json([
                'jenis_kelamin' => $murid->jenis_kelamin,
                'jenis_bacaan' => $murid->jenis_alkitab,
            ]);
        }

        return response()->json(['error' => 'Murid tidak ditemukan'], 404);
    }

    public function show($id)
    {
        $absensi = MuridAbsensi::with('murid')->findOrFail($id);
        return view('pengajar.muridAbsensi.show', compact('absensi'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            MuridAbsensi::whereIn('id', $ids)->delete();
            return redirect()->route('pengajar.muridAbsensi.index')->with('success', 'Data terpilih berhasil dihapus.');
        }
        return redirect()->route('pengajar.muridAbsensi.index')->with('error', 'Tidak ada data yang dipilih.');
    }

    public function deleteAll()
    {
        MuridAbsensi::truncate();
        return redirect()->route('pengajar.muridAbsensi.index')->with('success', 'Semua data absensi berhasil dihapus.');
    }

}
