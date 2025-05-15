<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller; // ← Import base Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ← Untuk login/logout
use Illuminate\Support\Facades\Hash; // ← Untuk verifikasi password
use App\Models\Pengguna;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pengajar.login');
    }

   // ... (atas tetap sama)
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = Pengguna::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::guard('pengajar')->login($user, true); // Use 'pengajar' guard

            if ($user->role === 'pengajar') {
                return redirect()->route('pengajar.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['username' => 'Role tidak valid.']);
        }

        return back()->withErrors([
            'login' => 'Sepertinya ada yang salah nih, cek lagi ya.',
        ])->withInput();        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('pengajar.login');
    }
}
