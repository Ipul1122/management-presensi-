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

    <!-- components/sidebar.blade.php -->
<style>
    .sidebar {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        transform: translateX(-100%);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 50;
        width: 300px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f8fafc;
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
        transition: background 0.2s ease;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
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
    
    .arrow-toggle {
        position: fixed;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        z-index: 60;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
    .arrow-toggle:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .arrow-toggle.active {
        left: 310px;
    }
    
    .mobile-nav-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        margin-bottom: 0.5rem;
        cursor: pointer;
    }
    
    .mobile-nav-item:hover {
        background: #f3f4f6;
        transform: translateX(4px);
    }
    
    .mobile-nav-item i {
        margin-right: 0.75rem;
        width: 1.25rem;
        text-align: center;
    }

    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        margin-left: 1rem;
        padding-left: 1rem;
        border-left: 2px solid #e5e7eb;
    }

    .submenu.active {
        max-height: 300px;
    }

    .submenu-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .submenu-item:hover {
        background: #f9fafb;
        transform: translateX(2px);
    }

    .submenu-item i {
        margin-right: 0.5rem;
        width: 1rem;
        text-align: center;
        font-size: 0.75rem;
    }

    .dropdown-arrow {
        margin-left: auto;
        transition: transform 0.3s ease;
    }

    .dropdown-arrow.active {
        transform: rotate(90deg);
    }

    .main-nav-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        margin-bottom: 0.5rem;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .main-nav-item:hover {
        background: #f3f4f6;
        transform: translateX(4px);
        text-decoration: none;
        color: inherit;
    }
</style>

<!-- Arrow Toggle Button -->
<button id="arrowToggle" class="arrow-toggle">
    <i class="fas fa-chevron-right" id="arrowIcon"></i>
</button>

<!-- Sidebar Overlay -->
<div id="sidebarOverlay" class="sidebar-overlay"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar bg-white shadow-xl">
    <div class="p-6 pb-8">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Menu Navigasi</h2>
            <p class="text-sm text-gray-500 mt-1">Sistem Presensi TPA</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-2">
            <a href="{{ route('pengajar.dashboard') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fas fa-home text-blue-500"></i>
                <span>Dashboard</span>
            </a>

            <!-- Menu Murid dengan Submenu -->
            <div class="mobile-nav-item text-gray-700 hover:text-blue-600" id="muridMenuToggle">
                <i class="fas fa-users text-green-500"></i>
                <span>Menu Murid</span>
                <i class="fas fa-chevron-right dropdown-arrow" id="muridDropdownArrow"></i>
            </div>
            
            <div class="submenu" id="muridSubmenu">
                <a href="{{ route('pengajar.muridAbsensi.index') }}" class="submenu-item text-gray-600 hover:text-blue-600">
                    <i class="fas fa-clipboard-check text-blue-400"></i>
                    <span>Absen Murid</span>
                </a>
                <a href="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="submenu-item text-gray-600 hover:text-blue-600">
                    <i class="fas fa-history text-indigo-400"></i>
                    <span>Riwayat Absensi</span>
                </a>
                <a href="{{ route('pengajar.infoDataMurid.index') }}" class="submenu-item text-gray-600 hover:text-blue-600">
                    <i class="fas fa-info-circle text-green-400"></i>
                    <span>Info Data Murid</span>
                </a>
            </div>

            <a href="{{ route('pengajar.infoDataPengajar.index') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fas fa-chalkboard-teacher text-yellow-500"></i>
                <span>Info Data Pengajar</span>
            </a>
            
            <a href="{{ route('pengajar.riwayatJadwal.index') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fas fa-calendar-alt text-purple-500"></i>
                <span>Riwayat Jadwal</span>
            </a>
            
            <hr class="my-4 border-gray-200">
            
            <!-- Logout -->
            <form action="{{ route('pengajar.logout') }}" method="POST">
                @csrf
                <button type="submit" class="main-nav-item text-red-600 hover:text-red-700 w-full text-left">
                    <i class="fas fa-sign-out-alt text-red-500"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>

        <!-- Version Info -->
        <div class="mt-8 pt-4 border-t border-gray-200">
            <div class="text-center">
                <p class="text-xs text-gray-400">Versi Web 1.0</p>
                <p class="text-xs text-gray-300 mt-1">© 2024 TPA System</p>
            </div>
        </div>
    </div>
</aside>

    {{-- Konten utama halaman --}}
    <main class="">
        @yield('sidebar-pengajar')
    </main>

<script>
// Sidebar functionality
document.addEventListener('DOMContentLoaded', function() {
    const arrowToggle = document.getElementById('arrowToggle');
    const arrowIcon = document.getElementById('arrowIcon');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const muridMenuToggle = document.getElementById('muridMenuToggle');
    const muridSubmenu = document.getElementById('muridSubmenu');
    const muridDropdownArrow = document.getElementById('muridDropdownArrow');

    function openSidebar() {
        sidebar.classList.add('active');
        sidebarOverlay.classList.add('active');
        arrowToggle.classList.add('active');
        arrowIcon.className = 'fas fa-chevron-left';
        document.body.style.overflow = 'hidden';
    }

    function closeSidebarFunc() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        arrowToggle.classList.remove('active');
        arrowIcon.className = 'fas fa-chevron-right';
        document.body.style.overflow = '';
    }

    function toggleMuridSubmenu() {
        muridSubmenu.classList.toggle('active');
        muridDropdownArrow.classList.toggle('active');
    }

    // Event listeners
    arrowToggle?.addEventListener('click', function() {
        if (sidebar.classList.contains('active')) {
            closeSidebarFunc();
        } else {
            openSidebar();
        }
    });

    sidebarOverlay?.addEventListener('click', closeSidebarFunc);

    // Murid submenu toggle
    muridMenuToggle?.addEventListener('click', function(e) {
        e.preventDefault();
        toggleMuridSubmenu();
    });

    // Close sidebar when clicking on navigation links (except submenu toggle)
    const navLinks = sidebar.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Don't close if it's a submenu item and sidebar should stay open
            if (!this.classList.contains('submenu-item')) {
                closeSidebarFunc();
            }
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            closeSidebarFunc();
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            // Optional: Auto-close sidebar on larger screens
            // closeSidebarFunc();
        }
    });
});
</script>

    @stack('scripts')
</body>
</html>