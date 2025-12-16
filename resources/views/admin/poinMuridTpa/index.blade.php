@extends('components.layouts.admin.sidebar-and-navbar')
@extends('components.layouts.admin.navbar')

@section('content')
<main class="flex-1 p-6 lg:p-8 space-y-8 custom-scrollbar overflow-y-auto">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-star text-yellow-400"></i>
                Sistem Poin Murid
            </h1>
            <p class="text-gray-500 mt-1">
                Laporan Periode <span class="font-bold text-indigo-600">{{ $judulPeriode }}</span>
            </p>
        </div>
        
        <form method="GET" action="{{ route('admin.poinMuridTpa.index') }}" class="w-full md:w-auto">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-calendar-alt text-gray-400 group-hover:text-indigo-500 transition-colors"></i>
                </div>
                
                <select name="periode" onchange="this.form.submit()" 
                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-10 pr-10 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 w-full md:min-w-[200px] cursor-pointer shadow-sm hover:border-indigo-300 transition-all font-medium">
                    
                    @foreach($periodList as $value => $label)
                        <option value="{{ $value }}" {{ $value == $selectedPeriod ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach

                </select>
                
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="fas fa-trophy"></i>
                Klasemen {{ $judulPeriode }}
            </h3>
            <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-sm font-medium backdrop-blur-sm border border-white/10">
                Total Murid: {{ $dataMurid->count() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Peringkat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Murid</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Kehadiran</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Total Poin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($dataMurid as $index => $murid)
                    @php
                        $poin = $murid->total_hadir * 10;
                        
                        // LOGIKA PERINGKAT (1, 2, 3 beda warna)
                        $rank = $loop->iteration;
                        $rankColor = 'bg-gray-100 text-gray-600 font-medium';
                        $rankIcon = '';
                        
                        if($rank == 1) {
                            $rankColor = 'bg-yellow-100 text-yellow-700 border border-yellow-200 shadow-sm';
                            $rankIcon = '<i class="fas fa-crown text-[10px] mb-[1px]"></i>';
                        }
                        elseif($rank == 2) {
                            $rankColor = 'bg-slate-200 text-slate-700 border border-slate-300';
                        }
                        elseif($rank == 3) {
                            $rankColor = 'bg-orange-100 text-orange-800 border border-orange-200';
                        }
                    @endphp
                    <tr class="hover:bg-blue-50/50 transition-colors duration-200 group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-8 h-8 rounded-full flex flex-col items-center justify-center {{ $rankColor }}">
                                {!! $rankIcon !!}
                                <span class="text-sm leading-none">{{ $rank }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $murid->nama_anak }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $murid->jenis_kelamin == 'Laki-laki' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' }}">
                                {{ $murid->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-block px-2 py-1 bg-gray-100 rounded text-gray-600 font-semibold text-sm">
                                {{ $murid->total_hadir }}x
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-lg bg-gradient-to-r from-amber-400 to-orange-500 text-white font-bold shadow-sm ring-2 ring-orange-100">
                                <i class="fas fa-star text-xs animate-pulse"></i>
                                {{ $poin }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-search text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">Data Kosong</h3>
                                <p class="text-gray-500 text-sm">Tidak ada absensi murid yang tercatat pada periode <span class="font-medium text-gray-700">{{ $judulPeriode }}</span>.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection