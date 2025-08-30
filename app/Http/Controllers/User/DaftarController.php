<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Daftar;

class DaftarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    public function index()
    {
        // Ambil semua data pendaftaran murid
        $daftars = Daftar::latest()->get();

        // Kirim ke view user.daftar.index
        return view('user.daftar.index', compact('daftars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'ayah' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'tanggal_daftar' => 'required|date',
            'foto_anak' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // ✅ Simpan foto jika ada
        if ($request->hasFile('foto_anak')) {
            $data['foto_anak'] = $request->file('foto_anak')->store('foto_anak', 'public');
        }

        Daftar::create($data);

        return redirect()->route('user.daftar.index')
            ->with('success', 'Terima kasih telah daftar, akan direspon oleh admin.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Daftar $daftar)
    {
        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'ayah' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'tanggal_daftar' => 'required|date',
            'foto_anak' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // ✅ Update foto jika ada upload baru
        if ($request->hasFile('foto_anak')) {
            $data['foto_anak'] = $request->file('foto_anak')->store('foto_anak', 'public');
        }

        $daftar->update($data);

        return redirect()->route('user.daftar.index')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
