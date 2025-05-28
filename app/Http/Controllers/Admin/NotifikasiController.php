<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotifikasiAdmin;

class NotifikasiController extends Controller
{
    //
    public function index()
    {
        $notifikasi = NotifikasiAdmin::latest()->get();

        NotifikasiAdmin::where('is_read', false)->update(['is_read' => true]);

        return view('admin.notifikasi.index', compact('notifikasi'));
    }

    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);
    if (!is_array($ids) || count($ids) === 0) {
        return redirect()->route('admin.notifikasi.index')->with('error', 'Tidak ada notifikasi yang dipilih.');
    }

    NotifikasiAdmin::whereIn('id', $ids)->delete();

    return redirect()->route('admin.notifikasi.index')->with('success', 'Beberapa notifikasi berhasil dihapus.');
}

public function deleteAll()
{
    NotifikasiAdmin::truncate(); // atau ->delete() jika ingin logik lebih kompleks
    return redirect()->route('admin.notifikasi.index')->with('success', 'Semua notifikasi berhasil dihapus.');
}
}
