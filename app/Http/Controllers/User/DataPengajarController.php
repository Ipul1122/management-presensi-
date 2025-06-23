<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajar;

class DataPengajarController extends Controller
{


    public function index(){

        
        // PENGAJAR

        

        $pengajars = Pengajar::all();


        return view('user.informasi.dataPengajar.index', compact('pengajars'));
    }
}
