<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestimoniUser;

class TestimoniUserController extends Controller
{
    // Menampilkan semua testimoni untuk dikonfirmasi
    public function index()
    {

        $testimonis = TestimoniUser::orderBy('created_at', 'desc')->get();
        return view('admin.testimoniUser.index', compact('testimonis'));
    }

    // Setujui testimoni
    public function approve($id)
    {
        $testimoni = TestimoniUser::findOrFail($id);
        $testimoni->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Testimoni disetujui dan akan ditampilkan di halaman user.');
    }

    // Tolak testimoni
    public function reject($id)
    {
        $testimoni = TestimoniUser::findOrFail($id);
        $testimoni->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Testimoni telah ditolak.');
    }
}
