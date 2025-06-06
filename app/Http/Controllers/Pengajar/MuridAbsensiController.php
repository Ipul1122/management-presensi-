<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\MuridAbsensi;
use App\Models\Murid;
use Illuminate\Http\Request;

class MuridAbsensiController extends Controller
{
    public function index()
    {
        $absensis = MuridAbsensi::latest()->paginate(5);
        return view('pengajar.muridAbsensi.index', compact('absensis'));
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

}
