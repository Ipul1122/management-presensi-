@extends('components.layouts.admin.sidebar-and-navbar')
@extends('components.layouts.admin.navbar')

@section('content')
<main class="flex-1 p-6 lg:p-8 space-y-8 custom-scrollbar overflow-y-auto">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-book-open text-blue-600"></i> Manajemen Mata Pelajaran
            </h1>
            <p class="text-gray-500 mt-1">
                Laporan Periode: <span class="font-bold text-blue-600">{{ $judulPeriode }}</span>
                @if($selectedPengajar)
                 • Pengajar: <span class="font-bold text-blue-600">{{ $selectedPengajar }}</span>
                @endif
            </p>
        </div>

        <form method="GET" action="{{ route('admin.mataPelajaran.index') }}" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            
            <div class="relative group w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user-tie text-gray-400"></i>
                </div>
                <select name="pengajar" onchange="this.form.submit()" 
                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-10 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 w-full md:min-w-[180px] cursor-pointer shadow-sm hover:border-blue-300 transition-all font-medium text-sm">
                    
                    <option value="">Semua Pengajar</option>
                    @foreach($daftarPengajar as $p)
                        <option value="{{ $p }}" {{ $p == $selectedPengajar ? 'selected' : '' }}>
                            {{ $p }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <div class="relative group w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-calendar-alt text-gray-400"></i>
                </div>
                <select name="periode" onchange="this.form.submit()" 
                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-10 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 w-full md:min-w-[180px] cursor-pointer shadow-sm hover:border-blue-300 transition-all font-medium text-sm">
                    
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
        <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-blue-50 to-white">
            <h2 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                <i class="fas fa-chart-pie text-blue-500"></i> Rekap Total Nilai
            </h2>
            <div class="text-xs font-medium px-2 py-1 bg-blue-100 text-blue-600 rounded-lg hidden sm:block">
                Group by Murid
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Murid</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Frekuensi Input</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Total Nilai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($rekapNilai as $data)
                    <tr class="hover:bg-blue-50/30 transition">
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $data->nama_murid }}</td>
                        
                        <td class="px-6 py-4 text-center">
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">
                                {{ $data->jumlah_input }}x Input
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $total = $data->total_nilai;
                                $color = $total >= 50 ? 'bg-green-100 text-green-700' : ($total >= 20 ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700');
                            @endphp
                            <span class="{{ $color }} px-4 py-2 rounded-xl font-bold text-base shadow-sm">
                                {{ $total }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                            Belum ada rekap nilai untuk filter ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $rekapNilai->links() }}
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-gray-50 to-white">
            <h2 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                <i class="fas fa-history text-gray-500"></i> Riwayat Aktivitas Penilaian
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Murid</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Pengajar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Deskripsi</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Nilai Input</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($aktivitas as $log)
                    <tr class="hover:bg-red-50/10 transition group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $log->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-700">{{ $log->nama_murid }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $log->nama_pengajar }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-xs" title="{{ $log->deskripsi }}">
                            {{ Str::limit($log->deskripsi, 40) ?: '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-mono font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded">
                                {{ $log->nilai }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.mataPelajaran.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus satu data ini? Total nilai akan berkurang.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors" title="Hapus Data Ini">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <i class="far fa-folder-open text-3xl mb-2 text-gray-300"></i>
                                <span>Tidak ada aktivitas penilaian yang sesuai filter.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $aktivitas->links() }}
        </div>
    </div>

</main>
@endsection