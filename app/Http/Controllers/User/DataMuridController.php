<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;

class DataMuridController extends Controller
{
    public function index(Request $request){

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

    // Perbaiki filter jenis bacaan/alkitab agar case-insensitive
    if ($request->filled('jenis_bacaan')) {
        $jenisBacaan = strtolower($request->jenis_bacaan);
        $query->whereRaw('LOWER(jenis_alkitab) = ?', [$jenisBacaan]);
    }

    $murids = $query->paginate(10)->appends($request->all());
    $jumlah_murid = Murid::count();
    $kelas_list = Murid::select('kelas')->distinct()->pluck('kelas');
    

    return view('user.informasi.dataMurid.index', compact('murids', 'jumlah_murid', 'kelas_list'));
    }
}
