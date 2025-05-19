@extends('components.layouts.admin') {{-- Ganti sesuai layout utama --}}

@section('content')
<div class="container mx-auto px-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-semibold mb-4">Daftar Data Murid</h2>

    <table class="min-w-full bg-white border border-gray-300 mb-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border">#</th>
                <th class="py-2 px-4 border">Nama Anak</th>
                <th class="py-2 px-4 border">Jenis Kelamin</th>
                <th class="py-2 px-4 border">Alamat</th>
                <th class="py-2 px-4 border">Kelas</th>
                <th class="py-2 px-4 border">Tanggal Daftar</th>
                <th class="py-2 px-4 border">Foto</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($murids as $murid)
                <tr>
                    <td class="py-2 px-4 border">{{ $loop->iteration + ($murids->currentPage() - 1) * $murids->perPage() }}</td>
                    <td class="py-2 px-4 border">{{ $murid->nama_anak }}</td>
                    <td class="py-2 px-4 border">{{ $murid->jenis_kelamin }}</td>
                    <td class="py-2 px-4 border">{{ $murid->alamat }}</td>
                    <td class="py-2 px-4 border">{{ $murid->kelas }}</td>
                    <td class="py-2 px-4 border">{{ $murid->tanggal_daftar }}</td>
                    <td class="py-2 px-4 border">
                        @if ($murid->foto_anak)
                            <img src="{{ asset('storage/' . $murid->foto_anak) }}" class="w-16 h-16 object-cover rounded" alt="Foto Anak">
                        @else
                            <span class="text-gray-500 italic">Tidak ada</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-4 px-4 text-center text-gray-500">Belum ada data murid.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mb-4">
        {{ $murids->links() }}
    </div>

    {{-- Tombol kembali ke form tambah --}}
    <a href="{{ route('admin.murid.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Tambah Murid Baru
    </a>
</div>
@endsection
