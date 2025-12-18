@extends('components.layouts.pengajar.sidebar')
@extends('components.layouts.pengajar.navbar')

@section('sidebar-pengajar')
@section('navbar-pengajar')

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 min-h-screen">
        <div class="p-4 sm:p-6 lg:p-8 space-y-8">
            
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-lg shadow-blue-500/20">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-2">Selamat Datang!</h2>
                    <p class="text-blue-100 text-lg opacity-90">Kelola aktivitas pembelajaran dengan mudah dan efisien.</p>
                </div>
            </div>

            <div>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3">Aksi Cepat</h3>
    </div>

    {{-- Grid Container Utama (Digabung agar lebih rapi, atau bisa dipisah jika perlu) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        
        {{-- CARD 1: Absensi Murid --}}
        <a href="{{ route('pengajar.muridAbsensi.index') }}" class="block group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden cursor-pointer">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Absensi Murid</h4>
                    <p class="text-sm text-gray-500 mt-1">Kelola kehadiran murid</p>
                </div>
                {{-- Arrow Indicator (Visual Only) --}}
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </a>

        {{-- CARD 2: Info Data Murid --}}
        <a href="{{ route('pengajar.infoDataMurid.index') }}" class="block group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden cursor-pointer">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Info Data Murid</h4>
                    <p class="text-sm text-gray-500 mt-1">Lihat informasi detail murid</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </a>

        {{-- CARD 3: Jadwal Hari Ini --}}
        <a href="{{ route('pengajar.jadwal.index') }}" class="block group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden cursor-pointer md:col-span-2 lg:col-span-1">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-calendar-day text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Jadwal Hari Ini</h4>
                    <p class="text-sm text-gray-500 mt-1">Cek agenda harian Anda</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    {{-- COLUMN KE -2 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        {{-- CARD 4: Poin Murid (Ganti ke Ikon Bintang & Warna Amber) --}}
        <a href="{{ route('pengajar.sikapMurid.index') }}" class="block group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden cursor-pointer">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 mb-4 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-star text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Sikap Murid</h4>
                    <p class="text-sm text-gray-500 mt-1">Menilai Poin Sikap Murid</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-amber-50 group-hover:text-amber-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </a>

        {{-- CARD 5: Mata Pelajaran Murid (Ganti ke Ikon Buku & Warna Ungu/Purple) --}}
        <a href="{{ route('pengajar.mataPelajaran.index') }}" class="block group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden cursor-pointer">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Mata Pelajaran</h4>
                    <p class="text-sm text-gray-500 mt-1">Detail mata pelajaran murid</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-purple-50 group-hover:text-purple-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </a>

        {{-- CARD 6: Informasi Poin (Ganti ke Ikon Grafik & Warna Teal) --}}
        <a href="{{ route('pengajar.jadwal.index') }}" class="block group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden cursor-pointer md:col-span-2 lg:col-span-1">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="w-12 h-12 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600 mb-4 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Informasi Poin</h4>
                    <p class="text-sm text-gray-500 mt-1">Lihat statistik nilai poin</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>
</div>

            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <h3 class="text-xl font-bold text-gray-800 border-l-4 border-indigo-500 pl-3">Daftar Pengajar</h3>
                        <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ count($dataPengajar) }}</span>
                    </div>
                    
                    <div class="hidden sm:flex space-x-2 text-gray-400 text-sm">
                        <span><i class="fas fa-arrows-alt-h mr-1"></i> Geser untuk melihat</span>
                    </div>
                </div>

                <div class="flex overflow-x-auto pb-6 space-x-6 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent hover:scrollbar-thumb-gray-300">
                    @forelse ($dataPengajar as $pengajar)
                        <div class="snap-start flex-shrink-0 w-72 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                            <div class="flex flex-col items-center text-center">
                                <div class="relative mb-4">
                                    @if($pengajar->foto_pengajar)
                                        <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                            alt="{{ $pengajar->nama_pengajar }}" 
                                            class="w-20 h-20 rounded-2xl object-cover shadow-md group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold shadow-md group-hover:scale-105 transition-transform duration-300">
                                            {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                                
                                <h4 class="text-lg font-bold text-gray-900 mb-1 truncate w-full" title="{{ $pengajar->nama_pengajar }}">
                                    {{ $pengajar->nama_pengajar }}
                                </h4>
                                <p class="text-sm text-gray-500 line-clamp-2 min-h-[40px]">
                                    {{ $pengajar->deskripsi ?? 'Pengajar Aktif' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="w-full bg-white rounded-2xl p-8 border border-dashed border-gray-300 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user-slash text-gray-400 text-xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada data pengajar.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Kalender Kegiatan</h3>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    @if($jadwalBulanIni->isEmpty())
                        <div class="p-12 text-center">
                            <div class="w-20 h-20 mx-auto bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-calendar-times text-gray-300 text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900">Tidak Ada Jadwal</h4>
                            <p class="text-gray-500 text-sm">Belum ada jadwal kegiatan untuk bulan ini.</p>
                        </div>
                    @else
                        <table class="w-full">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Jadwal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengajar</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kegiatan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($jadwalBulanIni as $jadwal)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                                <span class="text-sm font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                            {{ $jadwal->pukul_jadwal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $jadwal->nama_jadwal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $jadwal->nama_pengajar_jadwal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $jadwal->kegiatan_jadwal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClasses = [
                                                    'Hari Ini' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'Selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                    'Mendatang' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                ];
                                                $defaultClass = 'bg-gray-100 text-gray-700 border-gray-200';
                                                $currentClass = $statusClasses[$jadwal->status] ?? $defaultClass;
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $currentClass }}">
                                                {{ $jadwal->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            
        </div>
    </main>
@endsection