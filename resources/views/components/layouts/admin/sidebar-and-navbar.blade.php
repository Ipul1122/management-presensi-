<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Responsive Styles --}}
    <style>
        .sidebar {
            transition: all 0.3s ease-in-out;
            backdrop-filter: blur(10px);
        }
        
        /* Desktop: Hidden by default, can be toggled */
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 50;
                width: 288px; /* w-72 = 288px */
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                transition: margin-left 0.3s ease-in-out;
                margin-left: 0;
                width: 100%;
            }
            .main-content.sidebar-open {
                margin-left: 288px;
                width: calc(100% - 288px);
            }
        }
        
        /* Mobile and Tablet: Overlay behavior */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 50;
                width: 288px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }
        
        /* Arrow toggle button styles */
        .arrow-toggle {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 45;
            width: 40px;
            height: 80px;
            background: linear-gradient(135deg, #93c5fd 0%, #38bdf8 100%);
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-left: none;
            cursor: pointer;
        }
        
        .arrow-toggle:hover {
            width: 45px;
            box-shadow: 6px 0 25px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        }
        
        .arrow-toggle i {
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .arrow-toggle:hover i {
            transform: scale(1.1);
        }
        
        /* When sidebar is open, move the toggle */
        .arrow-toggle.sidebar-open {
            left: 288px;
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        }
        
        .arrow-toggle.sidebar-open:hover {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        }
        
        /* Responsive content padding */
        .content-wrapper {
            padding: 80px 1rem 2rem 1rem;
        }
        
        @media (min-width: 640px) {
            .content-wrapper {
                padding: 80px 2rem 2rem 2rem;
            }
        }
        
        @media (min-width: 1024px) {
            .content-wrapper {
                padding: 2rem;
            }
        }
        
        /* Custom gradient backgrounds */
        .gradient-blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-green { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .gradient-purple { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }
        .gradient-pink { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
        
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
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 10px; }
        
        /* Dropdown styles */
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
        }
        .dropdown-menu.active {
            max-height: 300px;
            opacity: 1;
        }
        .dropdown-toggle .dropdown-arrow {
            transition: transform 0.3s ease;
        }
        .dropdown-toggle.active .dropdown-arrow {
            transform: rotate(180deg);
        }
        
        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        @media (min-width: 1024px) {
            .sidebar-overlay {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
        
        <!-- Sidebar Overlay for Mobile -->
        <div id="sidebarOverlay" class="sidebar-overlay"></div>
        
        <!-- Arrow Toggle Button -->
        <button id="arrowToggle" class="arrow-toggle" title="Buka Menu">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="flex flex-1">
            <!-- Modern Sidebar -->
            <aside class="sidebar w-72 bg-white/90 backdrop-blur-md shadow-2xl border-r border-white/20 custom-scrollbar overflow-y-auto">
                <div class="p-6 space-y-2">
                    <div class="flex justify-between items-center mb-6">
                        <span class="font-bold text-gray-800 ml-4">Menu Navigasi</span>
                        <button id="closeSidebar" class="text-gray-600 hover:text-gray-800 p-2 hover:bg-gray-100 rounded-lg transition-all duration-200 lg:hidden">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- DASHBOARD SECTION -->
                    <div class="mb-6">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-tachometer-alt text-white"></i>
                            </div>
                            <span class="font-medium text-gray-700 group-hover:text-indigo-700">Dashboard</span>
                        </a>
                    </div>
                    
                    <!-- MENU MURID SECTION -->
                    <div class="mb-6">
                        <button class="dropdown-toggle w-full flex items-center justify-between p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group" data-dropdown="murid">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-user-graduate text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-indigo-700">Data Murid</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-gray-400 group-hover:text-indigo-600"></i>
                        </button>
                        
                        <div class="dropdown-menu pl-4 mt-2 space-y-1" id="dropdown-murid">
                            <a href="{{ route('admin.murid.create') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-user-plus text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">Tambah Data Murid</span>
                            </a>
                            
                            <a href="{{ route('admin.dataMurid') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fa-solid fa-chart-simple text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">Statistik Murid</span>
                            </a>
                            
                            <a href="{{ route('admin.murid.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-folder-open text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">Manage Data Murid</span>
                            </a>

                            <a href="{{ route('admin.riwayatMurid.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-folder-open text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">Riwayat Murid</span>
                            </a>
                        </div>
                    </div>

                    <!-- MENU PENGAJAR SECTION -->
                    <div class="mb-6">
                        <button class="dropdown-toggle w-full flex items-center justify-between p-4 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 rounded-xl transition-all duration-300 group" data-dropdown="pengajar">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-chalkboard-teacher text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-blue-700">Data Pengajar</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-gray-400 group-hover:text-blue-600"></i>
                        </button>
                        
                        <div class="dropdown-menu pl-4 mt-2 space-y-1" id="dropdown-pengajar">
                            <a href="{{ route('admin.pengajar.create') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md flex items-center justify-center">
                                    <i class="fas fa-chalkboard-teacher text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-blue-700">Tambah Data Pengajar</span>
                            </a>
                            
                            <a href="{{ route('admin.pengajar.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-teal-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md flex items-center justify-center">
                                    <i class="fas fa-users-cog text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-blue-700">Manage Data Pengajar</span>
                            </a>
                        </div>
                    </div>

                    <!-- MENU JADWAL SECTION -->
                    <div class="mb-6">
                        <button class="dropdown-toggle w-full flex items-center justify-between p-4 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-orange-50 rounded-xl transition-all duration-300 group" data-dropdown="jadwal">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fa-solid fa-calendar-days text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-blue-700">Jadwal</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-gray-400 group-hover:text-blue-600"></i>
                        </button>
                        
                        <div class="dropdown-menu pl-4 mt-2 space-y-1" id="dropdown-jadwal">
                            <a href="{{ route('admin.jadwal.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-orange-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-days text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-blye-700">Manage Jadwal</span>
                            </a>
                            
                            <a href="{{ route('admin.riwayatJadwal.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-blye-50 hover:to-orange-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md flex items-center justify-center">
                                    <i class="fa-solid fa-history text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-blye-700">Riwayat Jadwal</span>
                            </a>
                        </div>
                    </div>

                    <!-- MENU LAINNYA SECTION -->
                    <div class="mb-6">
                        <button class="dropdown-toggle w-full flex items-center justify-between p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 group" data-dropdown="lainnya">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-ellipsis-h text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-indigo-700">Menu Lainnya</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-gray-400 group-hover:text-indigo-600"></i>
                        </button>
                        
                        <div class="dropdown-menu pl-4 mt-2 space-y-1" id="dropdown-lainnya">
                            <a href="{{ route('admin.notifikasi.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-bell text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">Notifikasi</span>
                            </a>
                            
                            <a href="{{ route('admin.testimoniUser.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-comments text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">Testimoni User</span>
                            </a>
                            
                            <a href="https://docs.google.com/spreadsheets/d/1ltY_KB9K1NTsIKE5RmwIGYe-gofJ_sN8YVHH1JEj5zc/edit?usp=sharing" target="_blank" class="flex items-center space-x-3 p-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-lg transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-table text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600 group-hover:text-indigo-700">SpreadSheets</span>
                            </a>
                        </div>
                    </div>
                    
                    {{-- LOGOUT SECTION --}}
                    <div class="pt-4 border-t border-gray-200 mt-6">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button class="flex items-center space-x-3 p-4 w-full hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 rounded-xl transition-all duration-300 group">
                                <div class="w-10 h-10 bg-gradient-to-r from-red-400 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
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


            {{-- Main Content --}}
            <main class="main-content flex-1">
                <div class="">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const arrowToggle = document.getElementById('arrowToggle');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const arrowIcon = arrowToggle.querySelector('i');

            // Toggle sidebar function
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                arrowToggle.classList.toggle('sidebar-open');
                sidebarOverlay.classList.toggle('active');
                
                // Change arrow icon and tooltip
                if (sidebar.classList.contains('active')) {
                    arrowIcon.className = 'fas fa-chevron-left';
                    arrowToggle.title = 'Tutup Menu';
                } else {
                    arrowIcon.className = 'fas fa-chevron-right';
                    arrowToggle.title = 'Buka Menu';
                }
                
                // Only adjust main content margin on desktop
                if (window.innerWidth >= 1024) {
                    mainContent.classList.toggle('sidebar-open');
                }
            }

            // Event listeners
            arrowToggle.addEventListener('click', toggleSidebar);
            closeSidebar.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Dropdown functionality
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownId = this.getAttribute('data-dropdown');
                    const dropdownMenu = document.getElementById('dropdown-' + dropdownId);
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.classList.remove('active');
                        }
                    });
                    document.querySelectorAll('.dropdown-toggle').forEach(otherToggle => {
                        if (otherToggle !== this) {
                            otherToggle.classList.remove('active');
                        }
                    });
                    
                    // Toggle current dropdown
                    dropdownMenu.classList.toggle('active');
                    this.classList.toggle('active');
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth < 1024) {
                    mainContent.classList.remove('sidebar-open');
                } else {
                    sidebarOverlay.classList.remove('active');
                    if (sidebar.classList.contains('active')) {
                        mainContent.classList.add('sidebar-open');
                    }
                }
            });

            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });
        });
    </script>
</body>
</html>