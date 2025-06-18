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

    /** Hapus beberapa testimoni terpilih */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (count($ids)) {
            TestimoniUser::whereIn('id', $ids)->delete();
            return back()->with('success', 'Testimoni terpilih berhasil dihapus.');
        }

        return back()->with('error', 'Tidak ada testimoni yang dipilih.');
    }

    /** Hapus SEMUA testimoni */
    public function deleteAll()
    {
        TestimoniUser::truncate();   // hapus seluruh isi tabel
        return back()->with('success', 'Semua testimoni berhasil dihapus.');
    }

}
