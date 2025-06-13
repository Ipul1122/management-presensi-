@extends(' components.layouts.pengajar');

@section('content')
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

{{-- <body class="bg-gray-100 min-h-screen flex flex-col"> --}}
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
                    <a href="{{ route('pengajar.infoDataMurid.index') }}">
                        <button title="Profil Pengajar" class="text-blue-600 hover:text-blue-800"><i class="fas fa-users"></i></button>
                    </a>
                    <a href="{{ route('pengajar.infoDataPengajar.index') }}">
                        <button title="Profil Pengajar" class="text-green-600 hover:text-green-800"><i class="fas fa-users"></i></button>
                    </a>
                    {{-- <form action="{{ route('pengajar.infoDataPengajar.index') }}" method="POST">
                        @csrf
                        <button title="Profile Pengajar" class="text-green-600 hover:text-green-800"><i class="fas fa-users"></i></button>
                    </form> --}}
                    <form action="{{ route('pengajar.logout') }}" method="POST">
                        @csrf
                        <button title="Logout" class="text-red-600 hover:text-red-800"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
            </div>
            
            

            <!-- Desktop Navigation Icons -->
            <div class="hidden md:flex space-x-4 text-xl">
                <button title="Input Absen" class="text-blue-600 hover:text-blue-800"><i class="fas fa-calendar-check"></i></button>
                <a href="{{ route('pengajar.infoDataPengajar.index') }}">
                        <button title="Profil Pengajar" class="text-green-600 hover:text-green-800"><i class="fas fa-users"></i></button>
                    </a>
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
            <a href="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="block p-2 hover:bg-gray-200 rounded">riwayat Murid</a>
            <a href="{{ route('pengajar.infoDataMurid.index') }}" class="block p-2 hover:bg-gray-200 rounded">Info Data Murid</a>
            <a href="{{ route('pengajar.infoDataPengajar.index') }}" class="block p-2 hover:bg-gray-200 rounded">Info Data Pengajar</a>
            <a href="{{ route('pengajar.riwayatJadwal.index') }}" class="block p-2 hover:bg-gray-200 rounded">Riwayat Jadwal</a>
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
                    {{-- <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-edit text-3xl text-yellow-500"></i>
                            <span class="text-lg font-semibold">Edit Info Pengajar</span>
                        </div>
                        <button class="text-sm text-yellow-600 hover:underline">Lihat</button>
                    </div> --}}
                </div>

    {{-- slide data pengajar --}}
