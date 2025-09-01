@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="p-4 md:p-6 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">✏️ Edit Jadwal</h1>

        <form action="{{ route('admin.riwayatJadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Jadwal --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jadwal</label>
                <input type="text" name="nama_jadwal" value="{{ old('nama_jadwal', $jadwal->nama_jadwal) }}" 
                       class="w-full border-gray-300 rounded-md" required>
            </div>

            {{-- Tanggal Jadwal --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Jadwal</label>
                <input type="date" name="tanggal_jadwal" value="{{ old('tanggal_jadwal', $jadwal->tanggal_jadwal) }}" 
                       class="w-full border-gray-300 rounded-md" required>
            </div>

            {{-- Nama Pengajar (dropdown/option) --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pengajar</label>
                <select name="nama_pengajar_jadwal" class="w-full border-gray-300 rounded-md" required>
                    <option value="">-- Pilih Pengajar --</option>
                    @foreach ($pengajars as $pengajar)
                        <option value="{{ $pengajar->nama }}" 
                            {{ old('nama_pengajar_jadwal', $jadwal->nama_pengajar_jadwal) == $pengajar->nama ? 'selected' : '' }}>
                            {{ $pengajar->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Catatan/Kegiatan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan/Kegiatan</label>
                <textarea name="kegiatan_jadwal" rows="3" 
                          class="w-full border-gray-300 rounded-md">{{ old('kegiatan_jadwal', $jadwal->kegiatan_jadwal) }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.riwayatJadwal.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
