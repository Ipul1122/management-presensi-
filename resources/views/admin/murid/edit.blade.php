    @extends('components.layouts.admin')
    @section('content')
    <div class="p-6">
        <h1 class="text-xl font-semibold mb-4">Edit Data Murid</h1>

        <form action="{{ route('admin.murid.update', $murid->id_pendaftaran) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_anak" class="block text-sm font-medium">Nama Anak</label>
                <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak', $murid->nama_anak) }}" required
                    class="input-field w-full border p-2 rounded">
            </div>

            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full border p-2 rounded">
                    <option value="Laki-laki" {{ $murid->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $murid->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $murid->alamat) }}" required
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label for="kelas" class="block text-sm font-medium">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $murid->kelas) }}" required
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label for="tanggal_daftar" class="block text-sm font-medium">Tanggal Daftar</label>
                <input type="date" name="tanggal_daftar" id="tanggal_daftar" value="{{ old('tanggal_daftar', $murid->tanggal_daftar) }}" required
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label for="foto_anak" class="block text-sm font-medium">Ubah Foto Anak (opsional)</label>
                <input type="file" name="foto_anak" id="foto_anak" accept=".jpg,.jpeg,.png"
                    class="w-full border p-2 rounded">
                @if($murid->foto_anak)
                    <img src="{{ asset('storage/foto_anak/' . $murid->foto_anak) }}" class="mt-2 h-24 rounded border">
                @endif
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Perubahan</button>
        </form>
    </div>
    @endsection
