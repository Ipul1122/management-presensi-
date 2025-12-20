@extends('components.user.navbar')

@section('navbar-user')
    
    {{-- Font Quicksand --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8fafc;
        }
    </style>

    <div class="relative bg-emerald-600 pb-24 pt-24 rounded-b-[3rem] shadow-xl overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-amber-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>

        <div class="relative max-w-7xl mx-auto px-6 text-center z-10">
            <h3 class="text-3xl md:text-4xl font-bold text-white flex items-center justify-center gap-3">
                <i class="fas fa-calendar-alt text-amber-300"></i>
                Informasi Jadwal
            </h3>
            <p class="text-emerald-100 mt-3 text-lg font-medium">Jadwal kegiatan belajar mengajar TPA bulan ini</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 -mt-16 relative z-20 mb-20">
        
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden min-h-[400px]">
            
            {{-- Form Wrapper (Sesuai kode asli, namun disarankan dihapus jika User tidak boleh hapus data) --}}
            <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
                @csrf
                @method('DELETE')

                <div class="block lg:hidden p-6 space-y-6">
                    @forelse ($jadwalBulanIni as $jadwal)
                        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                            {{-- Hiasan Garis Kiri --}}
                            <div class="absolute left-0 top-0 bottom-0 w-2 bg-gradient-to-b from-emerald-400 to-emerald-600"></div>

                            {{-- Header Card: Status & Tanggal --}}
                            <div class="flex justify-between items-start mb-4 pl-3">
                                <div class="flex items-center gap-3">
                                    {{-- Ikon Kalender --}}
                                    <div class="w-10 h-10 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Tanggal</p>
                                        <p class="font-bold text-gray-800">
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                                
                                {{-- Status Badge --}}
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_jadwal);
                                    
                                    if ($tanggal->lt($today)) {
                                        $status = 'Selesai';
                                        $statusClass = 'bg-gray-100 text-gray-500 border-gray-200';
                                    } elseif ($tanggal->isToday()) {
                                        $status = 'Hari Ini';
                                        $statusClass = 'bg-amber-100 text-amber-700 border-amber-200';
                                    } else {
                                        $status = 'Akan Datang';
                                        $statusClass = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                                    }
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold border {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </div>
                            
                            {{-- Content Card --}}
                            <div class="pl-3 space-y-3">
                                <h4 class="text-xl font-bold text-emerald-800">{{ $jadwal->nama_jadwal }}</h4>
                                
                                <div class="grid gap-2 border-t border-dashed border-gray-200 pt-3">
                                    {{-- Pukul --}}
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <div class="w-6 text-center"><i class="fas fa-clock text-amber-500"></i></div>
                                        <span class="font-medium bg-amber-50 px-2 py-0.5 rounded text-amber-700 text-sm">{{ $jadwal->pukul_jadwal }}</span>
                                    </div>
                                    
                                    {{-- Pengajar --}}
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <div class="w-6 text-center"><i class="fas fa-user-graduate text-blue-500"></i></div>
                                        <span class="text-sm font-medium">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                    </div>
                                    
                                    {{-- Kegiatan --}}
                                    <div class="flex items-start gap-3 text-gray-600">
                                        <div class="w-6 text-center mt-0.5"><i class="fas fa-book-open text-emerald-500"></i></div>
                                        <span class="text-sm leading-relaxed">{{ $jadwal->kegiatan_jadwal }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-gray-500">Tidak ada jadwal bulan ini.</p>
                        </div>
                    @endforelse
                </div>

                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-emerald-50/50 text-emerald-800 border-b border-emerald-100">
                                <th class="px-6 py-5 font-bold text-sm uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-5 font-bold text-sm uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-5 font-bold text-sm uppercase tracking-wider">Kegiatan</th>
                                <th class="px-6 py-5 font-bold text-sm uppercase tracking-wider">Pengajar</th>
                                <th class="px-6 py-5 font-bold text-sm uppercase tracking-wider text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($jadwalBulanIni as $jadwal)
                                <tr class="hover:bg-emerald-50/30 transition-colors duration-200 group">
                                    {{-- TANGGAL --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="font-bold text-gray-800 text-lg">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d') }}
                                            </div>
                                            <div class="flex flex-col text-sm">
                                                <span class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('F') }}</span>
                                                <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('Y') }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- WAKTU --}}
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                            <i class="fas fa-clock text-xs"></i>
                                            {{ $jadwal->pukul_jadwal }}
                                        </span>
                                    </td>

                                    {{-- KEGIATAN & NAMA JADWAL --}}
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="font-bold text-emerald-800 text-base mb-1">{{ $jadwal->nama_jadwal }}</div>
                                            <p class="text-gray-500 text-sm leading-snug max-w-xs">{{ $jadwal->kegiatan_jadwal }}</p>
                                        </div>
                                    </td>

                                    {{-- PENGAJAR --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                                {{ substr($jadwal->nama_pengajar_jadwal, 0, 1) }}
                                            </div>
                                            <span class="text-gray-700 font-medium text-sm">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                        </div>
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $today = \Carbon\Carbon::today();
                                            $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_jadwal);
                                            
                                            if ($tanggal->lt($today)) {
                                                $status = 'Selesai';
                                                $statusClass = 'bg-gray-100 text-gray-400';
                                                $icon = 'fa-check-circle';
                                            } elseif ($tanggal->isToday()) {
                                                $status = 'Hari Ini';
                                                $statusClass = 'bg-amber-100 text-amber-600 ring-1 ring-amber-200';
                                                $icon = 'fa-exclamation-circle';
                                            } else {
                                                $status = 'Akan Datang';
                                                $statusClass = 'bg-emerald-100 text-emerald-600 ring-1 ring-emerald-200';
                                                $icon = 'fa-clock';
                                            }
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                            <i class="fas {{ $icon }}"></i>
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                                            <p>Belum ada jadwal yang tersedia untuk bulan ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>

@endsection