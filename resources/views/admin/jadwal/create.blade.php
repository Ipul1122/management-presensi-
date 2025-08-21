@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')

<style>
    @media (max-width: 640px) {
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
    
    /* Enhanced focus states */
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
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
    
    /* Custom checkbox styling */
    .custom-checkbox {
        appearance: none;
        width: 1rem;
        height: 1rem;
        border: 2px solid #d1d5db;
        border-radius: 0.25rem;
        background: white;
        position: relative;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    
    .custom-checkbox:checked {
        background: #3b82f6;
        border-color: #3b82f6;
    }
    
    .custom-checkbox:checked::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 0.75rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .custom-checkbox:hover {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }
    
    /* Teacher card animations */
    .teacher-card {
        transform: translateY(0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .teacher-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }
    
    /* Enhanced form animations */
    .jadwal-item {
        animation: fadeInUp 0.3s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Button hover effects */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        transform: translateY(0);
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.35);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        transform: translateY(0);
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
    }
    
    /* Loading animation for buttons */
    .loading {
        position: relative;
        pointer-events: none;
    }
    
    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -8px 0 0 -8px;
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top: 2px solid #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Enhanced Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Jadwal</h1>
                        <p class="text-gray-600 text-sm">Buat jadwal baru untuk kegiatan pembelajaran</p>
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-sm text-gray-500">
                    <a href="#" class="hover:text-blue-600 transition-colors">Dashboard</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="#" class="hover:text-blue-600 transition-colors">Jadwal</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">Tambah</span>
                </nav>
            </div>
        </div>

        <!-- Enhanced Warning Message -->
        @if($pengajars->isEmpty())
            <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-400 rounded-xl shadow-lg">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-sm font-medium text-amber-800 mb-1">Perhatian!</h3>
                            <p class="text-sm text-amber-700">
                                Belum ada data pengajar tersedia. Silakan 
                                <a href="{{ route('admin.pengajar.create') }}" class="font-semibold text-blue-600 hover:text-blue-700 underline decoration-2 underline-offset-2 transition-all duration-200 hover:decoration-blue-700">
                                    tambahkan pengajar
                                </a> 
                                terlebih dahulu untuk melanjutkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Main Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Enhanced Header -->
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 px-6 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white mb-1">Informasi Jadwal</h2>
                        <p class="text-blue-100 text-sm">Lengkapi semua field yang diperlukan dengan teliti</p>
                    </div>
                    <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Form -->
            <form method="POST" action="{{ route('admin.jadwal.store') }}" class="p-8 space-y-8" id="scheduleForm">
                @csrf

                <div id="jadwal-container" class="space-y-8">
                    <!-- Enhanced Jadwal Block -->
                    <div class="jadwal-item border-2 border-gray-200 rounded-2xl p-6 relative bg-gradient-to-br from-gray-50 to-white shadow-lg hover:shadow-xl transition-all duration-300">
                        <button type="button" class="remove-jadwal absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-200 shadow-lg hidden group">
                            <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Enhanced Nama Jadwal -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Nama Jadwal
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="nama_jadwal[]" placeholder="Masukkan nama jadwal" required
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl bg-white hover:border-blue-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200 text-gray-900 placeholder-gray-400">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Tanggal Jadwal -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Tanggal Jadwal
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <input type="date" name="tanggal_jadwal[]" required
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl bg-white hover:border-blue-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200 text-gray-900">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Pukul Jadwal -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Waktu Jadwal
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="pukul_jadwal[]" 
                                        value="16:00 - 17:00" 
                                        readonly 
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-700 cursor-not-allowed"
                                    />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Waktu default untuk semua jadwal
                                </p>
                            </div>

                            <!-- Enhanced Pengajar Section -->
                            <div class="space-y-3 lg:col-span-1">
                                <label class="flex items-center text-sm font-semibold text-gray-700 mb-4">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    Nama Pengajar
                                    <span class="text-xs font-normal text-gray-500 ml-2">(Pilih satu atau lebih)</span>
                                </label>
                                
                                @if($pengajars->isEmpty())
                                    <div class="text-sm text-gray-500 italic bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-xl border-2 border-gray-200 flex items-center justify-center min-h-[100px]">
                                        <div class="text-center">
                                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                            </svg>
                                            <p>Belum ada data pengajar tersedia</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="max-h-64 overflow-y-auto pr-2 space-y-2" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 #f1f5f9;">
                                        @foreach($pengajars as $pengajar)
                                            <label class="teacher-card flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 cursor-pointer group bg-white">
                                                <input 
                                                    type="checkbox" 
                                                    name="nama_pengajar_jadwal[0][]" 
                                                    value="{{ $pengajar->nama_pengajar }}"
                                                    class="custom-checkbox mr-4 flex-shrink-0"
                                                >
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-sm font-medium text-gray-900 group-hover:text-blue-700 transition-colors duration-200 truncate">
                                                            {{ $pengajar->nama_pengajar }}
                                                        </span>
                                                        <div class="w-2 h-2 bg-blue-600 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 ml-3 flex-shrink-0"></div>
                                                    </div>
                                                    @if(isset($pengajar->bidang_keahlian))
                                                        <div class="text-xs text-gray-500 mt-1 flex items-center">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                            </svg>
                                                            {{ $pengajar->bidang_keahlian }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Enhanced Select All / Deselect All buttons -->
                                    <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-200">
                                        <button 
                                            type="button" 
                                            onclick="toggleAllCheckboxes(this, true)"
                                            class="flex items-center text-xs px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-200 border border-blue-200 hover:border-blue-300"
                                        >
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Pilih Semua
                                        </button>
                                        <button 
                                            type="button" 
                                            onclick="toggleAllCheckboxes(this, false)"
                                            class="flex items-center text-xs px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 border border-gray-200 hover:border-gray-300"
                                        >
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Batal Pilih Semua
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Enhanced Kegiatan Section -->
                        <div class="mt-6 space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Kegiatan Jadwal
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="kegiatan_jadwal[]" rows="4" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl bg-white hover:border-blue-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200 text-gray-900 placeholder-gray-400 resize-none"
                                    placeholder="Deskripsikan kegiatan pembelajaran yang akan dilakukan..."></textarea>
                                <div class="absolute bottom-3 right-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Jelaskan secara detail kegiatan yang akan dilakukan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Add Schedule Button -->
                <div class="flex justify-center">
                    <button type="button" id="add-jadwal" 
                        class="btn-secondary flex items-center px-6 py-3 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Jadwal Lain
                    </button>
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-8 border-t-2 border-gray-100">
                    <button type="button" onclick="history.back()" 
                        class="flex items-center justify-center px-6 py-3 border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 text-gray-700 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </button>
                    <button type="submit" id="submitBtn"
                        class="btn-primary flex items-center justify-center px-8 py-3 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105 min-w-[140px]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="submit-text">Simpan Jadwal</span>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Enhanced Progress Indicator -->
        <div class="mt-6 bg-white rounded-xl p-4 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Total Jadwal: <span id="schedule-count" class="font-semibold text-blue-600 ml-1">1</span>
                </span>
                <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-medium">
                    Draft
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('jadwal-container');
    const addBtn = document.getElementById('add-jadwal');
    const scheduleCountElement = document.getElementById('schedule-count');
    const form = document.getElementById('scheduleForm');
    const submitBtn = document.getElementById('submitBtn');

    // Function to update schedule count
    function updateScheduleCount() {
        const count = container.querySelectorAll('.jadwal-item').length;
        scheduleCountElement.textContent = count;
        
        // Update button text based on count
        if (count > 1) {
            addBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Jadwal Lagi (${count})
            `;
        } else {
            addBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Jadwal Lain
            `;
        }
    }

    // Add new schedule
    addBtn.addEventListener('click', function() {
        const firstJadwal = container.querySelector('.jadwal-item');
        const newJadwal = firstJadwal.cloneNode(true);
        const currentIndex = container.querySelectorAll('.jadwal-item').length;

        // Reset all inputs and textareas
        newJadwal.querySelectorAll('input, textarea').forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else if (input.name === 'pukul_jadwal[]') {
                input.value = '16:00 - 17:00';
            } else if (input.type !== 'button') {
                input.value = '';
            }
        });

        // Update checkbox names with new index
        newJadwal.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.name = `nama_pengajar_jadwal[${currentIndex}][]`;
        });

        // Show remove button
        const removeBtn = newJadwal.querySelector('.remove-jadwal');
        removeBtn.classList.remove('hidden');
        
        // Add enhanced remove button functionality
        removeBtn.innerHTML = `
            <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        `;

        // Add animation class
        newJadwal.style.opacity = '0';
        newJadwal.style.transform = 'translateY(20px)';
        
        container.appendChild(newJadwal);
        
        // Animate in
        setTimeout(() => {
            newJadwal.style.opacity = '1';
            newJadwal.style.transform = 'translateY(0)';
        }, 50);

        // Scroll to new item
        newJadwal.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        updateScheduleCount();
        
        // Focus on first input of new schedule
        setTimeout(() => {
            const firstInput = newJadwal.querySelector('input[name="nama_jadwal[]"]');
            if (firstInput) firstInput.focus();
        }, 300);
    });

    // Remove schedule with animation
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-jadwal')) {
            const jadwalItem = e.target.closest('.jadwal-item');
            const scheduleCount = container.querySelectorAll('.jadwal-item').length;
            
            if (scheduleCount > 1) {
                // Add confirmation
                if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
                    // Animate out
                    jadwalItem.style.transform = 'translateX(100%)';
                    jadwalItem.style.opacity = '0';
                    
                    setTimeout(() => {
                        jadwalItem.remove();
                        updateScheduleCount();
                        
                        // Re-index remaining checkboxes
                        container.querySelectorAll('.jadwal-item').forEach((item, index) => {
                            item.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                                checkbox.name = `nama_pengajar_jadwal[${index}][]`;
                            });
                        });
                    }, 300);
                }
            }
        }
    });

    // Enhanced form validation
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('input[required], textarea[required]');
        let isValid = true;
        let firstInvalidField = null;

        // Add loading state to submit button
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        submitBtn.querySelector('.submit-text').textContent = 'Menyimpan...';

        // Validate each required field
        requiredFields.forEach(field => {
            const value = field.type === 'checkbox' ? field.checked : field.value.trim();
            
            if (!value) {
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
                
                // Add error styling
                field.classList.add('border-red-500', 'bg-red-50');
                field.classList.remove('border-gray-300');
                
                // Remove error styling on input
                field.addEventListener('input', function() {
                    this.classList.remove('border-red-500', 'bg-red-50');
                    this.classList.add('border-gray-300');
                }, { once: true });
            }
        });

        if (!isValid) {
            e.preventDefault();
            
            // Reset submit button
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
            submitBtn.querySelector('.submit-text').textContent = 'Simpan Jadwal';
            
            // Show error message
            showNotification('Mohon lengkapi semua field yang diperlukan!', 'error');
            
            // Focus on first invalid field
            if (firstInvalidField) {
                firstInvalidField.focus();
                firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            // Show success notification
            showNotification('Jadwal sedang disimpan...', 'success');
        }
    });

    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full ${
            type === 'error' ? 'bg-red-500 text-white' : 
            type === 'success' ? 'bg-green-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        
        notification.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${type === 'error' ? 
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
                    }
                </svg>
                ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Animate out and remove
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Initialize
    updateScheduleCount();
});

