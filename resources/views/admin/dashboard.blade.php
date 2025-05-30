<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
                    <button title="Tambah Data" class="text-blue-600 hover:text-blue-800"><i class="fas fa-plus-circle"></i></button>
                    <a href="{{ route('admin.notifikasi.index') }}" class="relative" title="Notifikasi">
                        <i class="fas fa-bell text-green-600 hover:text-green-800"></i>
                        @if ($unreadCount > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
                                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                            </span>
                        @endif
                    </a>
                    
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button title="Logout" class="text-red-600 hover:text-red-800"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
            </div>
            
            {{-- <!-- Search Bar -->
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <input type="text" placeholder="Cari apa yang anda mau" class="w-full p-2 pl-10 rounded border border-gray-300">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div> --}}

            <!-- Desktop Navigation Icons -->
            <div class="hidden md:flex space-x-4 text-xl">
                <button title="Tambah Data" class="text-blue-600 hover:text-blue-800"><i class="fas fa-plus-circle"></i></button>
                <a href="{{ route('admin.notifikasi.index') }}" class="relative" title="Notifikasi">
                    <i class="fas fa-bell text-green-600 hover:text-green-800"></i>
                    @if ($unreadCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </a>
                

                <form action="{{ route('admin.logout') }}" method="POST">
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
            <a href="{{ route('admin.murid.create') }}" class="block p-2 hover:bg-gray-200 rounded">Tambah Data Murid</a>
            <a href="{{ route('admin.pengajar.create') }}" class="block p-2 hover:bg-gray-200 rounded">Tambah Data Pengajar</a>
            {{-- <a href="{{ route('admin.jadwal.index') }}" class="block p-2 hover:bg-gray-200 rounded">Manage Jadwal</a> --}}
            <a href="{{ route('admin.pengajar.index') }}" class="block p-2 hover:bg-gray-200 rounded">Manage Data Pengajar</a>
            <a href="{{ route('admin.notifikasi.index') }}" class="block p-2 hover:bg-gray-200 rounded">History Data</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="block w-full text-left p-2 hover:bg-gray-200 rounded text-red-500">Logout</button>
            </form>
            <p class="text-sm text-gray-400">Versi Web 1.0</p>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-6">
            <!-- Data Summary -->
            <!-- Data Summary -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
    <!-- Data Murid -->
    <div class="bg-white p-6 rounded shadow flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <i class="fas fa-address-book text-3xl text-blue-500"></i>
            <div>
                <h2 class="text-xl font-bold">DATA MURID</h2>
                <p class="text-gray-600">Jumlah {{ $jumlahMurid }}</p>
            </div>
        </div>
    </div>    

    <!-- Data Pengajar -->
    <div class="bg-white p-6 rounded shadow flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <i class="fas fa-chalkboard-teacher text-3xl text-green-500"></i>
            <div>
                <h2 class="text-xl font-bold">DATA PENGAJAR</h2>
                <p class="text-gray-600">Jumlah {{ $jumlahPengajar }}</p>
            </div>
        </div>
    </div>

    <!-- Manage Data Murid -->
    <div class="bg-white p-6 rounded shadow flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <i class="fas fa-folder-open text-3xl text-indigo-500"></i>
            <div>
                <h2 class="text-xl font-bold">MANAGE DATA MURID</h2>
                <p class="text-gray-600">Edit, Hapus, Update</p>
            </div>
        </div>
        <a href="{{ route('admin.murid.index') }}">
            <button class="text-sm bg-indigo-500 text-white px-4 py-2 rounded">Lihat</button>
        </a>
    </div>

    <!-- Manage Data Pengajar -->
    <div class="bg-white p-6 rounded shadow flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <i class="fas fa-users-cog text-3xl text-pink-500"></i>
            <div>
                <h2 class="text-xl font-bold">MANAGE DATA PENGAJAR</h2>
                <p class="text-gray-600">Edit, Hapus, Update</p>
            </div>
        </div>
        <a href="{{ route('admin.pengajar.index') }}">
            <button class="text-sm bg-pink-500 text-white px-4 py-2 rounded">Lihat</button>
        </a>
    </div>
</div>


            <!-- Kalender -->
          <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
    @csrf
    @method('DELETE')

    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Pukul</th>
                    <th class="px-4 py-2 border-b">Nama Jadwal</th>
                    <th class="px-4 py-2 border-b">Pengajar</th>
                    <th class="px-4 py-2 border-b">Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                    <tr>
                        <td class="px-4 py-2 border-b">
                            <input type="checkbox" name="selected_jadwals[]" value="{{ $jadwal->id }}">
                        </td>
                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}</td>
                        <td class="px-4 py-2 border-b">{{ $jadwal->pukul_jadwal }}</td>
                        <td class="px-4 py-2 border-b">{{ $jadwal->nama_jadwal }}</td>
                        <td class="px-4 py-2 border-b">{{ $jadwal->nama_pengajar_jadwal }}</td>
                        <td class="px-4 py-2 border-b">{{ $jadwal->kegiatan_jadwal }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                            class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <a href="{{ route('admin.jadwal.index') }}">Kelola Jadwal</a>
    </div>

    <div class="mt-4 flex gap-2">
        <button type="submit" name="action" value="selected"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
            onclick="return confirm('Hapus jadwal yang dipilih?')">
            Hapus Terpilih
        </button>

        <button type="submit" name="action" value="all"
            class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900"
            onclick="return confirm('Hapus semua jadwal?')">
            Hapus Semua
        </button>
    </div>
</form>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
        {{ session('error') }}
    </div>
@endif

            

    <script>

        // hapus jadwal yang dipilih
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
    </script>
</body>
</html>