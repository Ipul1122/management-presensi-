@extends('components.layouts.admin')

@section('content')
<h1>Tambah Jadwal</h1>

<form method="POST" action="{{ route('admin.jadwal.store') }}">
    @csrf
    <input type="text" name="nama_jadwal" placeholder="Nama Jadwal" required>
    <input type="date" name="tanggal_jadwal" required>
    <input type="text" name="pukul_jadwal" placeholder="Pukul Jadwal" required>
     <label for="nama_pengajar_jadwal" class="block text-gray-700">Nama Pengajar</label>
    <select name="nama_pengajar_jadwal" id="nama_pengajar_jadwal" required class="w-full mt-1 p-2 border rounded">
        <option value="">-- Pilih Pengajar --</option>
        @foreach($pengajars as $pengajar)
            <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
        @endforeach
    </select>
    <textarea name="kegiatan_jadwal" placeholder="Kegiatan Jadwal" required></textarea>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" {{ $pengajars->isEmpty() ? 'disabled' : '' }}>
    Simpan Jadwal
</button>

</form>

@if($pengajars->isEmpty())
    <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
        Belum ada data pengajar. Silakan <a href="{{ route('admin.pengajar.create') }}" class="underline text-blue-600">tambahkan pengajar</a> terlebih dahulu.
    </div>
@endif

@endsection
