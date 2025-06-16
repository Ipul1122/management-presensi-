@extends('components.layouts.pengajar.sidebar')

@section('sidebar-pengajar')
<div class="max-w-xl mx-auto mt-8 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Absensi Murid</h2>
    <form action="{{ route('pengajar.riwayatMuridAbsensi.update', $absensi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Murid</label>
            <input type="text" name="nama_murid" value="{{ $absensi->nama_murid }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Tanggal Absen</label>
            <input type="date" name="tanggal_absen" value="{{ $absensi->tanggal_absen }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="jenis_status" class="w-full border rounded p-2">
                <option {{ $absensi->jenis_status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                <option {{ $absensi->jenis_status == 'Izin' ? 'selected' : '' }}>Izin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Catatan</label>
            <textarea name="catatan" class="w-full border rounded p-2">{{ $absensi->catatan }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
