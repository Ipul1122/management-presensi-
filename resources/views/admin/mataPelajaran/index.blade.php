@extends('components.layouts.admin.sidebar-and-navbar')
@extends('components.layouts.admin.navbar')

@section('content')
<main class="flex-1 p-6 lg:p-8 space-y-8 custom-scrollbar overflow-y-auto">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-book text-blue-500"></i> Rekap Mata Pelajaran
            </h1>
            <p class="text-gray-500 mt-1">
                Laporan Periode: <span class="font-bold text-blue-600">{{ $judulPeriode }}</span>
            </p>
        </div>

        <form method="GET" action="{{ route('admin.mataPelajaran.index') }}">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-calendar-alt text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                </div>
                
                <select name="periode" onchange="this.form.submit()" 
                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-10 pr-10 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 w-full md:min-w-[200px] cursor-pointer shadow-sm hover:border-blue-300 transition-all font-medium">
                    
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
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Murid</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Pengajar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Deskripsi</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Nilai</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($dataNilai as $data)
                    <tr class="hover:bg-blue-50/30 transition group">
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $data->created_at->format('d M Y, H:i') }}
                        </td>

                        <td class="px-6 py-4 font-bold text-gray-800">
                            {{ $data->nama_murid }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $data->nama_pengajar }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ Str::limit($data->deskripsi, 50) ?: '-' }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            @php
                                $color = $data->nilai >= 8 ? 'bg-green-100 text-green-700' : ($data->nilai >= 5 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700');
                            @endphp
                            <span class="{{ $color }} px-3 py-1 rounded-full font-bold text-sm">
                                {{ $data->nilai }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.mataPelajaran.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Admin yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus Data">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <i class="far fa-folder-open text-3xl mb-2 text-gray-300"></i>
                                <span>Tidak ada data penilaian pada periode {{ $judulPeriode }}.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-gray-100">
            {{ $dataNilai->links() }}
        </div>
    </div>

</main>
@endsection