<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Pengajar;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMurid = Murid::count();
        $jumlahPengajar = Pengajar::count();
        return view('admin.dashboard', compact('jumlahMurid', 'jumlahPengajar'));
    }
}
