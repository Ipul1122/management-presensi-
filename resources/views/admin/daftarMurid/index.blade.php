@extends('components.layouts.admin.sidebar-and-navbar')
@section('content')

<section class="p-8">
    <h2 class="text-2xl font-bold mb-6">Daftar Pendaftar Murid</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2 border">Foto</th>
                    <th class="px-4 py-2 border">Nama Anak</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Jenis Kelamin</th>
                    <th class="px-4 py-2 border">Orang Tua</th>
                    <th class="px-4 py-2 border">Tanggal Daftar</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftar as $item)
                <tr class="hover:bg-gray-50">
                    {{-- Foto Anak --}}
                    <td class="px-4 py-2 border text-center">
                        @if ($item->foto_anak)
                            <div class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 border-2 border-white shadow mx-auto">
                                <img src="{{ asset('storage/' . $item->foto_anak) }}" 
                                     alt="Foto {{ $item->nama_anak }}" 
                                     class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 mx-auto">
                                N/A
                            </div>
                        @endif
                    </td>

                    {{-- Data Murid --}}
                    <td class="px-4 py-2 border">{{ $item->nama_anak }}</td>
                    <td class="px-4 py-2 border">{{ $item->kelas }}</td>
                    <td class="px-4 py-2 border">{{ $item->jenis_kelamin }}</td>
                    <td class="px-4 py-2 border">{{ $item->ayah }} & {{ $item->ibu }}</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal_daftar }}</td>

                    {{-- Tombol Aksi --}}
                    <td class="px-4 py-2 border text-center space-x-2">
                        {{-- Tombol Terima --}}
                        <form action="{{ route('admin.daftarMurid.terima', $item->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                Terima
                            </button>
                        </form>

                        {{-- Tombol Tolak --}}
                        <form action="{{ route('admin.daftarMurid.tolak', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menolak pendaftaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Tolak
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

@endsection
