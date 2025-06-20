@extends('components.user.navbar')

@section('navbar-user')

<!-- Hero Section dengan Visi & Misi -->
<section class="relative py-20 bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 overflow-hidden" id="visi-misi">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 bg-emerald-200 rounded-full"></div>
        <div class="absolute bottom-20 right-20 w-24 h-24 bg-green-200 rounded-full"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-teal-200 rounded-full"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Selamat Datang di 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    TPA Nurul Haq
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tempat terbaik untuk pendidikan dan pembentukan karakter islami anak-anak Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Visi Card -->
            <div x-data="{ open: true }" class="group">
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl overflow-hidden border border-emerald-100 hover:shadow-2xl transition-all duration-300">
                    <button @click="open = !open" 
                            class="w-full px-8 py-6 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold text-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 flex items-center justify-between">
                        <span class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            VISI KAMI
                        </span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="px-8 py-6">
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Menjadikan TPA rumah kedua sebagai pusat pembelajaran yang inspiratif, tempat anak-anak tumbuh cerdas, berakhlak mulia, dan berani berinovasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Misi Card -->
            <div x-data="{ open: true }" class="group">
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl overflow-hidden border border-emerald-100 hover:shadow-2xl transition-all duration-300">
                    <button @click="open = !open" 
                            class="w-full px-8 py-6 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold text-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 flex items-center justify-between">
                        <span class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            MISI KAMI
                        </span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="px-8 py-6">
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Memberikan edukasi ilmu pengetahuan seperti matematika, IPA, IPS dll</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Membangun kreatifitas, berpikir kritis, berlogika</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Mempelajari adab, etika dan moral</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Membaca alkitab iqro atau Al-Qur'an</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-50 rounded-2xl p-6 shadow-inner">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <!-- Jumlah Murid -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Murid Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $jumlah_murid }}</p>
                    </div>
                </div>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('user.informasi.index') }}" class="w-full lg:w-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama murid..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        </div>

                        <select name="jenis_kelamin" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="">Semua Gender</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>

                        <select name="kelas" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelas_list as $kelas)
                                <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                            @endforeach
                        </select>

                        <select name="jenis_bacaan" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="">Semua Bacaan</option>
                            <option value="Iqro" {{ request('jenis_bacaan') == 'Iqro' ? 'selected' : '' }}>Iqro</option>
                            <option value="al-quran" {{ request('jenis_bacaan') == "Al-Qur'an" ? 'selected' : '' }}>Al-Qur'an</option>
                        </select>

                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-600 transition-all duration-200 flex items-center justify-center gap-2 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"/>
                            </svg>
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Data Murid Section -->
<section id="informasi-murid" class="py-16 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-700 mb-4">Informasi Murid TPA</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Lihat informasi lengkap tentang murid-murid yang terdaftar di TPA Nurul Haq</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-500">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Nama Murid
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                                    </svg>
                                    Jenis Kelamin
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Foto
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Kelas
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Jenis Bacaan
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($murids as $murid)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $murid->nama_anak }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $murid->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                        {{ $murid->jenis_kelamin === 'Laki-laki' ? '👦' : '👧' }} {{ $murid->jenis_kelamin }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($murid->foto_anak)
                                        <img src="{{ asset('storage/' . $murid->foto_anak) }}" 
                                             class="h-14 w-14 rounded-full object-cover border-2 border-emerald-200 shadow-md hover:scale-105 transition-transform duration-200">
                                    @else
                                        <div class="h-14 w-14 rounded-full bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center text-white font-bold text-lg shadow-md hover:scale-105 transition-transform duration-200">
                                            {{ strtoupper(substr($murid->nama_anak, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                        📚 {{ $murid->kelas }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        📖 {{ $murid->jenis_alkitab }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">Belum ada data murid</p>
                                        <p class="text-gray-400 text-sm">Coba ubah filter pencarian Anda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $murids->links('pagination::simple-tailwind') }}
        </div>
    </div>
</section>

<!-- Pengajar Section -->
<section id="pengajar" class="py-16 bg-gradient-to-br from-emerald-50 to-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    Para Pengajar Kami
                </span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Bertemu dengan tim pengajar berpengalaman yang mendedikasikan diri untuk pendidikan putra-putri Anda</p>
        </div>

        <div class="relative">
            <div class="overflow-x-auto scrollbar-hide pb-4">
                <div class="flex space-x-6 w-max px-4">
                    @foreach ($pengajars as $pengajar)
                        <div class="min-w-[300px] max-w-[320px] group">
                            <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl p-6 border border-emerald-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                                <!-- Header Card -->
                                <div class="flex items-center space-x-4 mb-6">
                                    @if($pengajar->foto_pengajar)
                                        <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                            alt="foto" class="h-16 w-16 rounded-2xl object-cover border-3 border-emerald-200 shadow-lg group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                                            {{ strtoupper(substr($pengajar->nama_pengajar, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 text-lg mb-1">
                                            {{ $pengajar->nama_pengajar }}
                                        </h3>
                                        <div class="flex items-center text-blue-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            <span class="text-sm font-medium">Pengajar TPA</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Deskripsi -->
                                <div class="bg-gray-50 rounded-2xl p-4">
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $pengajar->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="flex justify-center mt-4 space-x-2">
                <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                <div class="w-8 h-2 bg-emerald-500 rounded-full"></div>
                <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
            </div>
        </div>
    </div>
</section>

<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

@endsection