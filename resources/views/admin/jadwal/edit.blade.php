@extends('components.layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Edit Jadwal</h1>
            <p class="text-gray-600 text-lg">Perbarui informasi jadwal dengan mudah</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Form Edit Jadwal
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nama Jadwal -->
                    <div class="space-y-2">
                        <label for="nama_jadwal" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Nama Jadwal
                        </label>
                        <input 
                            type="text" 
                            id="nama_jadwal"
                            name="nama_jadwal" 
                            value="{{ $jadwal->nama_jadwal }}" 
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-700 placeholder-gray-400 bg-white/50"
                            placeholder="Masukkan nama jadwal"
                        >
                    </div>

                    <!-- Tanggal Jadwal -->
                    <div class="space-y-2">
                        <label for="tanggal_jadwal" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Tanggal Jadwal
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_jadwal"
                            name="tanggal_jadwal" 
                            value="{{ $jadwal->tanggal_jadwal }}" 
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-700 bg-white/50"
                        >
                    </div>

                    <!-- Pukul Jadwal -->
                    <div class="space-y-2">
                        <label for="pukul_jadwal" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Waktu
                        </label>
                        <input 
                            type="text" 
                            id="pukul_jadwal"
                            name="pukul_jadwal" 
                            value="{{ $jadwal->pukul_jadwal }}" 
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-700 placeholder-gray-400 bg-white/50"
                            placeholder="Contoh: 08:00 - 10:00"
                        >
                    </div>

                    <!-- Nama Pengajar -->
                    <div class="space-y-2">
                        <label for="nama_pengajar_jadwal" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Nama Pengajar
                        </label>
                        <input 
                            type="text" 
                            id="nama_pengajar_jadwal"
                            name="nama_pengajar_jadwal" 
                            value="{{ $jadwal->nama_pengajar_jadwal }}" 
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-700 placeholder-gray-400 bg-white/50"
                            placeholder="Masukkan nama pengajar"
                        >
                    </div>
                </div>

                <!-- Kegiatan Jadwal - Full Width -->
                <div class="space-y-2">
                    <label for="kegiatan_jadwal" class="block text-sm font-semibold text-gray-700 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Kegiatan Jadwal
                    </label>
                    <textarea 
                        id="kegiatan_jadwal"
                        name="kegiatan_jadwal" 
                        required
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-700 placeholder-gray-400 bg-white/50 resize-y"
                        placeholder="Deskripsikan kegiatan yang akan dilakukan..."
                    >{{ $jadwal->kegiatan_jadwal }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                    <button 
                        type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg flex items-center justify-center space-x-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        <span>Update Jadwal</span>
                    </button>
                    
                    <a 
                        href="{{ route('admin.jadwal.index') }}" 
                        class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 border border-gray-200"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-8 bg-blue-50/80 backdrop-blur-sm border border-blue-100 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-blue-800 mb-1">Tips Pengisian Form</h3>
                    <p class="text-sm text-blue-700 leading-relaxed">
                        Pastikan semua field telah diisi dengan benar. Gunakan format waktu yang konsisten untuk memudahkan pembacaan jadwal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Custom focus ring animation */
    input:focus, textarea:focus {
        animation: focusRing 0.3s ease-out;
    }

    @keyframes focusRing {
        0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5); }
        70% { box-shadow: 0 0 0 6px rgba(59, 130, 246, 0.1); }
        100% { box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition: all 0.2s ease;
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