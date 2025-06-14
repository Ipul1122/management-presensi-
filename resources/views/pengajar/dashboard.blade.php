@extends('components.layouts.pengajar')

@section('content')
<style>
    .sidebar {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
    }
    .sidebar.active {
        transform: translateX(0);
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .slide-container {
        scroll-behavior: smooth;
    }
    
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
            width: 280px;
        }
    }
    
    .nav-icon {
        transition: all 0.2s ease;
    }
    
    .nav-icon:hover {
        transform: scale(1.1);
    }
    
    .teacher-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table-modern th,
    .table-modern td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .table-modern th {
        background: #f9fafb;
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table-modern tr:last-child td {
        border-bottom: none;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .mobile-nav-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        margin-bottom: 0.5rem;
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
</style>

<!-- Header/Navbar -->
<header class="glass-effect sticky top-0 z-40 border-b border-gray-200/50">
    <nav class="px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Left Section -->
            <div class="flex items-center space-x-4">
                <button id="hamburger" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
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

<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="sidebar w-72 bg-white shadow-xl">
        <div class="p-6">
            <!-- Mobile Close Button -->
            <div class="flex justify-between items-center lg:hidden mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Menu</h2>
                <button id="closeSidebar" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times text-gray-600"></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="space-y-2">
                <a href="{{ route('pengajar.muridAbsensi.index') }}" class="mobile-nav-item text-gray-700 hover:text-blue-600">
                    <i class="fas fa-clipboard-check text-blue-500"></i>
                    <span>Absen Murid</span>
                </a>
                <a href="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="mobile-nav-item text-gray-700 hover:text-blue-600">
                    <i class="fas fa-history text-indigo-500"></i>
                    <span>Riwayat Murid</span>
                </a>
                <a href="{{ route('pengajar.infoDataMurid.index') }}" class="mobile-nav-item text-gray-700 hover:text-blue-600">
                    <i class="fas fa-users text-green-500"></i>
                    <span>Info Data Murid</span>
                </a>
                <a href="{{ route('pengajar.infoDataPengajar.index') }}" class="mobile-nav-item text-gray-700 hover:text-blue-600">
                    <i class="fas fa-chalkboard-teacher text-yellow-500"></i>
                    <span>Info Data Pengajar</span>
                </a>
                <a href="{{ route('pengajar.riwayatJadwal.index') }}" class="mobile-nav-item text-gray-700 hover:text-blue-600">
                    <i class="fas fa-calendar-alt text-purple-500"></i>
                    <span>Riwayat Jadwal</span>
                </a>
                
                <hr class="my-4 border-gray-200">
                
                <form action="{{ route('pengajar.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="mobile-nav-item text-red-600 hover:text-red-700 w-full text-left">
                        <i class="fas fa-sign-out-alt text-red-500"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>

            <!-- Version Info -->
            <div class="mt-8 pt-4 border-t border-gray-200">
                <p class="text-xs text-gray-400 text-center">Versi Web 1.0</p>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-hidden">
        <div class="p-6 space-y-8">
            <!-- Welcome Section -->
            <div class="animate-fade-in">
                <div class="gradient-bg rounded-2xl p-6 text-white">
                    <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
                    <p class="text-white/90">Kelola aktivitas pembelajaran dengan mudah dan efisien</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="animate-fade-in">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clipboard-list text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Absensi Murid</h4>
                                    <p class="text-sm text-gray-600">Kelola kehadiran murid</p>
                                </div>
                            </div>
                            <a href="{{ route('pengajar.muridAbsensi.index') }}" 
                                    class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors font-medium">
                                Lihat
                            </a>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Info Data Murid</h4>
                                    <p class="text-sm text-gray-600">Lihat informasi murid</p>
                                </div>
                            </div>
                            <a href="{{ route('pengajar.infoDataMurid.index') }}" 
                               class="px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors font-medium">
                                Lihat
                            </a>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:col-span-2 xl:col-span-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Jadwal Hari Ini</h4>
                                    <p class="text-sm text-gray-600">Lihat agenda hari ini</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition-colors font-medium">
                                Lihat
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Slider Section -->
            <div class="animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Pengajar</h3>
                    <div class="flex space-x-2">
                        <button onclick="prevCard()" id="prevBtn" 
                                class="p-2 rounded-lg bg-white shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button onclick="nextCard()" id="nextBtn" 
                                class="p-2 rounded-lg bg-white shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <div class="relative overflow-hidden">
                    <div id="pengajarContainer" class="flex transition-transform duration-500 ease-in-out space-x-4">
                        @forelse ($dataPengajar as $index => $pengajar)
                            <div class="teacher-card w-64 flex-shrink-0 rounded-xl shadow-sm p-6 text-center">
                                <div class="mb-4">
                                    @if($pengajar->foto_pengajar)
                                        <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                            alt="Foto {{ $pengajar->nama_pengajar }}" 
                                            class="w-16 h-16 mx-auto rounded-full object-cover border-4 border-green-200">
                                    @else
                                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-bold text-xl">
                                            {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-semibold text-gray-800 mb-2">{{ $pengajar->nama_pengajar }}</h4>
                                <p class="text-sm text-gray-600">{{ $pengajar->deskripsi ?? 'Pengajar berpengalaman' }}</p>
                            </div>
                        @empty
                            <div class="teacher-card w-64 flex-shrink-0 rounded-xl shadow-sm p-6 text-center">
                                <div class="mb-4">
                                    <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center text-white font-bold text-xl">
                                        ?
                                    </div>
                                </div>
                                <h4 class="font-semibold text-gray-800 mb-2">Belum Ada Data</h4>
                                <p class="text-sm text-gray-600">Data pengajar belum tersedia</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Indicators -->
                <div class="flex justify-center mt-6 space-x-2" id="indicators">
                    <!-- Dots will be created by JavaScript -->
                </div>
            </div>

            <!-- Monthly Schedule -->
            <div class="animate-fade-in">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                            Kalender Kegiatan - {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        @if($jadwalBulanIni->isEmpty())
                            <div class="p-8 text-center">
                                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-600 mb-2">Tidak Ada Jadwal</h4>
                                <p class="text-gray-500">Belum ada jadwal kegiatan untuk bulan ini</p>
                            </div>
                        @else
                            <table class="table-modern w-full">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Nama Jadwal</th>
                                        <th>Pengajar</th>
                                        <th>Kegiatan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalBulanIni as $jadwal)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}
                                            </td>
                                            <td class="text-gray-700">{{ $jadwal->pukul_jadwal }}</td>
                                            <td class="font-medium text-gray-900">{{ $jadwal->nama_jadwal }}</td>
                                            <td class="text-gray-700">{{ $jadwal->nama_pengajar_jadwal }}</td>
                                            <td class="text-gray-700">{{ $jadwal->kegiatan_jadwal }}</td>
                                            <td>
                                                @if($jadwal->status === 'Hari Ini')
                                                    <span class="status-badge bg-blue-100 text-blue-800">{{ $jadwal->status }}</span>
                                                @elseif($jadwal->status === 'Selesai')
                                                    <span class="status-badge bg-green-100 text-green-800">{{ $jadwal->status }}</span>
                                                @else
                                                    <span class="status-badge bg-yellow-100 text-yellow-800">{{ $jadwal->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
// Sidebar functionality
const hamburger = document.getElementById('hamburger');
const closeSidebar = document.getElementById('closeSidebar');
const sidebar = document.querySelector('.sidebar');

hamburger?.addEventListener('click', () => {
    sidebar.classList.add('active');
});

closeSidebar?.addEventListener('click', () => {
    sidebar.classList.remove('active');
});

document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
        sidebar.classList.remove('active');
    }
});

// Teacher slider functionality
const container = document.getElementById('pengajarContainer');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const indicators = document.getElementById('indicators');

if (container && prevBtn && nextBtn && indicators) {
    let currentIndex = 0;
    const cards = container.children;
    const totalCards = cards.length;
    
    function getCardsPerView() {
        const containerWidth = container.parentElement.offsetWidth;
        if (containerWidth < 640) return 1;
        if (containerWidth < 1024) return 2;
        return 3;
    }
    
    let cardsPerView = getCardsPerView();
    let maxIndex = Math.max(0, totalCards - cardsPerView);
    
    function createIndicators() {
        indicators.innerHTML = '';
        const totalPages = Math.ceil(totalCards / cardsPerView);
        
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('div');
            dot.className = 'w-2 h-2 rounded-full cursor-pointer transition-all duration-200';
            dot.className += i === 0 ? ' bg-blue-500' : ' bg-gray-300';
            dot.onclick = () => goToPage(i);
            indicators.appendChild(dot);
        }
    }
    
    function updatePosition() {
        const cardWidth = 256 + 16; // 256px width + 16px margin
        const translateX = -(currentIndex * cardWidth);
        container.style.transform = `translateX(${translateX}px)`;
        
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= maxIndex;
        
        const currentPage = Math.floor(currentIndex / cardsPerView);
        const dots = indicators.children;
        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(/bg-(blue|gray)-(500|300)/, '');
            dots[i].className += i === currentPage ? ' bg-blue-500' : ' bg-gray-300';
        }
    }
    
    window.prevCard = function() {
        if (currentIndex > 0) {
            currentIndex = Math.max(0, currentIndex - cardsPerView);
            updatePosition();
        }
    };
    
    window.nextCard = function() {
        if (currentIndex < maxIndex) {
            currentIndex = Math.min(maxIndex, currentIndex + cardsPerView);
            updatePosition();
        }
    };
    
    function goToPage(pageIndex) {
        currentIndex = Math.min(pageIndex * cardsPerView, maxIndex);
        updatePosition();
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            window.prevCard();
        } else if (e.key === 'ArrowRight') {
            window.nextCard();
        }
    });
    
    // Responsive handler
    window.addEventListener('resize', function() {
        const newCardsPerView = getCardsPerView();
        if (newCardsPerView !== cardsPerView) {
            cardsPerView = newCardsPerView;
            maxIndex = Math.max(0, totalCards - cardsPerView);
            currentIndex = Math.min(currentIndex, maxIndex);
            createIndicators();
            updatePosition();
        }
    });
    
    // Initialize
    createIndicators();
    updatePosition();
}

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading states for buttons
document.querySelectorAll('button[type="submit"]').forEach(button => {
    button.addEventListener('click', function() {
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
    });
});
</script>
@endsection