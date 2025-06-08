@extends('components.layouts.pengajar')
@section('content')

    <div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Absensi Murid</h2>

    <form action="{{ route('pengajar.muridAbsensi.update', $absensi->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <label for="nama_murid" class="block font-semibold">Nama Murid</label>
        <select name="nama_murid" id="nama_murid" class="w-full border rounded p-2" required>
            <option value="">-- Pilih Murid --</option>
            @foreach($murids as $murid)
                <option value="{{ $murid->nama_anak }}" {{ $absensi->nama_murid == $murid->nama_anak ? 'selected' : '' }}>
                    {{ $murid->nama_anak }}
                </option>
            @endforeach
        </select>

        <label class="block font-semibold">Jenis Kelamin</label>
        <input type="text" name="jenis_kelamin" value="{{ $absensi->jenis_kelamin }}" class="w-full border rounded p-2" readonly>

        <label class="block font-semibold">Jenis Bacaan</label>
        <input type="text" name="jenis_bacaan" value="{{ $absensi->jenis_bacaan }}" class="w-full border rounded p-2" readonly>

        <label class="block font-semibold">Status Kehadiran</label>
        <select name="jenis_status" class="w-full border rounded p-2" required>
            <option value="">-- Pilih Status --</option>
            <option value="hadir" {{ $absensi->jenis_status == 'hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="izin" {{ $absensi->jenis_status == 'izin' ? 'selected' : '' }}>Izin</option>
        </select>

        <label class="block font-semibold">Tanggal Absen</label>
        <input type="date" name="tanggal_absen" value="{{ $absensi->tanggal_absen }}" class="w-full border rounded p-2" required>

        <label class="block font-semibold">Catatan</label>
        <textarea name="catatan" rows="3" class="w-full border rounded p-2">{{ $absensi->catatan }}</textarea>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update Absensi
        </button>
    </form>
</div>

@endsection