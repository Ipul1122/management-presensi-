@extends('components.layouts.admin')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Murid</h2>

    <form action="{{ route('admin.murid.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <!-- Nama Anak -->
        <div>
            <label>Nama Anak</label>
            <input type="text" name="nama_anak" required>
        </div>
    
        <!-- Foto Anak -->
        <div class="mb-4 relative">
            <label class="block mb-1 text-sm font-medium text-gray-700" for="foto_anak">Foto Anak</label>
            <input 
                type="file" 
                name="foto_anak" 
                id="foto_anak"
                accept=".jpg,.jpeg,.png"
                class="w-full border rounded p-2 @error('foto_anak') border-red-500 @enderror"
            >
        
            @error('foto_anak')
                <div 
                    class="absolute z-10 bg-red-500 text-white text-sm rounded py-1 px-2 top-full mt-1 shadow-lg"
                    role="tooltip"
                >
                    {{ $message === 'The foto anak may not be greater than 2048 kilobytes.' 
                        ? 'Foto lebih dari 2MB' 
                        : $message }}
                </div>
            @enderror
        </div>
    
        <!-- Jenis Kelamin -->
        <div>
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
    
        <!-- Alamat -->
        <div>
            <label>Alamat</label>
            <textarea name="alamat" required></textarea>
        </div>
    
        <!-- Kelas -->
        <div>
            <label>Kelas</label>
            <input type="text" name="kelas" required>
        </div>
    
        <!-- Tanggal Daftar -->
        <div>
            <label>Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" required>
        </div>
    
        <button type="submit">Simpan</button>
        <a href="{{ route('admin.murid.show', \App\Models\Murid::latest('id_pendaftaran')->first()?->id_pendaftaran ?? 1) }}"
            class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Lihat Data Terbaru
        </a>
         

    </form>
    
</div>

<script>
    document.getElementById('foto_anak').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
    
        if (file && file.size > maxSize) {
            alert('Foto lebih dari 2MB'); // Atau tampilkan popover jika pakai library seperti Tippy.js
            e.target.value = ""; // Reset input
        }
    });
    </script>    
@endsection
