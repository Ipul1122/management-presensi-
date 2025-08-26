{{-- resources/views/pengajar/login.blade.php --}}
@extends('components.layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gray-100">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="flex flex-col lg:flex-row min-h-[600px]">
                {{-- Left Side - Vector Illustration --}}
                <div class="lg:w-1/2 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600 relative overflow-hidden">
                    <div class="absolute inset-0 bg-black opacity-10"></div>
                    <div class="relative z-10 flex flex-col items-center justify-center h-full p-8 text-center text-white">
                        {{-- Vector SVG Illustration --}}
                        <div class="mb-8">
                            <svg class="w-48 h-48 mx-auto" viewBox="0 0 300 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                                {{-- Desk --}}
                                <rect x="50" y="180" width="200" height="40" rx="8" fill="#4A5568" stroke="#2D3748" stroke-width="2"/>
                                
                                {{-- Teacher figure --}}
                                <circle cx="150" cy="70" r="25" fill="#FFE4B5" stroke="#D2B48C" stroke-width="2"/>
                                <path d="M125 95 Q150 105 175 95 L180 150 Q150 160 120 150 Z" fill="#4A90E2" stroke="#2E5C8A" stroke-width="2"/>
                                
                                {{-- Computer/Laptop --}}
                                <rect x="130" y="145" width="40" height="25" rx="2" fill="#2D3748" stroke="#1A202C" stroke-width="1"/>
                                <rect x="132" y="147" width="36" height="18" rx="1" fill="#4299E1"/>
                                
                                {{-- Books --}}
                                <rect x="80" y="160" width="25" height="20" rx="2" fill="#FF6B6B" stroke="#E55555" stroke-width="1"/>
                                <rect x="195" y="160" width="25" height="20" rx="2" fill="#4ECDC4" stroke="#3DB5AA" stroke-width="1"/>
                                
                                {{-- Coffee cup --}}
                                <ellipse cx="200" cy="155" rx="8" ry="6" fill="#D69E2E" stroke="#B7791F" stroke-width="1"/>
                                
                                {{-- Floating elements --}}
                                <circle cx="80" cy="40" r="8" fill="#FFE066" opacity="0.8"/>
                                <circle cx="220" cy="50" r="6" fill="#96CEB4" opacity="0.8"/>
                                <circle cx="60" cy="100" r="5" fill="#FFEAA7" opacity="0.6"/>
                                <circle cx="240" cy="120" r="4" fill="#DDA0DD" opacity="0.7"/>
                                
                                {{-- Decorative lines --}}
                                <path d="M30 80 Q80 70 130 80" stroke="#FFFFFF" stroke-width="2" opacity="0.3" fill="none"/>
                                <path d="M170 70 Q220 60 270 70" stroke="#FFFFFF" stroke-width="2" opacity="0.3" fill="none"/>
                            </svg>
                        </div>
                        
                        <h1 class="text-3xl font-bold mb-3">Selamat Datang Pengajar!</h1>
                        <p class="text-lg opacity-90 mb-4">Akses ke portal pengajar</p>
                        <p class="text-sm opacity-75 max-w-sm mx-auto">
                            Masuk ke akun Anda untuk mengakses dashboard dan mengelola pembelajaran dengan mudah.
                        </p>
                    </div>
                    
                    {{-- Decorative shapes --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full transform translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full transform -translate-x-12 translate-y-12"></div>
                </div>

                {{-- Right Side - Login Form --}}
                <div class="lg:w-1/2 flex items-center justify-center p-8">
                    <div class="w-full max-w-sm">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">LOGIN PENGAJAR</h2>
                            <p class="text-gray-600 text-sm">Silakan masuk dengan kredensial Anda</p>
                        </div>

                        {{-- Error Message --}}
                        @if ($errors->has('login'))
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm">{{ $errors->first('login') }}</span>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('pengajar.login') }}" method="POST" class="space-y-6">
                            @csrf

                            {{-- Username Field --}}
                            <div>
                                <input type="text" name="username" required 
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors duration-200"
                                       placeholder="Username">
                            </div>

                           {{-- Password Field with Toggle --}}
                            <div class="relative">
                                <input type="password" name="password" id="password" required 
                                    class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors duration-200"
                                    placeholder="Password">
                                
                                {{-- Eye Toggle Button --}}
                                <button type="button" 
                                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 focus:outline-none"
                                        onclick="togglePassword()">
                                    <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                    </svg>
                                </button>
                            </div>

                            {{-- Login Button --}}
                            <div class="pt-2">
                                <button type="submit" 
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-200">
                                    Login
                                </button>
                            </div>
                        </form>

                        {{-- Footer --}}
                        <div class="mt-8 text-center">
                            <p class="text-lg text-gray-500">
                                Lupa password?
                                <a href="https://wa.me/+6285693672730" class="text-blue-600 hover:underline">
                                    <span>
                                        <strong> Hub Admin</strong>
                                    </span>
                                    </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}
</script>
@endsection