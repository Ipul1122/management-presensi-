@extends('components.layouts.admin.sidebar-and-navbar')
@extends('components.layouts.admin.navbar')

@section('content')
<main class="flex-1 p-6 lg:p-8 space-y-8 custom-scrollbar overflow-y-auto">
    
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-medal text-purple-500"></i> Poin Sikap Murid
            </h1>
            <p class="text-gray-500 mt-1">Pantau perkembangan karakter dan akhlak murid.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-fit">
            <div class="p-6 bg-gradient-to-r from-purple-600 to-indigo-700">
                <h3 class="text-xl font-bold text-white"><i class="fas fa-trophy mr-2"></i> Klasemen Terbaik</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Rank</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Murid</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Total Poin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($dataSikap as $index => $item)
                        <tr class="hover:bg-purple-50/50">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full font-bold text-xs {{ $index < 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $item->nama_murid }}</td>
                            <td class="px-6 py-4 text-center font-bold text-purple-600">{{ $item->total_poin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-fit">
            <div class="p-6 bg-white border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800"><i class="fas fa-history mr-2 text-indigo-500"></i> Riwayat Penilaian Terbaru</h3>
                <p class="text-sm text-gray-400 mt-1">Melihat siapa pengajar yang memberikan nilai.</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pengajar</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Murid</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Poin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($riwayatPenilaian as $log)
                        <tr class="hover:bg-indigo-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs font-medium text-gray-900">{{ $log->created_at->translatedFormat('d M') }}</div>
                                <div class="text-[10px] text-gray-400">{{ $log->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">{{ $log->nama_pengajar }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $log->nama_murid }}
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @if(is_array($log->detail_sikap))
                                        @foreach($log->detail_sikap as $sikap)
                                            <span class="text-[10px] text-gray-400 bg-gray-50 px-1 rounded border">{{ $sikap }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                                    +{{ $log->jumlah_poin }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data riwayat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $riwayatPenilaian->links() }}
            </div>
        </div>

    </div>

</main>
@endsection