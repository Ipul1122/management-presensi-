@extends('components.layouts.admin')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Data Murid</h2>

    <form action="{{ route('admin.murid.update', $murid->id_pendaftaran) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label>Nama Anak:</label>
            <input type="text" name="nama_anak" required>
        </div>
        <div>
            <label>Foto Anak (kosongkan jika tidak diubah):</label>
            <input type="file" name="foto_anak" class="border w-full p-2">
        </div>
        <div>
            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" class="border w-full p-2">
                <option {{ $murid->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option {{ $murid->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label>Alamat:</label>
            <textarea name="alamat" class="border w-full p-2">{{ $murid->alamat }}</textarea>
        </div>
        <div>
            <label>Kelas:</label>
            <input type="text" name="kelas" class="border w-full p-2" value="{{ $murid->kelas }}">
        </div>
        <div>
            <label>Tanggal Daftar:</label>
            <input type="date" name="tanggal_daftar" class="border w-full p-2" value="{{ $murid->tanggal_daftar }}">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
