<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js') {{-- Pastikan Tailwind terhubung --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="">
        {{-- Konten utama halaman --}}
        

        <!-- Modern Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-white/20 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <div>
                            <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">TPA Nurul Haq</span>
                            <div class="text-xs text-gray-500">Admin Dashboard</div>
                        </div>
                    </div>
                    
                    <!-- Mobile Action Buttons -->
                    <div class="flex space-x-3 text-xl md:hidden">
                        <a href="{{ route('admin.murid.create') }}">
                        <button title="Tambah Data" class="p-2 text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50 rounded-lg transition-all duration-200">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </button>
                        <a href="{{ route('admin.notifikasi.index') }}" class="relative p-2" title="Notifikasi">
                            <i class="fas fa-bell text-emerald-600 hover:text-emerald-800 transition-colors duration-200"></i>
                            @if ($unreadCount > 0)
                                <span class="notification-badge absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                </span>
                            @endif
                        </a>
                        
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline-block">
                            @csrf
                            <button title="Logout" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Desktop Action Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('admin.murid.create') }}" >
                        <button title="Tambah Data" class="p-3 text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50 rounded-xl transition-all duration-200 btn-modern">
                            <i class="fas fa-plus-circle text-lg"></i>
                        </button>
                    </a>
                    <a href="{{ route('admin.notifikasi.index') }}" class="relative p-3" title="Notifikasi">
                        <i class="fas fa-bell text-emerald-600 hover:text-emerald-800 text-lg transition-colors duration-200"></i>
                        @if ($unreadCount > 0)
                            <span class="notification-badge absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                            </span>
                        @endif
                    </a>
                    
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button title="Logout" class="p-3 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-xl transition-all duration-200 btn-modern">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    {{-- end navbar --}}


    </div>

    @stack('scripts')
</body>
</html>