// Enhanced toggle function for checkboxes
function toggleAllCheckboxes(button, selectAll) {
    const jadwalItem = button.closest('.jadwal-item');
    const checkboxes = jadwalItem.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll;
        
        // Add visual feedback
        const label = checkbox.closest('label');
        if (selectAll) {
            label.classList.add('border-blue-400', 'bg-blue-50');
        } else {
            label.classList.remove('border-blue-400', 'bg-blue-50');
        }
    });
    
    // Update button states
    const selectAllBtn = jadwalItem.querySelector('button[onclick*="true"]');
    const deselectAllBtn = jadwalItem.querySelector('button[onclick*="false"]');
    
    if (selectAll) {
        selectAllBtn.classList.add('bg-blue-200', 'border-blue-300');
        deselectAllBtn.classList.remove('bg-gray-200', 'border-gray-300');
    } else {
        deselectAllBtn.classList.add('bg-gray-200', 'border-gray-300');
        selectAllBtn.classList.remove('bg-blue-200', 'border-blue-300');
    }
}

// Enhanced auto-save functionality (optional)
document.addEventListener('input', function(e) {
    if (e.target.matches('input, textarea')) {
        // Add subtle indication that content is being auto-saved
        e.target.style.boxShadow = '0 0 0 2px rgba(34, 197, 94, 0.2)';
        setTimeout(() => {
            e.target.style.boxShadow = '';
        }, 500);
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S to save
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        document.getElementById('submitBtn').click();
    }
    
    // Ctrl/Cmd + N to add new schedule
    if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
        e.preventDefault();
        document.getElementById('add-jadwal').click();
    }
});
</script>

@endsection