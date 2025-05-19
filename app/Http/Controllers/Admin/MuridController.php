<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use Illuminate\Support\Facades\Storage;

class MuridController extends Controller
{
    public function index()
    {
        $murids = Murid::with('anak')->latest()->get();
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
        'tanggal_daftar' => 'required|date',
    ]);

    // Simpan foto jika ada
    if ($request->hasFile('foto_anak')) {
        $validatedData['foto_anak'] = $request->file('foto_anak')->store('foto_anak', 'public');
    }

    // Simpan ke database
    $murid = Murid::create($validatedData);

    // Redirect ke halaman show dengan flash message
    return redirect()->route('admin.murid.show', $murid->id_pendaftaran)
                    ->with('success', 'Data telah dibuat.');
}



    public function edit($id)
    {
        return view('admin.murid.edit');
    }

    // public function show($id)
    // {
    //     $murid = Murid::findOrFail($id);
    //     return view('admin.murid.show', compact('murid'));
    // }

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
            'foto_anak' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // max dalam kilobytes
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

        return redirect()->route('murid.index')->with('success', 'Data murid berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $murid = Murid::findOrFail($id);

        if ($murid->foto_anak && Storage::disk('public')->exists($murid->foto_anak)) {
            Storage::disk('public')->delete($murid->foto_anak);
        }

        $murid->delete();

        return redirect()->route('murid.index')->with('success', 'Data murid berhasil dihapus.');
    }
}
