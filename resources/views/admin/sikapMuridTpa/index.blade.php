@extends('components.layouts.admin.sidebar-and-navbar')
@extends('components.layouts.admin.navbar')

@section('content')
<main class="flex-1 p-6 lg:p-8 space-y-8 custom-scrollbar overflow-y-auto">
    
    <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-medal text-purple-500"></i> Poin Sikap Murid
            </h1>
            <p class="text-gray-500 mt-1 text-sm">
                Laporan: <span class="font-bold text-purple-600">{{ $judulPeriode }}</span>
                @if($selectedPengajar)
                    | Oleh: <span class="font-bold text-indigo-600">{{ $selectedPengajar }}</span>
                @endif
            </p>
        </div>

        <form method="GET" action="{{ route('admin.sikapMurid.index') }}" class="w-full xl:w-auto flex flex-col md:flex-row gap-3">
            <div class="relative group w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user-tie text-gray-400 group-hover:text-indigo-500 transition-colors"></i>
                </div>
                <select name="filter_pengajar" onchange="this.form.submit()" 
                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-10 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 w-full md:min-w-[180px] cursor-pointer shadow-sm text-sm font-medium">
                    <option value="">Semua Pengajar</option>
                    @foreach($pengajarList as $p)
                        <option value="{{ $p }}" {{ $selectedPengajar == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <div class="relative group w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-calendar-alt text-gray-400 group-hover:text-purple-500 transition-colors"></i>
                </div>
                <select name="periode" onchange="this.form.submit()" 
                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-10 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-purple-500 w-full md:min-w-[180px] cursor-pointer shadow-sm text-sm font-medium">
                    @foreach($periodList as $value => $label)
                        <option value="{{ $value }}" {{ $value == $selectedPeriod ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-fit">
            <div class="p-6 bg-gradient-to-r from-purple-600 to-indigo-700 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="fas fa-trophy"></i> 
                    @if($selectedPengajar)
                        Top {{ explode(' ', $selectedPengajar)[0] }}
                    @else
                        Top Murid
                    @endif
                </h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Rank</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Murid</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Poin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($dataSikap as $index => $item)
                        <tr class="hover:bg-purple-50/50">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full font-bold text-xs {{ $index < 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $item->nama_murid }}</td>
                            <td class="px-6 py-4 text-center font-bold text-purple-600">{{ $item->total_poin }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-sm">
                                Tidak ada data.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-fit">
            <div class="p-6 bg-white border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800"><i class="fas fa-history mr-2 text-indigo-500"></i> Log Aktivitas</h3>
                <span class="text-[10px] bg-indigo-50 text-indigo-600 px-2 py-1 rounded-full border border-indigo-100">
                    10 Terakhir
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Waktu</th>
                            @if(!$selectedPengajar) 
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pengajar</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Detail</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Poin</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($riwayatPenilaian as $log)
                        <tr class="group hover:bg-red-50/30 transition duration-200">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs font-medium text-gray-900">{{ $log->created_at->translatedFormat('d M') }}</div>
                                <div class="text-[10px] text-gray-400">{{ $log->created_at->format('H:i') }}</div>
                            </td>
                            
                            @if(!$selectedPengajar)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-700">{{ $log->nama_pengajar }}</span>
                                </div>
                            </td>
                            @endif

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="font-bold text-gray-800 text-xs mb-1">{{ $log->nama_murid }}</div>
                                <div class="flex flex-wrap gap-1">
                                    @if(is_array($log->detail_sikap))
                                        @foreach($log->detail_sikap as $sikap)
                                            <span class="text-[10px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">
                                                {{ $sikap }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                                    +{{ $log->jumlah_poin }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.sikapMurid.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus log aktivitas ini? Poin murid akan berkurang.');">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-100 transition-all" title="Hapus Log">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $selectedPengajar ? 4 : 5 }}" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <i class="far fa-folder-open text-3xl mb-2 text-gray-300"></i>
                                    <span>Data kosong.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3 bg-gray-50 border-t border-gray-100 text-center">
                <p class="text-[10px] text-gray-400">Menampilkan maksimal 10 aktivitas terbaru sesuai filter.</p>
            </div>
        </div>
    </div>
</main>
@endsection