<div class="mt-6">
    <h2 class="text-lg font-semibold mb-2">Daftar Pengajar</h2>

    <div class="relative">
        <!-- Tombol geser kiri -->
        <button onclick="prevCard()" id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow p-2 rounded-full z-10 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed">
            ←
        </button>

        <!-- Tombol geser kanan -->
        <button onclick="nextCard()" id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow p-2 rounded-full z-10 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed">
            →
        </button>

        <!-- Kontainer untuk cards -->
        <div class="px-12 py-4">
            <div id="pengajarContainer" class="flex transition-transform duration-300 ease-in-out">
                @forelse ($dataPengajar as $index => $pengajar)
                    <div class="w-64 bg-white rounded-lg shadow p-4 text-center flex-shrink-0 mx-2">
                        {{-- FOTO PENGAJAR --}}
                            @if($pengajar->foto_pengajar)
                                <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                    alt="foto" class="h-14 w-14 my-4 rounded object-cover border-2 border-green-140">
                                    {{ substr($pengajar->nama_pengajar, 0, 100) }}
                            @else
                            {{-- NAMA PENGAJAR --}}
                                <td class="h-14 w-14 rounded bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-semibold">
                                    {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                </td>
                            @endif
                                <p class="text-sm text-gray-600">{{ $pengajar->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                @empty
                    <div class="w-64 bg-white rounded-lg shadow p-4 text-center flex-shrink-0 mx-2">
                        <img src="{{ asset('default/user.png') }}"
                            alt="Foto Default"
                            class="w-20 h-20 mx-auto rounded-full object-cover mb-2">
                        <h3 class="text-md font-bold">John Doe</h3>
                        <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Indikator dot (opsional) -->
        <div class="flex justify-center mt-4 space-x-2" id="indicators">
            <!-- Dots akan dibuat oleh JavaScript -->
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('pengajarContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicators = document.getElementById('indicators');
    
    let currentIndex = 0;
    const cards = container.children;
    const totalCards = cards.length;
    const cardsPerView = Math.floor((container.parentElement.offsetWidth - 96) / 272); // 272 = 256 + 16 (width + margin)
    const maxIndex = Math.max(0, totalCards - cardsPerView);

    // Buat indikator dots
    function createIndicators() {
        indicators.innerHTML = '';
        const totalPages = Math.ceil(totalCards / cardsPerView);
        
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('div');
            dot.className = 'w-2 h-2 rounded-full cursor-pointer transition-colors duration-200';
            dot.className += i === 0 ? ' bg-blue-500' : ' bg-gray-300';
            dot.onclick = () => goToPage(i);
            indicators.appendChild(dot);
        }
    }

    // Update posisi container
    function updatePosition() {
        const translateX = -(currentIndex * (256 + 16)); // 256px width + 16px margin
        container.style.transform = `translateX(${translateX}px)`;
        
        // Update tombol
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= maxIndex;
        
        // Update indikator
        const currentPage = Math.floor(currentIndex / cardsPerView);
        const dots = indicators.children;
        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(/bg-(blue|gray)-(500|300)/, '');
            dots[i].className += i === currentPage ? ' bg-blue-500' : ' bg-gray-300';
        }
    }

    // Fungsi navigasi
    function prevCard() {
        if (currentIndex > 0) {
            currentIndex = Math.max(0, currentIndex - cardsPerView);
            updatePosition();
        }
    }

    function nextCard() {
        if (currentIndex < maxIndex) {
            currentIndex = Math.min(maxIndex, currentIndex + cardsPerView);
            updatePosition();
        }
    }

    function goToPage(pageIndex) {
        currentIndex = Math.min(pageIndex * cardsPerView, maxIndex);
        updatePosition();
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            prevCard();
        } else if (e.key === 'ArrowRight') {
            nextCard();
        }
    });

    // Auto-resize handler
    window.addEventListener('resize', function() {
        const newCardsPerView = Math.floor((container.parentElement.offsetWidth - 96) / 272);
        if (newCardsPerView !== cardsPerView) {
            location.reload(); // Simple solution untuk resize
        }
    });

    // Initialize
    createIndicators();
    updatePosition();
</script>


                {{-- JADWAL BULAN IN --}}
        <div class="mt-6 bg-white p-4 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Kalender Kegiatan - Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h2>

        @if($jadwalBulanIni->isEmpty())
            <p class="text-gray-500">Tidak ada jadwal pada bulan ini.</p>
        @else
        <div class="overflow-auto">
            <table>
        <thead>
        <tr>
        <th>Tanggal</th>
        <th>Pukul</th>
        <th>Nama Jadwal</th>
        <th>Pengajar</th>
        <th>Kegiatan</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($jadwalBulanIni as $jadwal)
        <tr>
            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}</td>
            <td>{{ $jadwal->pukul_jadwal }}</td>
            <td>{{ $jadwal->nama_jadwal }}</td>
            <td>{{ $jadwal->nama_pengajar_jadwal }}</td>
            <td>{{ $jadwal->kegiatan_jadwal }}</td>
            <td>
            @if($jadwal->status === 'Hari Ini')
                <span class="text-blue-500 font-bold">{{ $jadwal->status }}</span>
            @elseif($jadwal->status === 'Selesai')
                <span class="text-green-500">{{ $jadwal->status }}</span>
            @else
                <span class="text-yellow-500">{{ $jadwal->status }}</span>
            @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-gray-400">Tidak ada jadwal bulan ini.</td></tr>
        @endforelse
        </tbody>
        </table>

            </div>
                @endif
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
@endsection
