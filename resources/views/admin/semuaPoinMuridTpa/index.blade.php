    @extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Rekapitulasi Total Poin Murid</h1>
            <p class="text-sm text-gray-500 mt-1">
                Gabungan Poin Absensi, Mata Pelajaran, dan Sikap ({{ $judulPeriode }})
            </p>
        </div>
        
        {{-- Filter Periode --}}
        <form method="GET" action="{{ route('admin.semuaPoinMuridTpa.index') }}" class="mt-4 sm:mt-0 flex items-center gap-2">
            <select name="periode" onchange="this.form.submit()" 
                class="rounded-lg border-gray-300 text-sm focus:ring-purple-500 focus:border-purple-500 shadow-sm cursor-pointer">
                @foreach($periodList as $val => $label)
                    <option value="{{ $val }}" {{ $selectedPeriod == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Tabel Rekapitulasi --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-purple-50 text-purple-900 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-lg">Peringkat</th>
                        <th class="px-6 py-4">Nama Murid</th>
                        <th class="px-6 py-4 text-center">Kehadiran<br><span class="text-[10px] normal-case opacity-70">(Hadir x 1)</span></th>
                        <th class="px-6 py-4 text-center">Poin Mapel</th>
                        <th class="px-6 py-4 text-center">Poin Sikap</th>
                        <th class="px-6 py-4 text-center rounded-tr-lg font-bold">TOTAL AKHIR</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($dataGabungan as $index => $murid)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            {{-- Kolom Peringkat (Juara 1-3 diberi warna/icon khusus) --}}
                            <td class="px-6 py-4 font-medium">
                                @if($loop->iteration == 1)
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-700 font-bold border border-yellow-200">1</span>
                                @elseif($loop->iteration == 2)
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-600 font-bold border border-gray-200">2</span>
                                @elseif($loop->iteration == 3)
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-orange-100 text-orange-700 font-bold border border-orange-200">3</span>
                                @else
                                    <span class="ml-2 text-gray-500">#{{ $loop->iteration }}</span>
                                @endif
                            </td>
                            
                            {{-- Nama Murid --}}
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $murid->nama_anak }}
                            </td>

                            {{-- Poin Kehadiran --}}
                            <td class="px-6 py-4 text-center">
                                <span class="bg-blue-50 text-blue-700 py-1 px-3 rounded-full text-xs font-semibold">
                                    +{{ $murid->poin_hadir }}
                                </span>
                                <div class="text-[10px] text-gray-400 mt-1">{{ $murid->jumlah_hadir }} Hadir</div>
                            </td>

                            {{-- Poin Mata Pelajaran --}}
                            <td class="px-6 py-4 text-center">
                                @if($murid->poin_mapel > 0)
                                    <span class="bg-green-50 text-green-700 py-1 px-3 rounded-full text-xs font-semibold">
                                        +{{ $murid->poin_mapel }}
                                    </span>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>

                            {{-- Poin Sikap --}}
                            <td class="px-6 py-4 text-center">
                                @if($murid->poin_sikap > 0)
                                    <span class="bg-purple-50 text-purple-700 py-1 px-3 rounded-full text-xs font-semibold">
                                        +{{ $murid->poin_sikap }}
                                    </span>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>

                            {{-- TOTAL AKHIR --}}
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-gray-800">{{ $murid->total_poin_akhir }}</span>
                                <span class="text-xs text-gray-400 ml-1">Poin</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic">
                                Tidak ada data poin untuk periode {{ $judulPeriode }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Footer/Info Tambahan --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-xs text-gray-500">
            <p><strong>Catatan:</strong> Poin Total dihitung dari: (Jumlah Kehadiran) + (Total Nilai Mapel) + (Total Poin Sikap).</p>
        </div>
    </div>
@endsection