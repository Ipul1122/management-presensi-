@extends('components.user.navbar')

@section('navbar-user')

    {{-- Import Font Quicksand & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8fafc;
        }
        /* Custom Table Scrollbar */
        .table-scroll::-webkit-scrollbar {
            height: 8px;
        }
        .table-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .table-scroll::-webkit-scrollbar-thumb {
            background: #10b981; 
            border-radius: 4px;
        }
    </style>

    {{-- 1. HERO SECTION --}}
    <div class="relative bg-emerald-600 pt-24 pb-32 rounded-b-[3rem] shadow-xl overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s"></div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Data Murid TPA</h1>
            <p class="text-emerald-100 text-lg md:text-xl max-w-2xl mx-auto font-medium">
                Daftar lengkap santri TPA Nurul Haq yang sedang menimba ilmu.
            </p>
        </div>
    </div>

    {{-- 2. STATS & FILTER SECTION --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 mb-12">
        <div class="bg-white rounded-3xl shadow-xl border border-emerald-50 p-6 md:p-8">
            
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                
                {{-- Stats Card --}}
                <div class="flex items-center gap-5 w-full lg:w-auto bg-emerald-50 p-4 rounded-2xl border border-emerald-100">
                    <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-sm text-emerald-600 text-2xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total Murid</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $jumlah_murid }} <span class="text-sm font-normal text-gray-400">Murid</span></p>
                    </div>
                </div>

                {{-- Filter Form --}}
                <form method="GET" action="{{ route('user.informasi.dataMurid.index') }}" class="w-full lg:flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        {{-- Search Input --}}
                        <div class="relative lg:col-span-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all text-sm">
                        </div>

                        {{-- Filter Jenis Kelamin --}}
                        <div class="relative">
                            <select name="jenis_kelamin" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all text-sm appearance-none cursor-pointer">
                                <option value="">Semua Gender</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        {{-- Filter Kelas --}}
                        <div class="relative">
                            <select name="kelas" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all text-sm appearance-none cursor-pointer">
                                <option value="">Semua Kelas</option>
                                @foreach ($kelas_list as $kelas)
                                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        {{-- Filter Bacaan --}}
                        <div class="relative">
                            <select name="jenis_bacaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all text-sm appearance-none cursor-pointer">
                                <option value="">Semua Bacaan</option>
                                <option value="iqro" {{ strtolower(request('jenis_bacaan')) == 'iqro' ? 'selected' : '' }}>Iqro</option>
                                <option value="al-quran" {{ strtolower(request('jenis_bacaan')) == "al-qur'an" ? 'selected' : '' }}>Al-Qur'an</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="lg:col-span-4 bg-emerald-600 text-white py-3 rounded-xl hover:bg-emerald-700 transition-all shadow-md font-semibold flex items-center justify-center gap-2">
                            <i class="fas fa-filter"></i> Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 3. DATA TABLE SECTION --}}
    <section id="informasi-murid" class="pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto table-scroll">
                    <table class="min-w-full divide-y divide-emerald-100">
                        <thead>
                            <tr class="bg-emerald-50/80 text-emerald-800">
                                <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Santri</th>
                                <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Gender</th>
                                <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Bacaan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($murids as $murid)
                                <tr class="hover:bg-emerald-50/30 transition-colors duration-200 group">
                                    {{-- Nama --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-bold text-gray-800 text-base group-hover:text-emerald-700 transition-colors">
                                                {{ $murid->nama_anak }}
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Gender --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($murid->jenis_kelamin === 'Laki-laki')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 border border-blue-200">
                                                <i class="fas fa-mars mr-1.5"></i> Laki-laki
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-700 border border-pink-200">
                                                <i class="fas fa-venus mr-1.5"></i> Perempuan
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Foto --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="relative w-12 h-12">
                                            @if($murid->foto_anak)
                                                <img src="{{ asset('storage/' . $murid->foto_anak) }}" 
                                                    alt="{{ $murid->nama_anak }}"
                                                    class="w-full h-full rounded-full object-cover border-2 border-emerald-100 shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-lg shadow-sm border-2 border-white group-hover:scale-110 transition-transform duration-300">
                                                    {{ strtoupper(substr($murid->nama_anak, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kelas --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 text-xs">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">{{ $murid->kelas }}</span>
                                        </div>
                                    </td>

                                    {{-- Jenis Bacaan --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <i class="fas fa-book-open text-xs"></i>
                                            {{ $murid->jenis_alkitab }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400 text-3xl">
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-800">Murid Tidak Ditemukan</h3>
                                            <p class="text-gray-500 mt-1 mb-4 text-sm">Coba ubah kata kunci atau filter pencarian Anda.</p>
                                            <a href="{{ route('user.informasi.dataMurid.index') }}" class="text-emerald-600 font-semibold hover:underline text-sm">
                                                Reset Pencarian
                                            </a>
                                            
                                            <div class="mt-6 pt-6 border-t border-gray-100 w-full max-w-xs">
                                                <p class="text-xs text-gray-400 mb-2">Butuh bantuan?</p>
                                                <a href="https://wa.me/6285693672730" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-xs font-bold hover:bg-green-100 transition">
                                                    <i class="fab fa-whatsapp mr-2"></i> Hubungi Admin
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($murids->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-center">
                        {{ $murids->links('pagination::simple-tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection