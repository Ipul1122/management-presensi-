@extends('components.layouts.pengajar.sidebar')

@section('sidebar-pengajar')
<div class="p-4 sm:p-6 space-y-6">
    
    {{-- Header & Toolbar Filter --}}
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        {{-- Judul --}}
        <div class="space-y-1">
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-gray-900">
                Leaderboard <span class="text-blue-600">TPA Digital</span>
            </h1>
            <p class="text-gray-500 text-sm flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-blue-500"></i>
                Rekapitulasi: <span class="font-semibold text-gray-700">{{ $judulPeriode }}</span>
            </p>
        </div>
        
        {{-- Form Filter Gabungan --}}
        <form method="GET" action="{{ route('user.semuaPoinMuridUser.index') }}" 
              class="flex flex-col sm:flex-row w-full lg:w-auto bg-white p-1.5 rounded-2xl border border-gray-200 shadow-sm gap-2">
            
            {{-- SEARCH BAR + DROPDOWN SUGGESTION --}}
            <div class="relative flex-grow sm:w-72 group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                
                {{-- Input dengan Datalist --}}
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       list="murid-list"
                       placeholder="Cari atau pilih nama murid..." 
                       class="block w-full pl-10 pr-10 py-2.5 border-none focus:ring-0 text-sm text-gray-700 placeholder-gray-400 bg-transparent rounded-xl focus:bg-gray-50 transition-colors"
                       autocomplete="off"
                       onchange="this.form.submit()">
                
                {{-- Dropdown Data (Hidden native element) --}}
                <datalist id="murid-list">
                    @foreach($allMurids as $nama)
                        <option value="{{ $nama }}"></option>
                    @endforeach
                </datalist>

                {{-- Tombol Clear / Reset Search --}}
                @if($search)
                    <a href="{{ route('user.semuaPoinMuridUser.index', ['periode' => $selectedPeriod]) }}" 
                       class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-red-500 text-gray-400 transition-colors"
                       title="Hapus pencarian">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>

            <div class="hidden sm:block w-px bg-gray-200 my-1"></div>

            {{-- Dropdown Periode --}}
            <div class="relative min-w-[180px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-filter text-blue-500 text-xs"></i>
                </div>
                <select name="periode" onchange="this.form.submit()" 
                    class="block w-full pl-8 pr-10 py-2.5 border-none focus:ring-0 text-sm font-medium text-gray-700 bg-gray-50 sm:bg-transparent rounded-xl cursor-pointer hover:bg-gray-100 transition-colors appearance-none truncate">
                    @foreach($periodList as $val => $label)
                        <option value="{{ $val }}" {{ $selectedPeriod == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
        </form>
    </div>

    {{-- Tabel Content --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden min-h-[400px]">
        
        {{-- Tabel Desktop --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center w-20">Rank</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Murid</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Kehadiran</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Mapel</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Sikap</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-600 uppercase tracking-wider text-center">Total Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($dataGabungan as $index => $murid)
                        <tr class="group hover:bg-blue-50/30 transition-all duration-200">
                            {{-- Peringkat --}}
                            <td class="px-6 py-5 text-center">
                                @if($loop->iteration == 1)
                                    <div class="relative inline-block">
                                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-400 text-white shadow-lg shadow-yellow-200 ring-2 ring-yellow-100 font-bold">1</span>
                                    </div>
                                @elseif($loop->iteration == 2)
                                    <span class="flex items-center justify-center w-9 h-9 mx-auto rounded-xl bg-slate-200 text-slate-700 font-bold border-2 border-slate-100">2</span>
                                @elseif($loop->iteration == 3)
                                    <span class="flex items-center justify-center w-9 h-9 mx-auto rounded-xl bg-orange-100 text-orange-700 font-bold border-2 border-orange-50">3</span>
                                @else
                                    <span class="text-gray-400 font-semibold text-sm">#{{ $loop->iteration }}</span>
                                @endif
                            </td>
                            
                            {{-- Profil Murid --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm uppercase shadow-sm">
                                        {{ substr($murid->nama_anak, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800 group-hover:text-blue-700 transition-colors">
                                            {!! str_replace($search, '<span class="bg-yellow-200 rounded px-0.5">'.$search.'</span>', $murid->nama_anak) !!}
                                        </div>
                                        <div class="text-[10px] text-gray-400 uppercase tracking-widest font-medium">Santri TPA</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Statistik Poin --}}
                            <td class="px-6 py-5 text-center">
                                <div class="inline-flex flex-col">
                                    <span class="text-blue-600 font-bold text-base">+{{ $murid->poin_hadir }}</span>
                                    <span class="text-[10px] font-medium text-gray-400 uppercase">{{ $murid->jumlah_hadir }} Sesi</span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $murid->poin_mapel > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400' }}">
                                    {{ $murid->poin_mapel > 0 ? '+'.$murid->poin_mapel : '0' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $murid->poin_sikap > 0 ? 'bg-pink-100 text-pink-700' : 'bg-gray-100 text-gray-400' }}">
                                    {{ $murid->poin_sikap > 0 ? '+'.$murid->poin_sikap : '0' }}
                                </span>
                            </td>

                            {{-- Total --}}
                            <td class="px-6 py-5 text-center">
                                <div class="bg-blue-600 text-white rounded-2xl py-2 px-4 inline-block min-w-[80px] shadow-sm shadow-blue-200 group-hover:scale-105 transition-transform">
                                    <span class="text-lg font-black tracking-tight">{{ $murid->total_poin_akhir }}</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-user-slash text-gray-300 text-2xl"></i>
                                    </div>
                                    <h3 class="text-gray-900 font-medium mb-1">Tidak ditemukan</h3>
                                    <p class="text-gray-400 text-sm max-w-xs mx-auto">
                                        Tidak ada murid dengan nama "<span class="font-semibold">{{ $search }}</span>" pada periode ini.
                                    </p>
                                    @if($search)
                                        <a href="{{ route('user.semuaPoinMuridUser.index', ['periode' => $selectedPeriod]) }}" class="mt-4 text-blue-600 hover:text-blue-700 text-sm font-medium hover:underline">
                                            Reset Pencarian
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tampilan Mobile (Cards) --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($dataGabungan as $index => $murid)
                <div class="p-4 flex items-center gap-4 hover:bg-gray-50 active:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0 w-8 text-center">
                        <span class="text-gray-400 font-bold text-sm">#{{ $loop->iteration }}</span>
                    </div>

                    <div class="flex-grow min-w-0">
                        <h4 class="font-bold text-gray-900 truncate text-sm">
                            {!! str_replace($search, '<span class="bg-yellow-200 rounded px-0.5">'.$search.'</span>', $murid->nama_anak) !!}
                        </h4>
                        <div class="flex flex-wrap gap-2 mt-1">
                            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 rounded-md">Absen: {{ $murid->poin_hadir }}</span>
                            <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 rounded-md">Mapel: {{ $murid->poin_mapel }}</span>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-xl font-black text-blue-700">{{ $murid->total_poin_akhir }}</div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <p class="text-gray-500 font-medium">Murid tidak ditemukan.</p>
                    @if($search)
                        <a href="{{ route('user.semuaPoinMuridUser.index', ['periode' => $selectedPeriod]) }}" class="text-blue-600 text-sm mt-2 block">Hapus Filter</a>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection