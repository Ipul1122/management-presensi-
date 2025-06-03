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
        <aside class="sidebar w-72 bg-white/90 backdrop-blur-md shadow-2xl border-r border-white/20 custom-scrollbar overflow-y-auto">
            <div class="p-6 space-y-2">
                <div class="flex justify-between items-center lg:hidden mb-6">
                    <span class="font-bold text-gray-800">Menu Navigasi</span>
                    <button id="closeSidebar" class="text-gray-600 hover:text-gray-800 p-2 hover:bg-gray-100 rounded-lg transition-all duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Menu Items -->
                
                {{-- Data Murid --}}
                <a href="{{ route('admin.murid.create') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-indigo-700">Tambah Data Murid</span>
                </a>

                {{-- Data Murid --}}
                <a href="{{ route('admin.dataMurid') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-indigo-700">Data Murid</span>
                </a>
                
                {{-- Data Pengajar --}}
                <a href="{{ route('admin.pengajar.create') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chalkboard-teacher text-white"></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-emerald-700">Tambah Data Pengajar</span>
                </a>
                
                {{-- Data Jadwal --}}
                <a href="{{ route('admin.jadwal.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-yellow-800 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-calendar-days text-white" ></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-emerald-700">Manage Jadwal</span>
                </a>
                
                <a href="{{ route('admin.pengajar.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users-cog text-white"></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-purple-700">Manage Data Pengajar</span>
                </a>
                
                <a href="{{ route('admin.notifikasi.index') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 rounded-xl transition-all duration-300 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-history text-white"></i>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-amber-700">History Data</span>
                </a>
                
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
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">DATA MURID</h2>
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
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">MANAGE DATA MURID</h2>
                                <p class="text-gray-600">Edit, Hapus, Update</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.murid.index') }}">
                            <button class="btn-modern bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl">
                                Lihat <i class="fas fa-arrow-right ml-2"></i>
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
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">MANAGE DATA PENGAJAR</h2>
                                <p class="text-gray-600">Edit, Hapus, Update</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.pengajar.index') }}">
                            <button class="btn-modern bg-gradient-to-r from-pink-500 to-rose-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl">
                                Lihat <i class="fas fa-arrow-right ml-2"></i>
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
                    <p class="text-indigo-100 mt-2">Kelola jadwal kegiatan TPA</p>
                </div>
                
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
                        @csrf
                        @method('DELETE')

                        <div class="overflow-x-auto">
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
                                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($jadwals as $jadwal)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" name="selected_jadwals[]" value="{{ $jadwal->id }}" class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                                            </td>
                                            <td class="px-6 py-4 text-gray-900 font-medium">{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-gray-700">{{ $jadwal->pukul_jadwal }}</td>
                                            <td class="px-6 py-4 text-gray-900 font-medium">{{ $jadwal->nama_jadwal }}</td>
                                            <td class="px-6 py-4 text-gray-700">{{ $jadwal->nama_pengajar_jadwal }}</td>
                                            <td class="px-6 py-4 text-gray-700">{{ $jadwal->kegiatan_jadwal }}</td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-4 sm:space-y-0">
                            <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 btn-modern">
                                <i class="fas fa-cog mr-2"></i>Kelola Jadwal
                            </a>

                            <div class="flex space-x-3">
                                <button type="submit" name="action" value="selected" class="btn-modern bg-gradient-to-r from-red-500 to-rose-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl" onclick="return confirm('Hapus jadwal yang dipilih?')">
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus Terpilih
                                </button>

                                <button type="submit" name="action" value="all" class="btn-modern bg-gradient-to-r from-red-700 to-red-900 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl" onclick="return confirm('Hapus semua jadwal?')">
                                    <i class="fas fa-trash mr-2"></i>Hapus Semua
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Status Messages -->
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

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