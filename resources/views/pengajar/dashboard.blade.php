@extends('components.layouts.pengajar.sidebar')
@extends('components.layouts.pengajar.navbar')

@section('sidebar-pengajar')
@section('navbar-pengajar')

<style>

.teacher-slider-container {
    position: relative;
    overflow: hidden;
    padding: 8px;
}

#pengajarContainer {
    display: flex;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

.teacher-card {
    min-width: 288px; /* w-72 equivalent */
    flex-shrink: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.teacher-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Navigation Buttons */
#prevBtn, #nextBtn {
    position: relative;
    z-index: 10;
    cursor: pointer;
    user-select: none;
    transition: all 0.2s ease;
}

#prevBtn:disabled, #nextBtn:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

#prevBtn:not(:disabled):hover, #nextBtn:not(:disabled):hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Indicators */
#indicators {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    gap: 8px;
}

#indicators button {
    cursor: pointer;
    border: none;
    outline: none;
    transition: all 0.3s ease;
}

#indicators button:hover {
    transform: scale(1.2);
}

#indicators button:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Responsive Design */
@media (max-width: 640px) {
    .teacher-card {
        min-width: calc(100vw - 3rem);
        max-width: calc(100vw - 3rem);
    }
    
    #pengajarContainer {
        gap: 16px;
    }
}

@media (min-width: 641px) and (max-width: 1024px) {
    .teacher-card {
        min-width: calc(50vw - 2rem);
        max-width: calc(50vw - 2rem);
    }
}

@media (min-width: 1025px) {
    .teacher-card {
        min-width: 288px;
        max-width: 288px;
    }
}

/* Animation Classes */
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

.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
}

/* Smooth scrolling for better UX */
html {
    scroll-behavior: smooth;
}

/* Focus styles for accessibility */
.teacher-card:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Loading state */
.teacher-card.loading {
    opacity: 0.6;
    pointer-events: none;
}

.teacher-card.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

