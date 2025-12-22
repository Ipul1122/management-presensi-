<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Base Sidebar Transitions */
        .sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(12px);
        }
        
        /* Desktop: Fixed & Toggleable */
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 50;
                width: 280px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                margin-left: 0;
                width: 100%;
            }
            .main-content.sidebar-open {
                margin-left: 280px;
                width: calc(100% - 280px);
            }
        }
        
        /* Mobile: Off-canvas */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 50;
                width: 280px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }
        
        /* Toggle Button */
        .arrow-toggle {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 45;
            width: 32px;
            height: 64px;
            background: #4f46e5; /* Indigo-600 */
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 4px 0 15px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-left: none;
        }
        
        .arrow-toggle:hover {
            width: 40px;
            background: #4338ca; /* Indigo-700 */
        }
        
        .arrow-toggle i {
            color: white;
            font-size: 14px;
        }
        
        .arrow-toggle.sidebar-open {
            left: 280px;
            background: #ef4444; /* Red-500 */
            box-shadow: 4px 0 15px rgba(239, 68, 68, 0.3);
        }

        .arrow-toggle.sidebar-open:hover {
            background: #dc2626; /* Red-600 */
        }
        
        /* Dropdown Animation */
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out, opacity 0.3s ease;
            opacity: 0;
        }
        .dropdown-menu.active {
            max-height: 500px; /* Cukup besar untuk menampung submenu */
            opacity: 1;
        }
        .dropdown-arrow {
            transition: transform 0.3s ease;
        }
        .dropdown-toggle.active .dropdown-arrow {
            transform: rotate(180deg);
        }
        
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 20px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Mobile Overlay */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6); /* Slate-900 with opacity */
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">
    
    <div class="min-h-screen flex">
        
        <div id="sidebarOverlay" class="sidebar-overlay lg:hidden"></div>
        
        <button id="arrowToggle" class="arrow-toggle group" title="Buka Menu">
            <i class="fas fa-chevron-right group-hover:scale-110 transition-transform"></i>
        </button>

        <aside class="sidebar bg-white border-r border-slate-200 shadow-xl flex flex-col custom-scrollbar">
            
            <div class="h-20 flex items-center px-6 border-b border-slate-100 bg-gradient-to-r from-indigo-600 to-indigo-700">
                <div class="flex items-center space-x-3 text-white">
                    {{-- <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner">
                        <i class="fas fa-school text-xl"></i>
                    </div> --}}
                    <div>
                        <h1 class="font-bold text-lg leading-tight">Sistem Presensi</h1>
                        <p class="text-xs text-indigo-100 opacity-80">Administrator Panel</p>
                    </div>
                </div>
                <button id="closeSidebar" class="lg:hidden ml-auto text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                    <i class="fas fa-tachometer-alt w-6 text-center {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Manajemen</p>
                </div>

                {{-- Menu Murid --}}
                @php
                    $isMuridActive = request()->routeIs('admin.murid.*') || request()->routeIs('admin.dataMurid') || request()->routeIs('admin.riwayatMurid.*') || request()->routeIs('admin.sikapMurid.*') || request()->routeIs('admin.mataPelajaran.*') || request()->routeIs('admin.poinMuridTpa.*');
                @endphp
                <div class="relative">
                    <button class="dropdown-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ $isMuridActive ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}" data-dropdown="murid">
                        <div class="flex items-center">
                            <i class="fas fa-user-graduate w-6 text-center {{ $isMuridActive ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                            <span class="ml-3">Data Murid</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 dropdown-arrow {{ $isMuridActive ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    </button>
                    
                    <div id="dropdown-murid" class="dropdown-menu {{ $isMuridActive ? 'active' : '' }}">
                        <div class="bg-slate-50 rounded-lg mt-1 mx-2 py-2 space-y-1 border border-slate-100">
                            <a href="{{ route('admin.murid.create') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.murid.create') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-plus w-5 text-center text-xs opacity-70"></i>
                                <span>Tambah Murid</span>
                            </a>
                            <a href="{{ route('admin.murid.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.murid.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-list w-5 text-center text-xs opacity-70"></i>
                                <span>Daftar Murid</span>
                            </a>
                            <a href="{{ route('admin.dataMurid') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.dataMurid') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-chart-pie w-5 text-center text-xs opacity-70"></i>
                                <span>Statistik</span>
                            </a>
                            <a href="{{ route('admin.riwayatMurid.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.riwayatMurid.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-history w-5 text-center text-xs opacity-70"></i>
                                <span>Riwayat Absensi</span>
                            </a>
                            <div class="border-t border-slate-200 my-1 mx-4"></div>
                             <a href="{{ route('admin.sikapMurid.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.sikapMurid.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-smile w-5 text-center text-xs opacity-70"></i>
                                <span>Poin Sikap</span>
                            </a>
                            <a href="{{ route('admin.mataPelajaran.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.mataPelajaran.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-book w-5 text-center text-xs opacity-70"></i>
                                <span>Mata Pelajaran</span>
                            </a>
                            <a href="{{ route('admin.poinMuridTpa.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.mataPelajaran.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-star w-5 text-center text-xs opacity-70"></i>
                                <span>Absensi Poin</span>
                            </a>
                            {{-- Total Poin --}}
                            <a href="{{ route('admin.semuaPoinMuridTpa.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.poinMuridTpa.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-star w-5 text-center text-xs opacity-70"></i>
                                <span>Total Poin</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Menu Pengajar --}}
                @php
                    $isPengajarActive = request()->routeIs('admin.pengajar.*');
                @endphp
                <div class="relative">
                    <button class="dropdown-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ $isPengajarActive ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}" data-dropdown="pengajar">
                        <div class="flex items-center">
                            <i class="fas fa-chalkboard-teacher w-6 text-center {{ $isPengajarActive ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                            <span class="ml-3">Data Pengajar</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 dropdown-arrow {{ $isPengajarActive ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    </button>
                    
                    <div id="dropdown-pengajar" class="dropdown-menu {{ $isPengajarActive ? 'active' : '' }}">
                        <div class="bg-slate-50 rounded-lg mt-1 mx-2 py-2 space-y-1 border border-slate-100">
                            <a href="{{ route('admin.pengajar.create') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.pengajar.create') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-plus w-5 text-center text-xs opacity-70"></i>
                                <span>Tambah Pengajar</span>
                            </a>
                            <a href="{{ route('admin.pengajar.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.pengajar.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-users w-5 text-center text-xs opacity-70"></i>
                                <span>Daftar Pengajar</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Menu Jadwal --}}
                @php
                    $isJadwalActive = request()->routeIs('admin.jadwal.*') || request()->routeIs('admin.riwayatJadwal.*');
                @endphp
                <div class="relative">
                    <button class="dropdown-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ $isJadwalActive ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}" data-dropdown="jadwal">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt w-6 text-center {{ $isJadwalActive ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                            <span class="ml-3">Jadwal Pelajaran</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 dropdown-arrow {{ $isJadwalActive ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    </button>
                    
                    <div id="dropdown-jadwal" class="dropdown-menu {{ $isJadwalActive ? 'active' : '' }}">
                        <div class="bg-slate-50 rounded-lg mt-1 mx-2 py-2 space-y-1 border border-slate-100">
                            <a href="{{ route('admin.jadwal.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.jadwal.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-calendar-check w-5 text-center text-xs opacity-70"></i>
                                <span>Kelola Jadwal</span>
                            </a>
                            <a href="{{ route('admin.riwayatJadwal.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.riwayatJadwal.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-clock w-5 text-center text-xs opacity-70"></i>
                                <span>Riwayat Jadwal</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Menu Lainnya --}}
                @php
                    $isLainnyaActive = request()->routeIs('admin.notifikasi.*') || request()->routeIs('admin.testimoniUser.*') || request()->routeIs('admin.daftarMurid.*');
                @endphp
                <div class="relative">
                    <button class="dropdown-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ $isLainnyaActive ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}" data-dropdown="lainnya">
                        <div class="flex items-center">
                            <i class="fas fa-layer-group w-6 text-center {{ $isLainnyaActive ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                            <span class="ml-3">Lainnya</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 dropdown-arrow {{ $isLainnyaActive ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    </button>
                    
                    <div id="dropdown-lainnya" class="dropdown-menu {{ $isLainnyaActive ? 'active' : '' }}">
                        <div class="bg-slate-50 rounded-lg mt-1 mx-2 py-2 space-y-1 border border-slate-100">
                            <a href="{{ route('admin.notifikasi.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.notifikasi.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-bell w-5 text-center text-xs opacity-70"></i>
                                <span>Notifikasi</span>
                            </a>
                            <a href="{{ route('admin.testimoniUser.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.testimoniUser.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-comment-alt w-5 text-center text-xs opacity-70"></i>
                                <span>Testimoni User</span>
                            </a>
                            <a href="{{ route('admin.daftarMurid.index') }}" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('admin.daftarMurid.index') ? 'text-indigo-600 font-medium bg-white shadow-sm mx-2' : 'text-slate-500 hover:text-indigo-600 hover:bg-white/50 mx-2' }}">
                                <i class="fas fa-clipboard-list w-5 text-center text-xs opacity-70"></i>
                                <span>Pendaftaran Baru</span>
                            </a>
                             <a href="https://docs.google.com/spreadsheets/d/1ltY_KB9K1NTsIKE5RmwIGYe-gofJ_sN8YVHH1JEj5zc/edit?usp=sharing" target="_blank" class="flex items-center px-4 py-2 text-sm rounded-md transition-colors text-slate-500 hover:text-green-600 hover:bg-white/50 mx-2">
                                <i class="fas fa-file-excel w-5 text-center text-xs opacity-70"></i>
                                <span>SpreadSheets</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="p-4 border-t border-slate-200 bg-slate-50">
                <div class="flex items-center p-3 bg-white rounded-xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="ml-3 overflow-hidden">
                        <p class="text-sm font-medium text-slate-700 truncate">Admin</p>
                        <p class="text-xs text-slate-500 truncate">Administrator</p>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="ml-auto">
                        @csrf
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
                <div class="text-center mt-3">
                    <span class="text-[10px] text-slate-400">Versi Sistem 2.0</span>
                </div>
            </div>

        </aside>

        <main class="main-content flex-1 min-h-screen">
            <div class="w-full">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const arrowToggle = document.getElementById('arrowToggle');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const arrowIcon = arrowToggle.querySelector('i');

            // Set state awal jika di desktop (sesuai kebutuhan user, default tertutup)
            // Jika ingin default terbuka di desktop, hapus transform pada CSS @media desktop
            
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                arrowToggle.classList.toggle('sidebar-open');
                sidebarOverlay.classList.toggle('active');
                
                // Icon rotation logic
                if (sidebar.classList.contains('active')) {
                    arrowIcon.classList.remove('fa-chevron-right');
                    arrowIcon.classList.add('fa-chevron-left');
                } else {
                    arrowIcon.classList.remove('fa-chevron-left');
                    arrowIcon.classList.add('fa-chevron-right');
                }

                // Adjust Content Margin on Desktop
                if (window.innerWidth >= 1024) {
                    mainContent.classList.toggle('sidebar-open');
                }
            }

            arrowToggle.addEventListener('click', toggleSidebar);
            if(closeSidebar) closeSidebar.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Dropdown Logic
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const menuId = this.getAttribute('data-dropdown');
                    const menu = document.getElementById('dropdown-' + menuId);
                    
                    // Close other menus (Accordian style) - Optional, remove if you want multiple open
                    /*
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if(m !== menu) m.classList.remove('active');
                    });
                    document.querySelectorAll('.dropdown-toggle').forEach(t => {
                        if(t !== this) t.classList.remove('active'); // Reset arrow
                    });
                    */

                    this.classList.toggle('active'); // Rotate arrow
                    menu.classList.toggle('active');
                });
            });

            // Ensure active dropdowns have their arrow rotated on load
            document.querySelectorAll('.dropdown-menu.active').forEach(menu => {
                const id = menu.id.replace('dropdown-', '');
                const toggle = document.querySelector(`.dropdown-toggle[data-dropdown="${id}"]`);
                if(toggle) toggle.classList.add('active');
            });

            // Responsive Handler
            window.addEventListener('resize', () => {
                if (window.innerWidth < 1024) {
                    mainContent.classList.remove('sidebar-open');
                } else {
                    sidebarOverlay.classList.remove('active');
                    if (sidebar.classList.contains('active')) {
                        mainContent.classList.add('sidebar-open');
                    }
                }
            });
        });
    </script>
</body>
</html>