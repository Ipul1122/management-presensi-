<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Pengajar;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Murid::query();

    // Filter
    if ($request->filled('search')) {
        $query->where('nama_anak', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('jenis_kelamin')) {
        $query->where('jenis_kelamin', $request->jenis_kelamin);
    }

    if ($request->filled('kelas')) {
        $query->where('kelas', $request->kelas);
    }

    if ($request->filled('jenis_alkitab')) {
        $query->where('jenis_bacaan', $request->jenis_alkitab);
    }

    $murids = $query->paginate(10)->appends($request->all());
    $jumlah_murid = Murid::count();
    $kelas_list = Murid::select('kelas')->distinct()->pluck('kelas');

    // PENGAJAR
    $pengajars = Pengajar::all();

    return view('user.informasi.index', compact('murids', 'jumlah_murid', 'kelas_list', 'pengajars'));
}}
