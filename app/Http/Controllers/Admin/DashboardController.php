<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMurid = Murid::count();
        return view('admin.dashboard', compact('jumlahMurid'));
    }
}
