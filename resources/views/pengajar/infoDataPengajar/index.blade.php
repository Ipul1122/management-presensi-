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
                            {{-- FOTO PENGAJAR --}}
                            @if($pengajar->foto_pengajar)
                                <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                    alt="foto" class="h-14 w-14 my-4 rounded object-cover border-2 border-green-140">
                            @else
                            {{-- NAMA PENGAJAR --}}
                                <td class="h-14 w-14 rounded bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-semibold">
                                    {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                </td>
                            @endif
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