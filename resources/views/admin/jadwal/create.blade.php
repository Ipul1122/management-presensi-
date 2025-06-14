@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Jadwal</h1>
            </div>
            <p class="text-gray-600">Buat jadwal baru untuk kegiatan pembelajaran</p>
        </div>

        <!-- Warning Message -->
        @if($pengajars->isEmpty())
            <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-400 p-4 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-amber-800">
                            <span class="font-medium">Perhatian!</span> Belum ada data pengajar. Silakan 
                            <a href="{{ route('admin.pengajar.create') }}" class="font-medium text-blue-600 hover:text-blue-500 underline decoration-2 underline-offset-2 transition-colors duration-200">tambahkan pengajar</a> 
                            terlebih dahulu.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Informasi Jadwal</h2>
                <p class="text-blue-100 text-sm mt-1">Lengkapi semua field yang diperlukan</p>
            </div>
            
            <form method="POST" action="{{ route('admin.jadwal.store') }}" class="p-6 space-y-6">
                @csrf
                
                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nama Jadwal -->
                    <div class="space-y-2">
                        <label for="nama_jadwal" class="block text-sm font-semibold text-gray-700">
                            Nama Jadwal
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="nama_jadwal" 
                                id="nama_jadwal"
                                placeholder="Masukkan nama jadwal" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Jadwal -->
                    <div class="space-y-2">
                        <label for="tanggal_jadwal" class="block text-sm font-semibold text-gray-700">
                            Tanggal Jadwal
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                name="tanggal_jadwal" 
                                id="tanggal_jadwal"
                                required
                                class="w-full px-4 py-3 border border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pukul Jadwal -->
                    <div class="space-y-2">
                        <label for="pukul_jadwal" class="block text-sm font-semibold text-gray-700">
                            Waktu Jadwal
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="pukul_jadwal" 
                                id="pukul_jadwal"
                                placeholder="Contoh: 08:00 - 10:00" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pengajar -->
                    <div class="space-y-2">
                        <label for="nama_pengajar_jadwal" class="block text-gray-700 font-bold mb-2">Nama Pengajar</label>
                        <div class="relative">
                        @foreach($pengajars as $pengajar)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="nama_pengajar_jadwal[]" value="{{ $pengajar->nama_pengajar }}"
                                class="form-checkbox text-blue-600">
                                <span class="ml-2">{{ $pengajar->nama_pengajar }}</span>
                            </label>
                        @endforeach
                        </div>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan Jadwal (Full Width) -->
                <div class="space-y-2">
                    <label for="kegiatan_jadwal" class="block text-sm font-semibold text-gray-700">
                        Kegiatan Jadwal
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea 
                            name="kegiatan_jadwal" 
                            id="kegiatan_jadwal"
                            placeholder="Deskripsikan kegiatan yang akan dilakukan dalam jadwal ini..." 
                            required
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white resize-none"
                        ></textarea>
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <button 
                        type="button" 
                        onclick="history.back()" 
                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200"
                    >
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </div>
                    </button>
                    
                    <button 
                        type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" 
                        {{ $pengajars->isEmpty() ? 'disabled' : '' }}
                    >
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Simpan Jadwal</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Additional CSS for better mobile experience -->
<style>
    @media (    max-width: 640px) {
        .min-h-screen {
            padding: 1rem;
        }
        
        .grid-cols-1 {
            grid-template-columns: 1fr;
        }
        
        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }
    }
    
    /* Custom focus states */
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Smooth animations */
    * {
        transition: all 0.2s ease-in-out;
    }
    
    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 6px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

@endsection