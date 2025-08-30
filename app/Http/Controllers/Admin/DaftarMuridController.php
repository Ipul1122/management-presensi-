<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Daftar;
use App\Models\Murid;

class DaftarMuridController extends Controller
{
    public function index()
    {
        $daftar = Daftar::all();
        return view('admin.daftarMurid.index', compact('daftar'));
    }

   public function terima($id)
{
    $daftar = Daftar::findOrFail($id);

    // Pastikan path foto bersih
    $fotoPath = str_replace('public/', '', $daftar->foto_anak);

    Murid::create([
        'nama_anak'     => $daftar->nama_anak,
        'foto_anak'     => $fotoPath, // ✅ sekarang sama formatnya dengan DaftarController
        'jenis_kelamin' => $daftar->jenis_kelamin,
        'alamat'        => $daftar->alamat,
        'kelas'         => $daftar->kelas,
        'jenis_bacaan' => $daftar->jenis_bacaan,
        'tanggal_daftar'=> $daftar->tanggal_daftar,
        'nomor_telepon' => $daftar->nomor_telepon,
        'ayah'          => $daftar->ayah,
        'ibu'           => $daftar->ibu,
    ]);

    $daftar->delete();

    return redirect()->route('admin.daftarMurid.index')
        ->with('success', 'Pendaftar berhasil diterima dan dipindahkan ke data murid.');
}

    public function tolak($id)
    {
        $pendaftar = Daftar::findOrFail($id);
        $pendaftar->delete();

        return redirect()->route('admin.daftarMurid.index')->with('error', 'Pendaftar berhasil ditolak.');
    }
}
