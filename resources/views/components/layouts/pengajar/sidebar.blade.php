<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 text-gray-800 min-h-screen">

    <!-- components/sidebar.blade.php -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    * {
        font-family: 'Inter', sans-serif;
    }

    .sidebar {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(20px);
        transform: translateX(-100%);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 50;
        width: 320px;
        overflow-y: auto;
        scrollbar-width: none;
        background: linear-gradient(145deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.95) 100%);
        border-right: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .sidebar::-webkit-scrollbar {
        display: none;
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
        background: rgba(0, 0, 0, 0.6);
        z-index: 40;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        backdrop-filter: blur(5px);
    }
    
    .sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .arrow-toggle {
        position: fixed;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        z-index: 60;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        width: 40px;
        height: 80px;
        border-radius: 0 20px 20px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 2px 0 15px rgba(102, 126, 234, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        border-left: none;
    }
    
    .arrow-toggle::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .arrow-toggle:hover {
        transform: translateY(-50%) translateX(5px);
        box-shadow: 5px 0 25px rgba(102, 126, 234, 0.4);
        width: 45px;
    }
    
    .arrow-toggle:hover::before {
        opacity: 1;
    }

    .arrow-toggle.active {
        left: 320px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: -2px 0 15px rgba(240, 147, 251, 0.3);
        border-radius: 20px 0 0 20px;
    }
    
    .arrow-toggle.active:hover {
        transform: translateY(-50%) translateX(-5px);
        box-shadow: -5px 0 25px rgba(240, 147, 251, 0.4);
        width: 45px;
    }

    .sidebar-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .sidebar-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .sidebar-header h2 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .sidebar-header p {
        font-size: 0.875rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }
    
    .mobile-nav-item {
        display: flex;
        align-items: center;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0.5rem 0.75rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        background: transparent;
        border: 1px solid transparent;
    }
    
    .mobile-nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .mobile-nav-item:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        transform: translateX(8px);
        border-color: rgba(102, 126, 234, 0.2);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .mobile-nav-item:hover::before {
        left: 100%;
    }
    
    .mobile-nav-item i {
        margin-right: 1rem;
        width: 1.5rem;
        text-align: center;
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .mobile-nav-item:hover i {
        transform: scale(1.1);
    }

    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0 0.75rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        border: 1px solid rgba(226, 232, 240, 0.5);
    }

    .submenu.active {
        max-height: 400px;
        padding: 0.5rem 0;
        margin-bottom: 0.5rem;
    }

    .submenu-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin: 0.25rem 0.5rem;
        font-size: 0.875rem;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
    }

    .submenu-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .submenu-item:hover {
        background: white;
        transform: translateX(6px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        color: #667eea;
    }

    .submenu-item:hover::before {
        transform: scaleY(1);
    }

    .submenu-item i {
        margin-right: 0.75rem;
        width: 1.25rem;
        text-align: center;
        font-size: 0.875rem;
        transition: color 0.3s ease;
    }

    .dropdown-arrow {
        margin-left: auto;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        font-size: 0.875rem;
    }

    .dropdown-arrow.active {
        transform: rotate(90deg);
        color: #667eea;
    }

    .main-nav-item {
        display: flex;
        align-items: center;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0.5rem 0.75rem;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        position: relative;
        overflow: hidden;
        background: transparent;
        border: 1px solid transparent;
    }

    .main-nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .main-nav-item:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        transform: translateX(8px);
        text-decoration: none;
        color: inherit;
        border-color: rgba(102, 126, 234, 0.2);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .main-nav-item:hover::before {
        left: 100%;
    }

    .main-nav-item i {
        margin-right: 1rem;
        width: 1.5rem;
        text-align: center;
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .main-nav-item:hover i {
        transform: scale(1.1);
    }

    .logout-btn {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #dc2626;
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        color: #b91c1c;
        border-color: rgba(239, 68, 68, 0.3);
    }

    .version-info {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 12px;
        padding: 1rem;
        margin: 1rem 0.75rem 0;
        border: 1px solid rgba(226, 232, 240, 0.5);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .version-info::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
        background-size: 200% 100%;
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .nav-divider {
        margin: 1rem 0.75rem;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(226, 232, 240, 0.8), transparent);
        border: none;
    }

    /* Pulse animation for active states */
    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }

    /* Micro-interactions */
    .nav-text {
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .mobile-nav-item:hover .nav-text,
    .main-nav-item:hover .nav-text {
        font-weight: 600;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .sidebar {
            width: 300px;
        }
        
        .arrow-toggle.active {
            left: 300px;
        }
    }
</style>

<!-- Arrow Toggle Button -->
<button id="arrowToggle" class="arrow-toggle">
    <i class="fas fa-chevron-right" id="arrowIcon"></i>
</button>

<!-- Sidebar Overlay -->
<div id="sidebarOverlay" class="sidebar-overlay"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h2>Menu Navigasi</h2>
        <p>Sistem Presensi TPA</p>
    </div>

    <div class="p-4">
        <!-- Navigation Menu -->
        <nav class="space-y-1">
            <a href="{{ route('pengajar.dashboard') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fas fa-home text-blue-500"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <!-- Menu Murid dengan Submenu -->
            <div class="mobile-nav-item text-gray-700 hover:text-blue-600" id="muridMenuToggle">
                <i class="fas fa-users text-green-500"></i>
                <span class="nav-text">Menu Murid</span>
                <i class="fas fa-chevron-right dropdown-arrow" id="muridDropdownArrow"></i>
            </div>
            
            <div class="submenu" id="muridSubmenu">
                <a href="{{ route('pengajar.muridAbsensi.index') }}" class="submenu-item text-gray-600 hover:text-blue-600">
                    <i class="fas fa-clipboard-check text-blue-400"></i>
                    <span class="nav-text">Absen Murid</span>
                </a>
                <a href="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="submenu-item text-gray-600 hover:text-blue-600">
                    <i class="fas fa-history text-indigo-400"></i>
                    <span class="nav-text">Riwayat Absensi</span>
                </a>
                <a href="{{ route('pengajar.infoDataMurid.index') }}" class="submenu-item text-gray-600 hover:text-blue-600">
                    <i class="fas fa-info-circle text-green-400"></i>
                    <span class="nav-text">Info Data Murid</span>
                </a>
            </div>

            <a href="{{ route('pengajar.infoDataPengajar.index') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fas fa-chalkboard-teacher text-yellow-500"></i>
                <span class="nav-text">Info Data Pengajar</span>
            </a>
            
            <a href="{{ route('pengajar.riwayatJadwal.index') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fas fa-calendar-alt text-purple-500"></i>
                <span class="nav-text">Riwayat Jadwal</span>
            </a>
            
            <a href="{{ route('pengajar.panduanPengajar.index') }}" class="main-nav-item text-gray-700 hover:text-blue-600">
                <i class="fa-solid fa-book text-purple-500"></i>
                <span class="nav-text">Panduan Pengajar</span>
            </a>

            <hr class="nav-divider">
            
            <!-- Logout -->
            <form action="{{ route('pengajar.logout') }}" method="POST">
                @csrf
                <button type="submit" class="main-nav-item logout-btn w-full text-left">
                    <i class="fas fa-sign-out-alt text-red-500"></i>
                    <span class="nav-text">Logout</span>
                </button>
            </form>
        </nav>

        <!-- Version Info -->
        <div class="version-info">
            <p class="text-xs text-gray-500 font-medium">Versi Web 1.0</p>
            <p class="text-xs text-gray-400 mt-1">© 2024 TPA System</p>
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
        arrowToggle.classList.add('pulse-animation');
        arrowIcon.className = 'fas fa-chevron-left';
        document.body.style.overflow = 'hidden';
    }

    function closeSidebarFunc() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        arrowToggle.classList.remove('active');
        arrowToggle.classList.remove('pulse-animation');
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

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
});
</script>
<script ></script>

    @stack('scripts')
</body>
</html>