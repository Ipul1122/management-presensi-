@extends('components.layouts.admin.dashboardAdmin')

@section('content')
<style>
    .sidebar {
        transition: all 0.3s ease-in-out;
        backdrop-filter: blur(10px);
    }
    .sidebar.active {
        transform: translateX(0);
    }
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
        }
    }
    
    /* Custom gradient backgrounds */
    .gradient-blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .gradient-green {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .gradient-purple {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }
    .gradient-pink {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }
    
    /* Glassmorphism effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    
    /* Hover animations */
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
    }
    
    /* Notification badge animation */
    .notification-badge {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Table styling */
    .modern-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Button styles */
    .btn-modern {
        transition: all 0.3s ease;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- Main Container with Gradient Background -->
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
    
    <!-- Modern Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-white/20 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="hamburger" class="lg:hidden text-gray-600 hover:text-indigo-600 transition-colors duration-200">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-white text-lg"></i>
                            </div>
                            <div>
                                <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">TPA Nurul Haq</span>
                                <div class="text-xs text-gray-500">Admin Dashboard</div>
                            </div>
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

    <div class="flex flex-1">
        <!-- Modern Sidebar -->
        <!-- Modern Sidebar -->
<aside class="sidebar w-72 bg-white/90 backdrop-blur-md shadow-2xl border-r border-white/20 custom-scrollbar overflow-y-auto">
    <div class="p-6 space-y-2">
        <div class="flex justify-between items-center lg:hidden mb-6">
            <span class="font-bold text-gray-800">Menu Navigasi</span>
            <button id="closeSidebar" class="text-gray-600 hover:text-gray-800 p-2 hover:bg-gray-100 rounded-lg transition-all duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- MENU MURID SECTION -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 mb-4 px-2">
                <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-xs"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Data Murid</h3>
            </div>
            
            {{-- Tambah Data Murid --}}
            <a href="{{ route('admin.murid.create') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-user-plus text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-indigo-700">Tambah Data Murid</span>
            </a>

            {{-- Statistik Murid --}}
            <a href="{{ route('admin.dataMurid') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-chart-simple text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-indigo-700">Statistik Murid</span>
            </a>

            {{-- Manage Data Murid --}}
            <a href="{{ route('admin.murid.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-folder-open text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-indigo-700">Manage Data Murid</span>
            </a>
        </div>

        <!-- MENU PENGAJAR SECTION -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 mb-4 px-2">
                <div class="w-6 h-6 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-md flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xs"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Data Pengajar</h3>
            </div>

            {{-- Tambah Data Pengajar --}}
            <a href="{{ route('admin.pengajar.create') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-chalkboard-teacher text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-emerald-700">Tambah Data Pengajar</span>
            </a>
            
            {{-- Manage Data Pengajar --}}
            <a href="{{ route('admin.pengajar.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-users-cog text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-emerald-700">Manage Data Pengajar</span>
            </a>
        </div>

        <!-- MENU JADWAL SECTION -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 mb-4 px-2">
                <div class="w-6 h-6 bg-gradient-to-r from-yellow-400 to-yellow-800 rounded-md flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-white text-xs"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Jadwal</h3>
            </div>

            {{-- Manage Jadwal --}}
            <a href="{{ route('admin.jadwal.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-orange-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-yellow-800 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-calendar-days text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-yellow-700">Manage Jadwal</span>
            </a>
            
            {{-- Riwayat Jadwal --}}
            <a href="{{ route('admin.riwayatJadwal.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-orange-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-yellow-800 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-history text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-yellow-700">Riwayat Jadwal</span>
            </a>
        </div>

        <!-- MENU LAINNYA SECTION -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 mb-4 px-2">
                <div class="w-6 h-6 bg-gradient-to-r from-purple-500 to-pink-600 rounded-md flex items-center justify-center">
                    <i class="fas fa-cog text-white text-xs"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Lainnya</h3>
            </div>

            {{-- History Data / Notifikasi --}}
            <a href="{{ route('admin.notifikasi.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 rounded-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-bell text-white"></i>
                </div>
                <span class="font-medium text-gray-700 group-hover:text-purple-700">Notifikasi</span>
            </a>
        </div>
        
        {{-- LOGOUT SECTION --}}
        <div class="pt-4 border-t border-gray-200 mt-6">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="flex items-center space-x-3 p-4 w-full hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-sign-out-alt text-white"></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-red-700">Logout</span>
                </button>
            </form>
        </div>
        
        <div class="pt-4 text-center">
            <p class="text-sm text-gray-400 bg-gray-50 px-3 py-2 rounded-full">Versi Web 1.0</p>
        </div>
    </div>
</aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 lg:p-8 space-y-8 custom-scrollbar overflow-y-auto">
            
            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-8">
                <!-- Data Murid Card -->
                <div class="group card-hover bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100 overflow-hidden relative">
                    <div class="gradient-blue absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-8 translate-x-8 opacity-10"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center space-x-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-address-book text-2xl text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">MURID</h2>
                                <p class="text-gray-600 text-lg">Jumlah <span class="font-semibold text-indigo-600">{{ $jumlahMurid }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>    

                <!-- Data Pengajar Card -->
                <div class="group card-hover bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100 overflow-hidden relative">
                    <div class="gradient-green absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-8 translate-x-8 opacity-10"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center space-x-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-chalkboard-teacher text-2xl text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">DATA PENGAJAR</h2>
                                <p class="text-gray-600 text-lg">Jumlah <span class="font-semibold text-emerald-600">{{ $jumlahPengajar }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manage Data Murid Card -->
                <div class="group card-hover bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100 overflow-hidden relative">
                    <div class="gradient-purple absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-8 translate-x-8 opacity-10"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center space-x-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-folder-open text-2xl text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">MURID</h2>
                                <p class="text-gray-600">Edit, Hapus, Update</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.murid.index') }}">
                            <button class="btn-modern bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl">
                                KELOLA <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Manage Data Pengajar Card -->
                <div class="group card-hover bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100 overflow-hidden relative">
                    <div class="gradient-pink absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-8 translate-x-8 opacity-10"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center space-x-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-users-cog text-2xl text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">PENGAJAR</h2>
                                <p class="text-gray-600">Edit, Hapus, Update</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.pengajar.index') }}">
                            <button class="btn-modern bg-gradient-to-r from-pink-500 to-rose-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl">
                                MANAGE <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Jadwal Management Section -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
        <h3 class="text-2xl font-bold text-white flex items-center">
            <i class="fas fa-calendar-alt mr-3"></i>
            Manajemen Jadwal
        </h3>
        <p class="text-indigo-100 mt-2">MANAGE jadwal kegiatan TPA</p>
    </div>
    
    <div class="p-6">
        <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
            @csrf
            @method('DELETE')

            <!-- Mobile Card Layout (Hidden on desktop) -->
            <div class="block lg:hidden space-y-4">
                @foreach ($jadwalBulanIni as $jadwal)
                    <div class="bg-gradient-to-r from-white to-gray-50 border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="selected_jadwals[]" value="{{ $jadwal->id }}" 
                                    class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500 focus:ring-2">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-calendar-day text-white text-lg"></i>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            @php
                                $today = \Carbon\Carbon::today();
                                $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_jadwal);
                                
                                if ($tanggal->lt($today)) {
                                    $status = 'Selesai';
                                    $statusClass = 'bg-gray-100 text-gray-600';
                                } elseif ($tanggal->isToday()) {
                                    $status = 'Hari Ini';
                                    $statusClass = 'bg-green-100 text-green-700';
                                } else {
                                    $status = 'Akan Datang';
                                    $statusClass = 'bg-blue-100 text-blue-700';
                                }
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ $status }}
                            </span>
                        </div>
                        
                        <div class="space-y-3">
                            <h4 class="font-bold text-lg text-gray-800 leading-tight">{{ $jadwal->nama_jadwal }}</h4>
                            
                            <div class="grid grid-cols-1 gap-3">
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="fas fa-calendar text-indigo-500 w-4"></i>
                                    <span class="text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="fas fa-clock text-emerald-500 w-4"></i>
                                    <span class="text-sm">{{ $jadwal->pukul_jadwal }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="fas fa-user-teacher text-purple-500 w-4"></i>
                                    <span class="text-sm">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                </div>
                                
                                <div class="flex items-start space-x-2 text-gray-600">
                                    <i class="fas fa-tasks text-orange-500 w-4 mt-0.5"></i>
                                    <span class="text-sm">{{ $jadwal->kegiatan_jadwal }}</span>
                                </div>
                                
                                <div class="flex items-start space-x-2 text-gray-600">
                                    <i class="fas fa-tasks text-orange-500 w-4 mt-0.5"></i>
                                    <span class="text-sm">{ $Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons for Mobile -->
                        <div class="flex justify-end mt-4 space-x-2">
                            <button type="button" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-xs rounded-lg hover:shadow-md transition-all duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button type="button" class="px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 text-white text-xs rounded-lg hover:shadow-md transition-all duration-200">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table Layout (Hidden on mobile) -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full modern-table">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <th class="px-6 py-4 text-left">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                            </th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Pukul</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Nama Jadwal</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Pengajar</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Kegiatan</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Gaji</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($jadwalBulanIni as $jadwal)
                            <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="selected_jadwals[]" value="{{ $jadwal->id }}" 
                                        class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        {{-- TANGGAL JADWAL --}}
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d M Y') }}
                                            </div>
                                            {{-- <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('') }}
                                            </div> --}}
                                        </div>
                                    </div>
                                </td>
                                {{-- PUKUL JADWAL --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                        {{-- <i class="fas fa-clock mr-1 text-xs"></i> --}}
                                        {{ $jadwal->pukul_jadwal }}
                                    </span>
                                </td>
                                {{-- NAMA JADWAL --}}
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $jadwal->nama_jadwal }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        {{-- NAMA PENGAJAR --}}
                                        <span class="text-gray-900 font-medium">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                    </div>
                                </td>
                                {{-- KEGIATAN JADWAL --}}
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="text-gray-900 text-sm leading-relaxed">{{ $jadwal->kegiatan_jadwal }}</p>
                                    </div>
                                </td>
                                {{-- GAJI  --}}
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="text-gray-900 text-sm leading-relaxed">Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_jadwal);
                                        
                                        if ($tanggal->lt($today)) {
                                            $status = 'Selesai';
                                            $statusClass = 'bg-gray-100 text-gray-600';
                                            $iconClass = 'fas fa-check-circle';
                                        } elseif ($tanggal->isToday()) {
                                            $status = 'Hari Ini';
                                            $statusClass = 'bg-green-100 text-green-700';
                                            $iconClass = 'fas fa-circle text-green-500';
                                        } else {
                                            $status = 'Akan Datang';
                                            $statusClass = 'bg-blue-100 text-blue-700';
                                            $iconClass = 'fas fa-clock text-blue-500';
                                        }
                                    @endphp
                                    {{-- STATUS JADWAL --}}
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}">
                                            <button type="button" class="p-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:shadow-md transition-all duration-200 group">
                                                <i class="fas fa-edit text-sm group-hover:scale-110 transition-transform"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-between mt-8 space-y-4 sm:space-y-0 p-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border">
                <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 btn-modern group">
                    <i class="fas fa-cog mr-2 group-hover:rotate-180 transition-transform duration-300"></i>
                    MANAGE Jadwal
                </a>

                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 w-full sm:w-auto">
                    <button type="submit" name="action" value="selected" 
                            class="btn-modern bg-gradient-to-r from-red-500 to-rose-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl flex items-center justify-center group" 
                            onclick="return confirm('Hapus jadwal yang dipilih?')">
                        <i class="fas fa-trash-alt mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="hidden sm:inline">Hapus Terpilih</span>
                        <span class="sm:hidden">Hapus Pilihan</span>
                    </button>

                    <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="action" value="all">
                        <button type="submit"  
                        class="btn-modern bg-gradient-to-r from-red-700 to-red-900 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl flex items-center justify-center group" 
                        onclick="return confirm('Hapus semua jadwal?')">
                        <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                        Hapus Semua
                    </button>
                </form>

                </div>
            </div>

            <!-- Empty State -->
            @if($jadwalBulanIni->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Jadwal</h3>
                    <p class="text-gray-500 mb-6">Belum ada jadwal yang tersedia untuk bulan ini</p>
                    <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Jadwal Baru
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
        </main>
    </div>
</div>

<script>
    // Select all checkbox functionality
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('input[name="selected_jadwals[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
        
    // Hamburger menu functionality
    const hamburger = document.getElementById('hamburger');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.querySelector('.sidebar');

    hamburger.addEventListener('click', () => {
        sidebar.classList.add('active');
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });

    // Smooth scrolling for better UX
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection