<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestimoniUser;
use App\Models\NotifikasiAdmin;

class TestimoniController extends Controller
{
    // Menampilkan form input testimoni
    public function index()
    {
        return view('user.testimoni.index');
    }

    // Menyimpan testimoni user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:100',
            'foto_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi_testimoni' => 'required|string|max:500',
        ]);

        $validated = $request->validate([
        'nama_user' => 'required|string|max:100',
        'foto_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'isi_testimoni' => 'required|string|max:500',
    ]);

    // Simpan testimoni user
        $testimoni = TestimoniUser::create($validated);

        // Buat notifikasi untuk admin
        NotifikasiAdmin::create([
        'aksi' => 'User memberikan testimoni',
        'deskripsi' => $validated['nama_user'] . ' memberikan testimoni',
        'is_read' => false,
        ]);



        // Jika upload foto
        if ($request->hasFile('foto_user')) {
            $validated['foto_user'] = $request->file('foto_user')->store('testimoni', 'public');
        }

        TestimoniUser::create($validated);

        return redirect()->back()->with('success', 'Testimoni kamu telah dikirim dan akan ditinjau oleh admin.');
    }
}
