<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js') {{-- Pastikan Tailwind terhubung --}}
</head>
<body class="">

    <!-- components/navbar.blade.php -->
<style>
    .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .nav-icon {
        transition: all 0.2s ease;
    }
    
    .nav-icon:hover {
        transform: scale(1.1);
    }
</style>

<!-- Header/Navbar -->
<header class="glass-effect sticky top-0 z-40 border-b border-gray-200/50">
    <nav class="px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Left Section -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">TPA Nurul Haq</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Dashboard Pengajar</p>
                    </div>
                </div>
            </div>

            <!-- Right Section - Navigation Icons -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('pengajar.infoDataMurid.index') }}" 
                    class="nav-icon p-3 rounded-lg hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition-all">
                    <i class="fas fa-users"></i>
                    <span class="sr-only">Data Murid</span>
                </a>
                <a href="{{ route('pengajar.infoDataPengajar.index') }}" 
                    class="nav-icon p-3 rounded-lg hover:bg-green-50 text-green-600 hover:text-green-700 transition-all">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="sr-only">Data Pengajar</span>
                </a>
                <form action="{{ route('pengajar.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="nav-icon p-3 rounded-lg hover:bg-red-50 text-red-600 hover:text-red-700 transition-all">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="sr-only">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>
    
        {{-- Konten utama halaman --}}
        <main class="">
            @yield('navbar-pengajar')
        </main>


    {{-- @stack('scripts') --}}
</body>
</html>
