@extends('components.layouts.pengajar')

@section('content')

{{-- Filter Dropdown Bulan --}}
<form method="GET" action="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="mb-6">
    <label for="bulan" class="mr-2 font-semibold text-gray-700">Pilih Bulan:</label>
    <select name="bulan" id="bulan" onchange="this.form.submit()" class="border px-3 py-1 rounded shadow-sm">
        @foreach ($bulanList as $bln)
            <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>
                {{ \Carbon\Carbon::parse($bln)->translatedFormat('F Y') }}
            </option>
        @endforeach
    </select>
</form>

{{-- Rekap Kehadiran Murid --}}
@if ($rekap && count($rekap) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        @foreach ($rekap as $nama => $jumlah)
            <div class="bg-white shadow border rounded p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $nama }}</h3>
                <p class="text-sm text-gray-600">Jumlah Hadir: <span class="font-bold text-green-600">{{ $jumlah }}</span> kali</p>
            </div>
        @endforeach
    </div>
@else
    <p class="text-sm text-gray-500 mb-6">Tidak ada data kehadiran bulan ini.</p>
@endif

{{-- Riwayat Absensi Harian --}}
@foreach ($riwayatAbsensi as $bulan => $tanggalGroup)
    <div class="mb-6 border rounded shadow p-4">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">{{ $bulan }}</h2>

        @foreach ($tanggalGroup as $tanggal => $absens)
            <div class="mb-4 border rounded-md bg-gray-50">
                <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                    <h3 class="text-md font-semibold">
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                    </h3>
                </div>
                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-2 py-1 border">Nama Murid</th>
                            <th class="px-2 py-1 border">Status</th>
                            <th class="px-2 py-1 border">Catatan</th>
                            <th class="px-2 py-1 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absens as $absen)
                            <tr>
                                <td class="px-2 py-1 border">{{ $absen->nama_murid }}</td>
                                <td class="px-2 py-1 border">{{ $absen->jenis_status }}</td>
                                <td class="px-2 py-1 border">{{ $absen->catatan }}</td>
                                <td class="px-2 py-1 border">
                                    <a href="{{ route('pengajar.riwayatMuridAbsensi.edit', $absen->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                    <form action="{{ route('pengajar.riwayatMuridAbsensi.hapus', $absen->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data {{ $absen->nama_murid }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm ml-2">
                                            Hapus {{ $absen->nama_murid }}?
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endforeach

{{-- Notifikasi --}}
@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@endsection
