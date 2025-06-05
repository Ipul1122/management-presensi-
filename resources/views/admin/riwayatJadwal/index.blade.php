@extends('components.layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center lg:text-left">
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-2 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                📅 Riwayat Jadwal
            </h1>
            <p class="text-gray-600 text-sm lg:text-base">Kelola dan lihat riwayat jadwal yang telah berlalu</p>
        </div>

        @forelse ($groupedByMonth as $month => $jadwals)
            <!-- Accordion Container -->
            <div class="mb-4 lg:mb-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <!-- Accordion Header -->
                <div class="accordion-header cursor-pointer select-none bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 p-4 lg:p-6" 
                     onclick="toggleAccordion(this)">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 rounded-full p-2">
                                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg lg:text-xl font-bold text-white">{{ $month }}</h2>
                                <p class="text-blue-100 text-sm">{{ count($jadwals) }} jadwal</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="hidden sm:inline-block bg-white/20 text-white text-xs px-3 py-1 rounded-full font-medium">
                                {{ count($jadwals) }} item
                            </span>
                            <svg class="accordion-icon w-5 h-5 lg:w-6 lg:h-6 text-white transform transition-transform duration-300" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Accordion Content -->
                <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-4 lg:p-6 bg-gray-50/50">
                        <div class="grid gap-3 lg:gap-4">
                            @foreach ($jadwals as $index => $jadwal)
                                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden group">
                                    <div class="p-4 lg:p-5">
                                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 lg:gap-4">
                                            <!-- Main Info -->
                                            <div class="flex-1 space-y-2">
                                                <div class="flex items-start justify-between">
                                                    <h3 class="font-bold text-gray-800 text-base lg:text-lg group-hover:text-blue-600 transition-colors duration-200">
                                                        {{ $jadwal->nama_jadwal }}
                                                    </h3>
                                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-medium whitespace-nowrap ml-2">
                                                        ✓ Selesai
                                                    </span>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-sm text-gray-600">
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span>{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }}</span>
                                                    </div>
                                                    
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span>{{ $jadwal->pukul_jadwal }}</span>
                                                    </div>
                                                    
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-purple-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span>{{ $jadwal->nama_pengajar_jadwal }}</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="line-clamp-1">{{ $jadwal->kegiatan_jadwal }}</span>
                                                </div>
                                                
                                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="line-clamp-1">Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="h-1 bg-gradient-to-r from-green-400 to-green-500"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-12 lg:py-16">
                <div class="max-w-md mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Riwayat</h3>
                        <p class="text-gray-600 text-sm lg:text-base">Tidak ada riwayat jadwal yang tersedia saat ini.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .accordion-content.open {
        max-height: 1000px;
    }
    
    .accordion-icon.rotate {
        transform: rotate(180deg);
    }
    
    @media (max-width: 640px) {
        .accordion-header {
            padding: 1rem;
        }
        
        .accordion-content .p-4 {
            padding: 1rem;
        }
    }
</style>

<script>
    function toggleAccordion(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('.accordion-icon');
        const allContents = document.querySelectorAll('.accordion-content');
        const allIcons = document.querySelectorAll('.accordion-icon');
        
        // Close all other accordions
        allContents.forEach((item, index) => {
            if (item !== content) {
                item.classList.remove('open');
                item.style.maxHeight = '0px';
                allIcons[index].classList.remove('rotate');
            }
        });
        
        // Toggle current accordion
        if (content.classList.contains('open')) {
            content.classList.remove('open');
            content.style.maxHeight = '0px';
            icon.classList.remove('rotate');
        } else {
            content.classList.add('open');
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.classList.add('rotate');
        }
    }
    
    // Auto-adjust height when window resizes
    window.addEventListener('resize', function() {
        const openContents = document.querySelectorAll('.accordion-content.open');
        openContents.forEach(content => {
            content.style.maxHeight = content.scrollHeight + 'px';
        });
    });
</script>
@endsection