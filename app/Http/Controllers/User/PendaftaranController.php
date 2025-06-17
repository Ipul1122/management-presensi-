<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Pengajar;

class PendaftaranController extends Controller
{
    public function index()
    {

        $murids = Murid::count();
        $pengajars = Pengajar::count();

        return view('user.pendaftaran.index' , compact('murids', 'pengajars'));
    }
}
