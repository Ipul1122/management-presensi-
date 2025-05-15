<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← PENTING: Import base Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ← Untuk Auth
use Illuminate\Support\Facades\Hash; // ← Untuk Hashing
use App\Models\Pengguna;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // ... (atas tetap sama)
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = Pengguna::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->role !== 'admin') {
                return back()->withErrors(['username' => 'Anda tidak memiliki akses admin.']);
            }

            Auth::guard('admin')->login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'login' => 'Sepertinya ada yang salah nih, cek lagi ya.',
        ])->withInput();
        
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
