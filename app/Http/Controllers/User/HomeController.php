<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\User\HomeController;
use App\Models\TestimoniUser;

class HomeController extends Controller
{
    public function index()
    {
        $testimonis = TestimoniUser::where('status', 'approved')->latest()->get();
        return view('index', compact('testimonis'));
    }
}
