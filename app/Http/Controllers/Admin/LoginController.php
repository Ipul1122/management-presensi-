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
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'pengajar') {
                return redirect()->route('pengajar.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['username' => 'Role tidak valid.']);
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
