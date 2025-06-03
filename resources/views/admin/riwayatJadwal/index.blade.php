@extends('components.layouts.admin') {{-- atau sesuaikan dengan layout dashboard admin Anda --}}

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Riwayat Jadwal</h1>

    @forelse ($groupedByMonth as $month => $jadwals)
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="bg-blue-100 px-4 py-2 rounded-t-lg font-semibold text-blue-800">
                {{ $month }}
            </div>
            <div class="p-4">
                @foreach ($jadwals as $jadwal)
                    <div class="border-b border-gray-200 py-2">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">{{ $jadwal->nama_jadwal }}</p>
                                <p class="text-sm text-gray-500">
                                    Tanggal: {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }},
                                    Pukul: {{ $jadwal->pukul_jadwal }}
                                </p>
                                <p class="text-sm text-gray-500">Pengajar: {{ $jadwal->nama_pengajar_jadwal }}</p>
                                <p class="text-sm text-gray-500">Kegiatan: {{ $jadwal->kegiatan_jadwal }}</p>
                            </div>
                            <div class="text-xs bg-gray-200 px-2 py-1 rounded-full text-gray-600">
                                Selesai
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-gray-600">Tidak ada riwayat jadwal yang tersedia.</p>
    @endforelse
</div>
@endsection