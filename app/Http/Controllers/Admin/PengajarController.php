<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajar;

class PengajarController extends Controller
{
    //
    public function index(){
        $pengajar = Pengajar::all();
        return view('admin.pengajar.index', compact('pengajar'));
    }

    public function edit($id){
        $pengajar = Pengajar::find($id);
        return view('admin.pengajar.edit', compact('pengajar'));
    }

    public function update(Request $request, $id){
        $pengajar = Pengajar::find($id);
        $pengajar->update($request->all());

        return redirect()->route('pengajar.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id){
        $pengajar = Pengajar::find($id);
        $pengajar->delete();

        return redirect()->route('pengajar.index')->with('berhasil', 'Data Berhasil Dihapus');
    }

    public function create(){
        return view('admin.pengajar.index');
    }

    public function store(Request $request){
        $request->validate([
            'nama_pengajar' => 'required',
            'foto_pengajar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();

        $data['foto_pengajar'] = $request->file('foto_pengajar')->store('foto_pengajar', 'public');
        
    }

    public function show($id){
        $pengajar = Pengajar::find($id);
        return view('admin.pengajar.show', compact('pengajar'));
    }

}


