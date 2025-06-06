<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
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
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button id="hamburger" class="lg:hidden text-gray-600 hover:text-gray-800">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <img src="/logo.png" alt="Logo" class="h-10">
                    <span class="text-xl font-bold">TPA Nurul Haq</span>
                </div>
                <div class="flex space-x-4 text-xl md:hidden">
                    <button title="Input Absen" class="text-blue-600 hover:text-blue-800"><i class="fas fa-calendar-check"></i></button>
                    <button title="Profil Pengajar" class="text-green-600 hover:text-green-800"><i class="fas fa-users"></i></button>
                    <form action="{{ route('pengajar.logout') }}" method="POST">
                        @csrf
                        <button title="Logout" class="text-red-600 hover:text-red-800"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
            </div>
            
            <!-- Search Bar - Now visible on all screens -->
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <input type="text" placeholder="Cari apa yang anda mau" class="w-full p-2 pl-10 rounded border border-gray-300">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Desktop Navigation Icons -->
            <div class="hidden md:flex space-x-4 text-xl">
                <button title="Input Absen" class="text-blue-600 hover:text-blue-800"><i class="fas fa-calendar-check"></i></button>
                <button title="Profil Pengajar" class="text-green-600 hover:text-green-800"><i class="fas fa-users"></i></button>
                <form action="{{ route('pengajar.logout') }}" method="POST">
                    @csrf
                    <button title="Logout" class="text-red-600 hover:text-red-800"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="sidebar w-60 bg-white p-4 shadow-lg space-y-4">
            <div class="flex justify-between items-center lg:hidden">
                <span class="font-bold">Menu</span>
                <button id="closeSidebar" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <a href="#" class="block p-2 hover:bg-gray-200 rounded">Absen Murid</a>
            <a href="#" class="block p-2 hover:bg-gray-200 rounded">Info Data Murid</a>
            <a href="#" class="block p-2 hover:bg-gray-200 rounded">Info Data Pengajar</a>
            <a href="#" class="block p-2 hover:bg-gray-200 rounded">Edit Info Pengajar</a>
            <form action="{{ route('pengajar.logout') }}" method="POST">
                @csrf
                <button title="Logout" class="block p-2 hover:bg-gray-200 rounded text-red-500">Logout</button>
            </form>
            <p class="text-sm text-gray-400">Versi Web 1.0</p>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-6">
            <!-- Section 1 -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-clipboard-list text-3xl text-blue-500"></i>
                            <span class="text-lg font-semibold">Absensi Murid</span>
                        </div>
                        <a href="{{ route('pengajar.muridAbsensi.index') }}" class="text-sm text-blue-600 hover:underline">
                            <button class="text-sm text-blue-600 hover:underline">Lihat</button>
                        </a>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-users text-3xl text-green-500"></i>
                            <span class="text-lg font-semibold">Info Data Murid</span>
                        </div>
                        <button class="text-sm text-green-600 hover:underline">Lihat</button>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-edit text-3xl text-yellow-500"></i>
                            <span class="text-lg font-semibold">Edit Info Pengajar</span>
                        </div>
                        <button class="text-sm text-yellow-600 hover:underline">Lihat</button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow flex flex-col items-center">
                    <div class="flex items-center justify-between w-full">
                        <button class="text-gray-500 hover:text-gray-800"><i class="fas fa-chevron-left"></i></button>
                        <div class="text-center">
                            <img src="{{ asset('images/images.jpg') }}" alt="Pengajar" class="h-24 w-24 rounded-full mx-auto mb-2">
                            <h3 class="text-lg font-bold">Nama Pengajar</h3>
                            <p class="text-sm text-gray-600">Deskripsi Pengajar</p>
                        </div>
                        <button class="text-gray-500 hover:text-gray-800"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Kalender Kegiatan</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                    <div class="bg-blue-100 p-4 rounded text-center">Senin</div>
                    <div class="bg-blue-100 p-4 rounded text-center">Selasa</div>
                    <div class="bg-blue-100 p-4 rounded text-center">Rabu</div>
                    <div class="bg-blue-100 p-4 rounded text-center">Kamis</div>
                    <div class="bg-blue-100 p-4 rounded text-center">Jumat</div>
                </div>
            </div>
        </main>
    </div>

    <script>
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
    </script>
</body>
</html> 
