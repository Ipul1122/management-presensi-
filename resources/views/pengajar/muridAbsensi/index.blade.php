@extends('components.layouts.pengajar.sidebar')

@section('sidebar-pengajar')

    <style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out forwards;
    opacity: 0;
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

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #2563eb, #4f46e5);
}

/* Hover effects */
.hover-lift {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Button pulse animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse-slow {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Glass morphism effect */
.glass {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

/* Gradient text animation */
@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.animate-gradient {
    background: linear-gradient(-45deg, #3b82f6, #6366f1, #8b5cf6, #3b82f6);
    background-size: 400% 400%;
    animation: gradient 3s ease infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Floating animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

/* Loading spinner */
.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid #f3f4f6;
    border-top: 2px solid #3b82f6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Custom checkbox styling */
.custom-checkbox {
    appearance: none;
    width: 1rem;
    height: 1rem;
    border: 2px solid #d1d5db;
    border-radius: 0.25rem;
    background-color: white;
    cursor: pointer;
    position: relative;
    transition: all 0.2s;
}

.custom-checkbox:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.custom-checkbox:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
}

/* Mobile responsive improvements */
@media (max-width: 768px) {
    .mobile-padding {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .mobile-text {
        font-size: 0.875rem;
    }
    
    .mobile-card {
        margin-bottom: 1rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .dark-support {
        background-color: #1f2937;
        color: #f9fafb;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    .print-full-width {
        width: 100% !important;
        max-width: none !important;
    }
}
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 mb-8 border border-white/20 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-indigo-500/5"></div>
            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            Data Absensi Murid
                        </h1>
                        <p class="text-slate-600 text-lg">Kelola dan pantau kehadiran murid dengan mudah</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('pengajar.dashboard') }}">
                        <button class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <i class="fas fa-home text-white mr-3"></i>
                            Dashboard
                        </button>
                    </a>
                    <a href="{{ route('pengajar.muridAbsensi.create') }}" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Absen Murid
                    </a>
                    <a href="{{ route('pengajar.mataPelajaran.index') }}" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Mata Pelajaran
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach ([
                ['title' => 'Total Murid', 'count' => $totalMuridHariIni, 'color' => 'blue', 'gradient' => 'from-blue-500 to-blue-600', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['title' => 'Hadir Hari Ini', 'count' => $hadirCount, 'color' => 'emerald', 'gradient' => 'from-emerald-500 to-emerald-600', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['title' => 'izin Hari Ini', 'count' => $izinCount, 'color' => 'rose', 'gradient' => 'from-rose-500 to-rose-600', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z']
            ] as $stat)
            <div class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-white/20 transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br {{ $stat['gradient'] }}/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">{{ $stat['title'] }}</p>
                        <p class="text-3xl font-bold text-{{ $stat['color'] }}-600">{{ $stat['count'] }}</p>
                        <div class="flex items-center mt-2">
                            <div class="w-2 h-2 bg-{{ $stat['color'] }}-500 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-xs text-slate-500">Update terbaru</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br {{ $stat['gradient'] }} rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path>
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Filter and Search Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border border-white/20">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800">Filter & Pencarian</h3>
                </div>
                
                <form method="GET" class="flex flex-wrap gap-3 items-center">
                    @foreach (['nama_murid' => $namaList, 'jenis_kelamin' => $kelaminList, 'jenis_bacaan' => $bacaanList, 'jenis_status' => $statusList] as $name => $list)
                    <select name="{{ $name }}" onchange="this.form.submit()" 
                            class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-slate-300">
                        <option value="">{{ ucfirst(str_replace(['_', 'jenis_'], [' ', ''], $name)) }}</option>
                        @foreach($list as $item)
                            <option value="{{ $item }}" {{ request($name) == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                    @endforeach
                    <button type="button" onclick="clearFilters()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm transition-colors duration-200">
                        Clear
                    </button>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white">Daftar Absensi Murid</h3>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        <button onclick="toggleBulkActions()" id="bulkActionBtn" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl text-sm transition-all duration-200 backdrop-blur-sm">
                            Aksi Massal
                        </button>
                        <div id="bulkActions" class="hidden gap-2">
                            <button onclick="bulkDelete()" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm transition-colors duration-200">
                                Hapus Terpilih
                            </button>
                            <button onclick="deleteAll()" class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white rounded-xl text-sm transition-colors duration-200">
                                Hapus Semua
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden Forms -->
            <form id="deleteAllForm" action="{{ route('pengajar.muridAbsensi.deleteAll') }}" method="POST" style="display:none;" onsubmit="return confirm('Yakin ingin menghapus semua data?')">
                @csrf
                @method('DELETE')
            </form>



            <form id="bulkDeleteForm" action="{{ route('pengajar.muridAbsensi.bulkDelete') }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
                <div id="bulkDeleteIds"></div>
            </form>

            <!-- Mobile Cards View -->
<div class="block lg:hidden">
    @foreach ($absensis as $absen)
    <div class="border-b border-slate-100 last:border-b-0 p-6 hover:bg-slate-50/50 transition-colors duration-200 relative overflow-hidden">
        <!-- Background tidak menghalangi klik -->
        <div class="absolute inset-0 bg-gradient-to-r {{ $absen->jenis_kelamin == 'Perempuan' ? 'from-pink-500/5 to-rose-500/5' : 'from-blue-500/5 to-indigo-500/5' }} pointer-events-none"></div>
        
        <div class="relative flex items-start justify-between mb-4">
            <div class="flex items-center space-x-4">
                <input type="checkbox" name="mobile_ids[]" value="{{ $absen->id }}" class="mobile-checkbox w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                <div class="relative">
                    <div class="w-14 h-14 rounded-2xl {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-gradient-to-br from-pink-400 to-rose-500' : 'bg-gradient-to-br from-blue-400 to-indigo-500' }} flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 {{ $absen->jenis_status == 'Hadir' ? 'bg-emerald-500' : 'bg-red-500' }} rounded-full border-2 border-white flex items-center justify-center">
                        @if($absen->jenis_status == 'Hadir')
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-slate-900 mb-1">{{ $absen->nama_murid }}</h4>
                    <p class="text-sm {{ $absen->jenis_kelamin == 'Perempuan' ? 'text-pink-600' : 'text-blue-600' }} font-medium">
                        {{ $absen->jenis_kelamin }}
                    </p>
                </div>
            </div>
            
            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $absen->jenis_status == 'Hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                    {{ $absen->jenis_status }}
            </span>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-white/50 rounded-xl p-3">
                <span class="text-xs text-slate-500 font-medium">Jenis Bacaan</span>
                <p class="text-sm font-semibold text-indigo-600 mt-1">{{ $absen->jenis_bacaan }}</p>
            </div>
            <div class="bg-white/50 rounded-xl p-3">
                <span class="text-xs text-slate-500 font-medium">Tanggal</span>
                <p class="text-sm font-semibold text-slate-700 mt-1">{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d/m/Y') }}</p>
            </div>
        </div>
        
        @if($absen->catatan)
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mb-4">
            <span class="text-xs text-amber-700 font-medium">Catatan</span>
            <p class="text-sm text-amber-800 mt-1">{{ $absen->catatan }}</p>
        </div>
        @endif

        <div class="flex space-x-3">
            <a href="{{ route('pengajar.muridAbsensi.edit', $absen->id) }}" 
            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded-xl text-sm font-medium transition-colors duration-200">
                Edit
            </a>
            <form action="{{ route('pengajar.muridAbsensi.destroy', $absen->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-xl text-sm font-medium transition-colors duration-200">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>


            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50/80 backdrop-blur-sm">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Murid</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Kelamin</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Bacaan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Catatan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($absensis as $absen)
                        <tr class="hover:bg-slate-50/50 transition-all duration-200 group">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="ids[]" value="{{ $absen->id }}" class="row-checkbox w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-xl {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-gradient-to-br from-pink-400 to-rose-500' : 'bg-gradient-to-br from-blue-400 to-indigo-500' }} flex items-center justify-center shadow-md">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 {{ $absen->jenis_status == 'Hadir' ? 'bg-emerald-500' : 'bg-red-500' }} rounded-full border-2 border-white"></div>
                                    </div>
                                    <div>
                                        <span class="text-sm font-semibold text-slate-900">{{ $absen->nama_murid }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-pink-100 text-pink-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $absen->jenis_kelamin }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-indigo-600">{{ $absen->jenis_bacaan }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $absen->jenis_status == 'Hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $absen->jenis_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($absen->catatan)
                                    <div class="max-w-xs">
                                        <p class="text-xs text-slate-600 truncate bg-amber-50 px-2 py-1 rounded" title="{{ $absen->catatan }}">
                                            {{ $absen->catatan }}
                                        </p>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400">Tidak ada catatan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <a href="{{ route('pengajar.muridAbsensi.edit', $absen->id) }}" 
                                        class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs rounded-lg transition-colors duration-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('pengajar.muridAbsensi.destroy', $absen->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded-lg transition-colors duration-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20">
            {{ $absensis->links('pagination::simple-tailwind') }}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Select all checkbox functionality
    const selectAll = document.getElementById('selectAll');
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = selectAll.checked);
            document.querySelectorAll('.mobile-checkbox').forEach(cb => cb.checked = selectAll.checked);
        });
    }

    // Smooth animations for cards
    const cards = document.querySelectorAll('.group');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in');
    });
});

// Toggle bulk actions
function toggleBulkActions() {
    const bulkActions = document.getElementById('bulkActions');
    const bulkActionBtn = document.getElementById('bulkActionBtn');
    
    if (bulkActions.classList.contains('hidden')) {
        bulkActions.classList.remove('hidden');
        bulkActionBtn.textContent = 'Tutup Aksi';
        bulkActionBtn.classList.add('bg-white/30');
    } else {
        bulkActions.classList.add('hidden');
        bulkActionBtn.textContent = 'Aksi Massal';
        bulkActionBtn.classList.remove('bg-white/30');
    }
}

// Bulk delete function
function bulkDelete() {
    const checkboxes = document.querySelectorAll('.row-checkbox:checked, .mobile-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Pilih data yang ingin dihapus terlebih dahulu!');
        return;
    }
    
    if (confirm('Yakin ingin menghapus data terpilih?')) {
        const form = document.getElementById('bulkDeleteForm');
        const idsContainer = document.getElementById('bulkDeleteIds');
        idsContainer.innerHTML = '';
        
        checkboxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = checkbox.value;
            idsContainer.appendChild(input);
        });
        
        form.submit();
    }
}

// Delete all function
function deleteAll() {
    if (confirm('Yakin ingin menghapus semua data?')) {
        document.getElementById('deleteAllForm').submit();
    }
}

// Clear filters function
function clearFilters() {
    const selects = document.querySelectorAll('select');
    selects.forEach(select => select.value = '');
    selects[0].form.submit();
}


</script>


@endsection