<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\User\HomeController;
use App\Models\TestimoniUser;
use App\Models\Murid;
use App\Models\Pengajar;

class HomeController extends Controller
{
    public function index()
    {

        $murids = Murid::count();
        $pengajars = Pengajar::count();

        $testimonis = TestimoniUser::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('index', compact('testimonis', 'murids', 'pengajars'));
    }
}
