@extends('components.layouts.pengajar');

@section('content')
    
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Informasi Data Pengajar</h1>

    <div class="overflow-x-auto rounded-lg shadow border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">No</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Jenis Kelamin</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Foto</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Deskripsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($pengajars as $index => $pengajar)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $pengajars->firstItem() + $index }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $pengajar->nama_pengajar }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $pengajar->jenis_kelamin }}</td>
                        <td>
                            <img src="{{ asset('storage/foto_pengajar/' . $pengajar->foto_pengajar) }}"
                                alt="foto {{ $pengajar->nama_pengajar }}"
                                class="w-20 h-20 object-cover rounded-full">
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $pengajar->deskripsi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500">Belum ada data pengajar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pengajars->links('pagination::simple-tailwind') }}
    </div>
</div>

@endsection