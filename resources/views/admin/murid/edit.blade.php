@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
        <h1 class="text-2xl font-bold text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            Edit Data Murid
        </h1>
    </div>

    <form action="{{ route('admin.murid.update', $murid->id_pendaftaran) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak', $murid->nama_anak) }}" required
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                </div>
            </div>

            <div class="col-span-1">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <select name="jenis_kelamin" id="jenis_kelamin" required 
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                        <option value="Laki-laki" {{ $murid->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $murid->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="col-span-2">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $murid->alamat) }}" required
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                </div>
            </div>

            <div class="col-span-1">
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $murid->kelas) }}" required
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                </div>
            </div>

            <div class="col-span-1">
                <label for="tanggal_daftar" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Daftar</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="date" name="tanggal_daftar" id="tanggal_daftar" value="{{ old('tanggal_daftar', $murid->tanggal_daftar) }}" required
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                </div>
            </div>

            {{-- <div class="col-span-1">
                <label for="jenis_alkitab" class="block text-gray-700 font-bold mb-2">Jenis Alkitab</label>
                    <select name="jenis_alkitab" id="jenis_alkitab" required class="w-full border rounded px-3 py-2">
                    <option value="Iqro" {{ $murid->jenis_alkitab == 'Iqro' ? 'selected' : '' }}>Iqro</option>
                    <option option value="Al-Qur'an" {{ $murid->jenis_alkitab == "Al-Qur'an" ? 'selected' : '' }}>Al-Qur'an</option>
                    </select>
            </div> --}}

            <div class="col-span-1">
                <label for="jenis_alkitab" class="block text-sm font-medium text-gray-700 mb-1">Jenis Al-Kitab</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <select name="jenis_alkitab" id="jenis_alkitab" required 
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                        <option value="iqro" {{ $murid->jenis_alkitab == 'iqro' ? 'selected' : '' }}>Iqro</option>
                        <option value="Al-Quran" {{ $murid->jenis_alkitab == 'Al-Quran' ? 'selected' : '' }}>Al-Quran</option>
                    </select>
                </div>
            </div>


            {{-- ==================================== --}}

            <div class="col-span-2">
                <label for="foto_anak" class="block text-sm font-medium text-gray-700 mb-1">Foto Anak</label>
                <div class="mt-1 flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        @if($murid->foto_anak)
                            <div class="relative group">
                                <img src="{{ asset('storage/foto_anak/' . $murid->foto_anak) }}" alt="Foto Anak" class="h-24 w-24 rounded-full object-cover border-2 border-gray-200">
                                <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                    <span class="text-white text-xs font-medium">Foto Saat Ini</span>
                                </div>
                            </div>
                        @else
                            <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <label class="block">
                            <span class="sr-only">Ubah Foto Anak</span>
                            <input type="file" name="foto_anak" id="foto_anak" accept=".jpg,.jpeg,.png"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition duration-150">
                        </label>
                        <p class="mt-1 text-sm text-gray-500">
                            Format: JPG, JPEG, PNG. Opsional.
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-span-1">
                <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l.4 2M7 13h10l1-2H6.4M5 6h14l1 2H6.4M16 16a2 2 0 11-4 0 2 2 0 014 0zM6 16a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $murid->nomor_telepon) }}" 
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                </div>
            </div>

            <div class="col-span-1">
                <label for="ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                <div class="relative">
                    <input type="text" name="ayah" id="ayah" value="{{ old('ayah', $murid->ayah) }}" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 px-3 py-2">
                </div>
            </div>

            <div class="col-span-1">
                <label for="ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                <div class="relative">
                    <input type="text" name="ibu" id="ibu" value="{{ old('ibu', $murid->ibu) }}" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 px-3 py-2">
                </div>
            </div>

        </div>

        <div class="mt-8 flex items-center justify-between">
            <a href="{{ route('admin.murid.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview foto yang akan diupload
    const fotoInput = document.getElementById('foto_anak');
    const currentFoto = document.querySelector('img[alt="Foto Anak"]');
    
    if (fotoInput && currentFoto) {
        fotoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    currentFoto.src = e.target.result;
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-200');
                
                // Add error message if it doesn't exist
                const errorDiv = field.parentNode.querySelector('.error-message');
                if (!errorDiv) {
                    const errorMessage = document.createElement('p');
                    errorMessage.className = 'mt-1 text-sm text-red-600 error-message';
                    errorMessage.textContent = 'Field ini wajib diisi';
                    field.parentNode.appendChild(errorMessage);
                }
            } else {
                field.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-200');
                const errorDiv = field.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection