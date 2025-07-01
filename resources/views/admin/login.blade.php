@extends('components.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">
        <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Left Side - Illustration -->
                <div class="lg:w-1/2 bg-gradient-to-br from-teal-400 to-blue-500 p-8 flex items-center justify-center">
                    <div class="text-center text-white">
                        <!-- Admin Illustration -->
                        <div class="mb-6">
                            <svg viewBox="0 0 400 300" class="w-full max-w-sm mx-auto">
                                <!-- Desk -->
                                <rect x="50" y="200" width="300" height="80" fill="#4A5568" rx="8"/>
                                <rect x="40" y="220" width="320" height="60" fill="#2D3748" rx="6"/>
                                
                                <!-- Monitor -->
                                <rect x="120" y="120" width="160" height="100" fill="#1A202C" rx="8"/>
                                <rect x="130" y="130" width="140" height="80" fill="#63B3ED" rx="4"/>
                                
                                <!-- Monitor Stand -->
                                <rect x="185" y="220" width="30" height="20" fill="#4A5568"/>
                                <rect x="170" y="235" width="60" height="8" fill="#2D3748" rx="4"/>
                                
                                <!-- Person -->
                                <!-- Head -->
                                <circle cx="200" cy="80" r="25" fill="#F7B889"/>
                                <!-- Hair -->
                                <path d="M175 65 Q200 45 225 65 Q225 55 200 50 Q175 55 175 65" fill="#8B4513"/>
                                <!-- Glasses -->
                                <circle cx="190" cy="80" r="8" fill="none" stroke="#2D3748" stroke-width="2"/>
                                <circle cx="210" cy="80" r="8" fill="none" stroke="#2D3748" stroke-width="2"/>
                                <line x1="198" y1="80" x2="202" y2="80" stroke="#2D3748" stroke-width="2"/>
                                
                                <!-- Body -->
                                <rect x="175" y="105" width="50" height="80" fill="#3182CE" rx="25"/>
                                <!-- Arms -->
                                <rect x="155" y="120" width="20" height="50" fill="#3182CE" rx="10"/>
                                <rect x="225" y="120" width="20" height="50" fill="#3182CE" rx="10"/>
                                
                                <!-- Laptop -->
                                <rect x="160" y="190" width="80" height="40" fill="#4A5568" rx="4"/>
                                <rect x="165" y="195" width="70" height="30" fill="#1A202C" rx="2"/>
                                
                                <!-- Papers -->
                                <rect x="90" y="180" width="40" height="30" fill="white" rx="2"/>
                                <rect x="280" y="185" width="35" height="25" fill="white" rx="2"/>
                                
                                <!-- Coffee Cup -->
                                <circle cx="320" cy="200" r="12" fill="#8B4513"/>
                                <rect x="308" y="200" width="24" height="8" fill="#D69E2E"/>
                                
                                <!-- Floating Elements -->
                                <circle cx="80" cy="100" r="3" fill="rgba(255,255,255,0.3)"/>
                                <circle cx="340" cy="80" r="4" fill="rgba(255,255,255,0.2)"/>
                                <circle cx="70" cy="160" r="2" fill="rgba(255,255,255,0.4)"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Selamat Datang Admin!</h3>
                        <p class="text-teal-100">Akses ke admin dashboard</p>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="lg:w-1/2 p-8 lg:p-12">
                    <div class="max-w-sm mx-auto">
                        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">LOGIN ADMIN</h2>
                        
                        @if ($errors->has('login'))
                            <div class="bg-red-50 text-red-600 border border-red-200 px-4 py-3 rounded-lg relative mb-6" role="alert">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ $errors->first('login') }}</span>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <input type="text" 
                                    name="username" 
                                    required 
                                    placeholder="Username"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition duration-200 text-gray-700 placeholder-gray-400">
                            </div>

                            <div>
                                <input type="password" 
                                    name="password" 
                                    required 
                                    placeholder="Password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition duration-200 text-gray-700 placeholder-gray-400">
                            </div>

                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 transform hover:scale-[1.02] transition duration-200 shadow-lg">
                                Login
                            </button>
                        </form>

                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-500">
                                Secure admin access only
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection