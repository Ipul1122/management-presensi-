@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')

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

    /* Popover styles */
    .popover-visible {
        visibility: visible !important;
        opacity: 1 !important;
        transform: translateY(-8px) !important;
    }
</style>


<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center lg:text-left">
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-2 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                📅 Riwayat Jadwal
            </h1>
            <p class="text-gray-600 text-sm lg:text-base">Kelola dan lihat riwayat jadwal yang telah berlalu</p>
        </div>

        {{-- DROPDOWN FILTER --}}
        <form method="GET" class="mb-6 flex flex-wrap items-center gap-2">
            <div class="relative">
                <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan</label>
                <select name="bulan" id="bulan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200" onchange="checkScheduleData()">
                    <option value="">-- Pilih Bulan --</option>
                    @for ($i = 1; $i <= 12; $i++)
                        @php
                            $currentYear = request('tahun') ?: date('Y');
                            $hasSchedule = isset($jadwalData[$currentYear . '-' . $i]);
                            $scheduleCount = $hasSchedule ? $jadwalData[$currentYear . '-' . $i]->jumlah : 0;
                        @endphp
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }} 
                                data-has-schedule="{{ $hasSchedule ? 'true' : 'false' }}"
                                data-schedule-count="{{ $scheduleCount }}">
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            @if($hasSchedule) ● @endif
                        </option>
                    @endfor
                </select>
                <!-- Popover untuk bulan -->
                <div id="bulan-popover" class="absolute z-10 invisible opacity-0 bg-blue-600 text-white text-xs rounded-lg py-2 px-3 shadow-lg transition-all duration-200 transform -translate-y-1 pointer-events-none">
                    <span id="bulan-popover-text">Ada jadwal di bulan ini</span>
                    <div class="absolute bottom-[-6px] left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-transparent border-t-blue-600"></div>
                </div>
            </div>

            <div class="relative">
                <label for="tahun" class="block text-sm font-medium text-gray-700">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200" onchange="checkScheduleData()">
                    <option value="">-- Pilih Tahun --</option>
                    @foreach ($availableYears as $year)
                        @php
                            $hasScheduleInYear = $jadwalData->keys()->filter(function($key) use ($year) {
                                return str_starts_with($key, $year . '-');
                            })->count() > 0;
                            $totalSchedulesInYear = $jadwalData->filter(function($item, $key) use ($year) {
                                return str_starts_with($key, $year . '-');
                            })->sum('jumlah');
                        @endphp
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}
                                data-has-schedule="{{ $hasScheduleInYear ? 'true' : 'false' }}"
                                data-schedule-count="{{ $totalSchedulesInYear }}">
                            {{ $year }}
                            @if($hasScheduleInYear) ● @endif
                        </option>
                    @endforeach
                </select>
                <!-- Popover untuk tahun -->
                <div id="tahun-popover" class="absolute z-10 invisible opacity-0 bg-green-600 text-white text-xs rounded-lg py-2 px-3 shadow-lg transition-all duration-200 transform -translate-y-1 pointer-events-none">
                    <span id="tahun-popover-text">Ada jadwal di tahun ini</span>
                    <div class="absolute bottom-[-6px] left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-transparent border-t-green-600"></div>
                </div>
            </div>

            <div class="self-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Tampilkan</button>
            </div>
        </form>

        {{--  --}}
        @forelse ($groupedByMonth as $month => $jadwals)
            @php
                $totalGaji = $jadwals->sum('gaji');
            @endphp
            
            <!-- Accordion Container -->
            <div class="mb-4 lg:mb-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <!-- Accordion Header -->
                <div class="accordion-header cursor-pointer select-none bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 p-4 lg:p-6" 
                    onclick="toggleAccordion(this)">
                    {{-- ADD BUTTON PDF --}}
                    @if(request('bulan') && request('tahun'))
                        <a href="{{ route('admin.riwayatJadwal.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                            class="inline-block bg-red-600 hover:bg-red-700 text-white text-xs font-medium px-3 py-1 rounded-md transition"
                            target="_blank">
                            📄 Download PDF
                        </a>
                    @endif
                    {{--  --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 rounded-full p-2">
                                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg lg:text-xl font-bold text-white">{{ $month }}</h2>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 space-y-1 sm:space-y-0">
                                    <p class="text-blue-100 text-sm">{{ count($jadwals) }} jadwal</p>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-yellow-300 text-sm font-semibold">Total: Rp {{ number_format($totalGaji, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="hidden sm:inline-block bg-white/20 text-white text-xs px-3 py-1 rounded-full font-medium">
                                {{ count($jadwals) }} item
                            </span>
                            <div class="hidden lg:flex items-center space-x-1 bg-yellow-400/20 text-yellow-100 text-xs px-3 py-1 rounded-full font-medium">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                                <span>Rp {{ number_format($totalGaji, 0, ',', '.') }}</span>
                            </div>
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
                        <!-- Summary Card -->
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-4 mb-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">Ringkasan Bulan {{ $month }}</h3>
                                    <p class="text-green-100 text-sm">Total pendapatan dari {{ count($jadwals) }} jadwal</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold">Rp {{ number_format($totalGaji, 0, ',', '.') }}</div>
                                    <div class="text-green-100 text-xs">{{ count($jadwals) }} jadwal selesai</div>
                                </div>
                            </div>
                        </div>
                        
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
                                                
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <svg class="w-4 h-4 text-yellow-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span class="font-semibold text-green-600">Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}</span>
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

<!-- Hidden data untuk JavaScript -->
<script type="text/javascript">
    const jadwalData = @json($jadwalData);
</script>

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

    // Popover functionality
    let hideTimeout;

    function showPopover(element, popoverId) {
        clearTimeout(hideTimeout);
        const popover = document.getElementById(popoverId);
        const selectedOption = element.options[element.selectedIndex];
        const hasSchedule = selectedOption.getAttribute('data-has-schedule') === 'true';
        const scheduleCount = selectedOption.getAttribute('data-schedule-count');
        
        if (hasSchedule && scheduleCount > 0) {
            const popoverText = document.getElementById(popoverId + '-text');
            if (popoverId === 'bulan-popover') {
                popoverText.textContent = `Ada ${scheduleCount} jadwal di bulan ini`;
            } else {
                popoverText.textContent = `Ada ${scheduleCount} jadwal di tahun ini`;
            }
            popover.classList.add('popover-visible');
        }
    }

    function hidePopover(popoverId) {
        hideTimeout = setTimeout(() => {
            const popover = document.getElementById(popoverId);
            popover.classList.remove('popover-visible');
        }, 100);
    }

    function checkScheduleData() {
        const bulanSelect = document.getElementById('bulan');
        const tahunSelect = document.getElementById('tahun');
        const bulan = bulanSelect.value;
        const tahun = tahunSelect.value;

        // Update options untuk bulan berdasarkan tahun yang dipilih
        if (tahun) {
            for (let i = 0; i < bulanSelect.options.length; i++) {
                const option = bulanSelect.options[i];
                const monthValue = option.value;
                if (monthValue) {
                    const key = tahun + '-' + monthValue;
                    const hasSchedule = jadwalData[key] ? true : false;
                    const scheduleCount = jadwalData[key] ? jadwalData[key].jumlah : 0;
                    
                    option.setAttribute('data-has-schedule', hasSchedule ? 'true' : 'false');
                    option.setAttribute('data-schedule-count', scheduleCount);
                    
                    // Update text option untuk menampilkan indikator
                    const monthName = option.textContent.replace(' ●', '');
                    option.textContent = monthName + (hasSchedule ? ' ●' : '');
                }
            }
        }
    }

    // Event listeners untuk dropdown bulan
    document.getElementById('bulan').addEventListener('mouseenter', function() {
        showPopover(this, 'bulan-popover');
    });

    document.getElementById('bulan').addEventListener('mouseleave', function() {
        hidePopover('bulan-popover');
    });

    document.getElementById('bulan').addEventListener('focus', function() {
        showPopover(this, 'bulan-popover');
    });

    document.getElementById('bulan').addEventListener('blur', function() {
        hidePopover('bulan-popover');
    });

    // Event listeners untuk dropdown tahun
    document.getElementById('tahun').addEventListener('mouseenter', function() {
        showPopover(this, 'tahun-popover');
    });

    document.getElementById('tahun').addEventListener('mouseleave', function() {
        hidePopover('tahun-popover');
    });

    document.getElementById('tahun').addEventListener('focus', function() {
        showPopover(this, 'tahun-popover');
    });

    document.getElementById('tahun').addEventListener('blur', function() {
        hidePopover('tahun-popover');
    });

    // Initialize pada load
    document.addEventListener('DOMContentLoaded', function() {
        checkScheduleData();
    });
</script>
@endsection
