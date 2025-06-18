@extends('components.layouts.pengajar.sidebar')
    @section('sidebar-pengajar')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl mb-8 p-6 lg:p-8">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Form Absensi Murid</h1>
                    <p class="text-gray-600 mt-1">Kelola kehadiran murid dengan mudah</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Pemilihan Murid -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Pilih Murid
                    </h3>
                    
                    <form method="GET" action="{{ route('pengajar.muridAbsensi.create') }}">
                        <div class="relative">
                            <select name="nama_murid" id="nama_murid" 
                                    class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 appearance-none bg-white" 
                                    onchange="this.form.submit()">
                                <option value="">-- Pilih Murid --</option>
                                @foreach($murids as $murid)
                                    <option value="{{ $murid->nama_anak }}" 
                                            {{ request('nama_murid') == $murid->nama_anak ? 'selected' : '' }}>
                                        {{ $murid->nama_anak }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </form>

                    <!-- Informasi Tanggal -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                        @php
                            use Carbon\Carbon;
                            Carbon::setLocale('id');
                            $hariIni = Carbon::now()->translatedFormat('l, d F Y');
                        @endphp
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Hari Ini</p>
                                <p class="text-sm text-blue-600">{{ $hariIni }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Absensi Utama -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-6 lg:p-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Form Absensi
                    </h3>

                    <form action="{{ route('pengajar.muridAbsensi.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Informasi Murid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Murid -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Murid</label>
                                <input type="text" 
                                        name="nama_murid" 
                                        value="{{ request('nama_murid') }}" 
                                        class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50" 
                                        readonly required>
                            </div>

                            <!-- Jenis Kelamin dengan Conditional Styling -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                                @php
                                    $jenisKelamin = $selectedMurid->jenis_kelamin ?? '';
                                    $bgColor = '';
                                    $borderColor = '';
                                    $textColor = '';
                                    
                                    if (strtolower($jenisKelamin) === 'perempuan') {
                                        $bgColor = 'bg-pink-50';
                                        $borderColor = 'border-pink-300';
                                        $textColor = 'text-pink-800';
                                    } elseif (strtolower($jenisKelamin) === 'laki-laki') {
                                        $bgColor = 'bg-sky-50';
                                        $borderColor = 'border-sky-300';
                                        $textColor = 'text-sky-800';
                                    } else {
                                        $bgColor = 'bg-gray-50';
                                        $borderColor = 'border-gray-200';
                                        $textColor = 'text-gray-800';
                                    }
                                @endphp
                                <input type="text" 
                                        name="jenis_kelamin" 
                                        value="{{ $jenisKelamin }}" 
                                        class="w-full p-3 border-2 {{ $borderColor }} {{ $bgColor }} {{ $textColor }} rounded-xl font-medium" 
                                        readonly required>
                            </div>
                        </div>

                        <!-- Jenis Bacaan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Bacaan</label>
                            <input type="text" 
                                    name="jenis_bacaan" 
                                    value="{{ $selectedMurid->jenis_alkitab ?? '' }}" 
                                    class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50" 
                                    readonly required>
                        </div>

                        <!-- Status dan Tanggal -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Status Kehadiran -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Kehadiran</label>
                                <div class="relative">
                                    <select name="jenis_status" 
                                            class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 appearance-none bg-white" 
                                            required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="hadir">✅ Hadir</option>
                                        <option value="izin">📝 Izin</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Absen -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Absen</label>
                                <input type="date" 
                                        name="tanggal_absen" 
                                        class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200" 
                                        value="{{ date('Y-m-d') }}" 
                                        required>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
                            <textarea name="catatan" 
                                        class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none" 
                                        rows="4" 
                                        placeholder="Jelaskan Iqro Halaman berapa atau Al-Qur'an Surah dan Ayat berapa..."
                                        required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-105 focus:ring-4 focus:ring-blue-100">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Absensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
    @media (max-width: 768px) {
    .grid-cols-1 {
        grid-template-columns: 1fr;
    }
    }

    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
    width: 6px;
    }

    ::-webkit-scrollbar-track {
    background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
    }

    /* Focus states for better accessibility */
    input:focus, select:focus, textarea:focus {
    outline: none;
    }

    /* Smooth transitions */
    * {
    transition: all 0.2s ease-in-out;
    }
    </style>

    @endsection