/* Mobile touch improvements */
@media (hover: none) and (pointer: coarse) {
    .teacher-card:hover {
        transform: none;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    .teacher-card:active {
        transform: scale(0.98);
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .teacher-card {
        border: 2px solid #000;
    }
    
    #prevBtn, #nextBtn {
        border: 2px solid #000;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    #pengajarContainer {
        transition: none;
    }
    
    .teacher-card {
        transition: none;
    }
    
    .animate-fade-in {
        animation: none;
    }
}

</style>
    <!-- Main Content -->
    <main class="flex-1 overflow-hidden bg-slate-50/50">
        <div class="p-4 sm:p-6 lg:p-8 space-y-6 lg:space-y-8">
            <!-- Welcome Section -->
            <div class="animate-fade-in">
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl lg:rounded-3xl p-6 lg:p-8 text-white shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                    <div class="relative">
                        <h2 class="text-2xl lg:text-3xl font-bold mb-2 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                            Selamat Datang!
                        </h2>
                        <p class="text-blue-100 text-base lg:text-lg">Kelola aktivitas pembelajaran dengan mudah dan efisien</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Aksi Cepat</h3>
                    <div class="h-px bg-gradient-to-r from-gray-200 to-transparent flex-1 ml-4"></div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-6">
                    <!-- Absensi Murid Card -->
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100/80 p-6 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="relative w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 transition-shadow duration-300">
                                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                                    <div class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg group-hover:text-blue-600 transition-colors">Absensi Murid</h4>
                                    <p class="text-sm text-gray-500 mt-1">Kelola kehadiran murid</p>
                                </div>
                            </div>
                            <a href="{{ route('pengajar.muridAbsensi.index') }}" 
                                class="px-5 py-2.5 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 hover:scale-105 transition-all duration-200 font-semibold text-sm shadow-sm">
                                Lihat
                            </a>
                        </div>
                    </div>

                    <!-- Info Data Murid Card -->
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100/80 p-6 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="relative w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/25 group-hover:shadow-blue-500/40 transition-shadow duration-300">
                                    <i class="fas fa-users text-white text-xl"></i>
                                    <div class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg group-hover:text-blue-600 transition-colors">Info Data Murid</h4>
                                    <p class="text-sm text-gray-500 mt-1">Lihat informasi murid</p> 
                                </div>
                            </div>
                            <a href="{{ route('pengajar.infoDataMurid.index') }}" 
                                class="px-5 py-2.5 bg-emerald-50 text-blue-600 rounded-xl hover:bg-blue-100 hover:scale-105 transition-all duration-200 font-semibold text-sm shadow-sm">
                                Lihat
                            </a>
                        </div>
                    </div>

                    <!-- Jadwal Hari Ini Card -->
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100/80 p-6 transition-all duration-300 hover:-translate-y-1 sm:col-span-2 xl:col-span-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="relative w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 transition-shadow duration-300">
                                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                                    <div class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div>
                                        <h4 class="font-bold text-gray-900 text-lg group-hover:text-blue-600 transition-colors">Jadwal Hari Ini</h4>
                                        <p class="text-sm text-gray-500 mt-1">Lihat agenda hari ini</p>
                                </div>
                            </div>
                            <a href="{{ route('pengajar.jadwal.index')}}">
                            <button class="px-5 py-2.5 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 hover:scale-105 transition-all duration-200 font-semibold text-sm shadow-sm">
                                Lihat
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Slider Section -->
            <div class="animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <h3 class="text-xl font-bold text-gray-900">Daftar Pengajar</h3>
                        <div class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                            {{ count($dataPengajar) }}
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="prevCard()" id="prevBtn" 
                                class="p-3 rounded-xl bg-white shadow-sm border border-gray-200 hover:bg-gray-50 hover:border-gray-300 hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed group">
                            <i class="fas fa-chevron-left text-gray-600 group-hover:text-gray-700"></i>
                        </button>
                        <button onclick="nextCard()" id="nextBtn" 
                                class="p-3 rounded-xl bg-white shadow-sm border border-gray-200 hover:bg-gray-50 hover:border-gray-300 hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed group">
                            <i class="fas fa-chevron-right text-gray-600 group-hover:text-gray-700"></i>
                        </button>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl">
                    <div id="pengajarContainer" class="flex transition-transform duration-500 ease-in-out space-x-6 p-1">
                        @forelse ($dataPengajar as $index => $pengajar)
                            <div class="teacher-card w-72 flex-shrink-0 bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100/80 p-8 text-center transition-all duration-300 hover:-translate-y-2 group">
                                <div class="mb-6">
                                    @if($pengajar->foto_pengajar)
                                        <div class="relative inline-block">
                                            <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                                alt="Foto {{ $pengajar->nama_pengajar }}" 
                                                class="w-20 h-20 mx-auto rounded-2xl object-cover border-4 border-blue-200 group-hover:border-blue-300 transition-all duration-300 shadow-lg">
                                            <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-blue-500 rounded-full border-2 border-white shadow-sm"></div>
                                        </div>
                                    @else
                                        <div class="relative inline-block">
                                            <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg group-hover:shadow-blue-500/30 transition-all duration-300">
                                                {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                            </div>
                                            <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-blue-500 rounded-full border-2 border-white shadow-sm"></div>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-bold text-gray-900 mb-3 text-lg group-hover:text-blue-600 transition-colors">
                                    {{ $pengajar->nama_pengajar }}
                                </h4>
                                <p class="text-sm text-gray-500 leading-relaxed">
                                    {{ $pengajar->deskripsi ?? 'Pengajar berpengalaman dengan dedikasi tinggi' }}
                                </p>
                            </div>
                        @empty
                            <div class="teacher-card w-72 flex-shrink-0 bg-white rounded-2xl shadow-sm border border-gray-100/80 p-8 text-center">
                                <div class="mb-6">
                                    <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                        <i class="fas fa-user-slash text-2xl"></i>
                                    </div>
                                </div>
                                <h4 class="font-bold text-gray-900 mb-3 text-lg">Belum Ada Data</h4>
                                <p class="text-sm text-gray-500">Data pengajar belum tersedia</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Indicators -->
                <div class="flex justify-center mt-8 space-x-2" id="indicators">
                    <!-- Dots will be created by JavaScript -->
                </div>
            </div>

            <!-- Monthly Schedule -->
            <div class="animate-fade-in ">
                <div class="bg-gradient-to-br border-black from-blue-500 to-indigo-600 rounded-2xl shadow-sm  border-blue-500/80 overflow-hidden">
                    <div class="p-6 lg:p-8 border-b bg-gradient-to-br border-black from-blue-500 to-indigo-600 ">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-blue-500/25">
                                <i class="fas fa-calendar-alt text-white"></i>
                            </div>
                            <div class=""> 
                                <span class="block text-white ">Kalender Kegiatan</span>
                                <span class="text-sm font-normal text-white mt-1">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span>
                            </div>
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        @if($jadwalBulanIni->isEmpty())
                            <div class="p-12 text-center">
                                <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                    <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-3">Tidak Ada Jadwal</h4>
                                <p class="text-white max-w-md mx-auto leading-relaxed">Belum ada jadwal kegiatan untuk bulan ini. Jadwal akan muncul ketika sudah ditambahkan.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-full">
                                    <thead class="bg-gradient-to-br border-black from-blue-500 to-indigo-600 ">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Waktu</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Jadwal</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Pengajar</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Kegiatan</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach($jadwalBulanIni as $jadwal)
                                            <tr class="hover:bg-gray-50/80 transition-colors duration-200 group">
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 group-hover:bg-blue-600 transition-colors"></div>
                                                        <span class="font-bold text-gray-900 text-sm">
                                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-700">
                                                    {{ $jadwal->pukul_jadwal }}
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    <span class="font-bold text-gray-900 text-sm">{{ $jadwal->nama_jadwal }}</span>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $jadwal->nama_pengajar_jadwal }}
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $jadwal->kegiatan_jadwal }}
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    @if($jadwal->status === 'Hari Ini')
                                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                            <div class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-2"></div>
                                                            {{ $jadwal->status }}
                                                        </span>
                                                    @elseif($jadwal->status === 'Selesai')
                                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                            <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></div>
                                                            {{ $jadwal->status }}
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                            <div class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-2"></div>
                                                            {{ $jadwal->status }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

    <script>

        // Teacher Slider JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('pengajarContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicatorsContainer = document.getElementById('indicators');
    
    if (!container || !prevBtn || !nextBtn) {
        console.warn('Teacher slider elements not found');
        return;
    }

    const cards = container.querySelectorAll('.teacher-card');
    const totalCards = cards.length;
    
    if (totalCards === 0) {
        prevBtn.disabled = true;
        nextBtn.disabled = true;
        return;
    }

    let currentIndex = 0;
    let cardsPerView = getCardsPerView();
    let maxIndex = Math.max(0, totalCards - cardsPerView);

    // Function to determine cards per view based on screen size
    function getCardsPerView() {
        const containerWidth = container.parentElement.offsetWidth;
        const cardWidth = 288; // w-72 = 288px + gap
        const gap = 24; // space-x-6 = 24px
        
        if (window.innerWidth >= 1280) { // xl breakpoint
            return Math.floor(containerWidth / (cardWidth + gap)) || 1;
        } else if (window.innerWidth >= 768) { // md breakpoint
            return Math.floor(containerWidth / (cardWidth + gap)) || 1;
        } else {
            return 1; // mobile
        }
    }

    // Create indicators
    function createIndicators() {
        indicatorsContainer.innerHTML = '';
        const totalPages = Math.ceil(totalCards / cardsPerView);
        
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('button');
            dot.className = `w-2 h-2 rounded-full transition-all duration-300 ${
                i === Math.floor(currentIndex / cardsPerView) 
                    ? 'bg-blue-600 w-8' 
                    : 'bg-gray-300 hover:bg-gray-400'
            }`;
            dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
            dot.addEventListener('click', () => goToSlide(i * cardsPerView));
            indicatorsContainer.appendChild(dot);
        }
    }

    // Update slider position
    function updateSlider() {
        const cardWidth = cards[0]?.offsetWidth || 288;
        const gap = 24; // space-x-6
        const translateX = -(currentIndex * (cardWidth + gap));
        
        container.style.transform = `translateX(${translateX}px)`;
        
        // Update button states
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= maxIndex;
        
        // Update button opacity
        prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
        nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
        
        // Update indicators
        updateIndicators();
    }

    // Update indicators
    function updateIndicators() {
        const dots = indicatorsContainer.querySelectorAll('button');
        const currentPage = Math.floor(currentIndex / cardsPerView);
        
        dots.forEach((dot, index) => {
            if (index === currentPage) {
                dot.className = 'w-8 h-2 rounded-full bg-blue-600 transition-all duration-300';
            } else {
                dot.className = 'w-2 h-2 rounded-full bg-gray-300 hover:bg-gray-400 transition-all duration-300';
            }
        });
    }

    // Navigate to specific slide
    function goToSlide(index) {
        currentIndex = Math.max(0, Math.min(index, maxIndex));
        updateSlider();
    }

    // Previous card function
    window.prevCard = function() {
        if (currentIndex > 0) {
            currentIndex = Math.max(0, currentIndex - cardsPerView);
            updateSlider();
        }
    };

    // Next card function  
    window.nextCard = function() {
        if (currentIndex < maxIndex) {
            currentIndex = Math.min(maxIndex, currentIndex + cardsPerView);
            updateSlider();
        }
    };

    // Handle window resize
    function handleResize() {
        const newCardsPerView = getCardsPerView();
        if (newCardsPerView !== cardsPerView) {
            cardsPerView = newCardsPerView;
            maxIndex = Math.max(0, totalCards - cardsPerView);
            currentIndex = Math.min(currentIndex, maxIndex);
            createIndicators();
            updateSlider();
        }
    }

    // Auto-slide functionality (optional)
    let autoSlideInterval;
    
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            if (currentIndex >= maxIndex) {
                currentIndex = 0;
            } else {
                currentIndex++;
            }
            updateSlider();
        }, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
        }
    }

    // Keyboard navigation
    function handleKeyPress(event) {
        switch(event.key) {
            case 'ArrowLeft':
                event.preventDefault();
                prevCard();
                break;
            case 'ArrowRight':
                event.preventDefault();
                nextCard();
                break;
        }
    }

    // Touch/Swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    function handleTouchStart(event) {
        touchStartX = event.changedTouches[0].screenX;
    }
    
    function handleTouchEnd(event) {
        touchEndX = event.changedTouches[0].screenX;
        handleSwipe();
    }
    
    function handleSwipe() {
        const swipeThreshold = 50; // minimum distance for swipe
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next card
                nextCard();
            } else {
                // Swipe right - previous card
                prevCard();
            }
        }
    }

    // Event listeners
    window.addEventListener('resize', handleResize);
    document.addEventListener('keydown', handleKeyPress);
    
    // Touch events for mobile swipe
    container.addEventListener('touchstart', handleTouchStart, { passive: true });
    container.addEventListener('touchend', handleTouchEnd, { passive: true });
    
    // Hover events for auto-slide
    container.addEventListener('mouseenter', stopAutoSlide);
    container.addEventListener('mouseleave', startAutoSlide);
    
    // Initialize
    createIndicators();
    updateSlider();
    
    // Start auto-slide if there are multiple cards
    if (totalCards > cardsPerView) {
        startAutoSlide();
    }

    // Smooth scroll behavior
    container.style.scrollBehavior = 'smooth';
    
    // Add intersection observer for animations (optional)
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    }
});

// Additional utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function for performance
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

    </script>


@endsection