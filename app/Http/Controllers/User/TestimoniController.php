<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestimoniUser;
use App\Models\NotifikasiAdmin;
use Illuminate\Support\Facades\DB;

class TestimoniController extends Controller
{
    /** Menampilkan form */
    public function index()
    {
        return view('user.testimoni.index');
    }

    /** Menyimpan testimoni user */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_user'     => 'required|string|max:100',
            'foto_user'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi_testimoni' => 'required|string|max:500',
        ]);

        // Simpan dalam transaksi agar notifikasi & testimoni konsisten
        DB::transaction(function () use ($request, &$validated) {

            /* ── upload foto sekali ─────────────────────── */
            if ($request->hasFile('foto_user')) {
                $validated['foto_user'] = $request->file('foto_user')
                                                    ->store('testimoni', 'public');
            }

            /* ── buat testimoni hanya SEKALI ────────────── */
            $testimoni = TestimoniUser::create(array_merge(
                $validated,
                ['status' => 'pending']   // jika Anda punya kolom status
            ));

            /* ── notifikasi admin ───────────────────────── */
            NotifikasiAdmin::create([
                'aksi'       => 'User memberikan testimoni',
                'deskripsi'  => $testimoni->nama_user . ' memberikan testimoni',
                'is_read'    => false,
            ]);
        });

        return back()->with('success',
            'Testimoni kamu telah dikirim dan akan ditinjau oleh admin.');
    }
}
