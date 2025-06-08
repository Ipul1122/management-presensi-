@extends('components.layouts.pengajar') 

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Riwayat Absensi Murid</h1>

    @forelse ($riwayatAbsensi as $bulan => $hariGroup)
        <div class="mb-6 border rounded shadow p-4">
            <h2 class="text-lg font-semibold text-blue-600 mb-3">{{ $bulan }}</h2>

            @forelse ($hariGroup as $tanggal => $records)
                <details class="mb-3 bg-gray-100 rounded-md p-3">
                    <summary class="cursor-pointer font-medium text-gray-700">
                        {{ $tanggal }}
                    </summary>

                    <div class="mt-2 overflow-x-auto">
                        <table class="w-full table-auto border mt-2">
                            <thead>
                                <tr class="bg-gray-200 text-sm">
                                    <th class="px-4 py-2 border">Nama Murid</th>
                                    <th class="px-4 py-2 border">Jenis Bacaan</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $absen)
                                    <tr class="text-sm">
                                        <td class="px-4 py-2 border">{{ $absen->nama_murid }}</td>
                                        <td class="px-4 py-2 border">{{ $absen->jenis_bacaan }}</td>
                                        <td class="px-4 py-2 border">{{ $absen->jenis_status }}</td>
                                        <td class="px-4 py-2 border">{{ $absen->catatan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </details>
            @empty
                <p class="text-gray-500 text-sm">Tidak ada data absensi di bulan ini.</p>
            @endforelse
        </div>
    @empty
        <p class="text-gray-500"></p>Belum ada riwayat absensi.</p>
          @endforelse
</div>
@endsection