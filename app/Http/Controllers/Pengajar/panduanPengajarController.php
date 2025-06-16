<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Pengajar\panduanPengajarRequest;

class panduanPengajarController extends Controller
{
    // 
    public function index()
    {
        return view('pengajar.panduanPengajar.index');
    }
}
