@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-4 px-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Tambah Data Murid
            </h2>
        </div>

        <form action="{{ route('admin.murid.store') }}" method="POST" enctype="multipart/form-data" class="p-6" id="formTambahMurid">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Anak -->
                <div class="form-group">
                    <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="nama_anak" 
                            id="nama_anak" 
                            class="form-input pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" 
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                    </div>
                </div>
            
                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <div class="flex space-x-4 mt-2">
                        <div class="flex items-center">
                            <input 
                                type="radio" 
                                name="jenis_kelamin" 
                                id="laki" 
                                value="Laki-laki" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                checked
                            >
                            <label for="laki" class="ml-2 block text-sm text-gray-700">Laki-laki</label>
                        </div>
                        <div class="flex items-center">
                            <input 
                                type="radio" 
                                name="jenis_kelamin" 
                                id="perempuan" 
                                value="Perempuan" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                            >
                            <label for="perempuan" class="ml-2 block text-sm text-gray-700">Perempuan</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Anak -->
            <div class="form-group mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="foto_anak">Foto Anak <span class="text-red-500">*</span></label>
                <div class="mt-1 flex items-center">
                    <div class="preview-container w-24 h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden bg-gray-50 mr-4">
                        <img id="preview" src="#" alt="Preview" class="max-h-full max-w-full hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" id="placeholder" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <label for="foto_anak" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                            <div class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-auto inline-block">
                                Pilih Foto
                            </div>
                            <input 
                                type="file" 
                                name="foto_anak" 
                                id="foto_anak"
                                accept=".jpg,.jpeg,.png"
                                class="sr-only"
                                required
                            >
                        </label>
                        <p class="text-xs text-gray-500 mt-1">JPG, JPEG, PNG (Maks. 2MB)</p>
                        <div id="foto_error" class="text-sm text-red-500 hidden mt-1"></div>
                        @error('foto_anak')
                            <div class="text-sm text-red-500 mt-1">
                                {{ $message === 'The foto anak may not be greater than 2048 kilobytes.' 
                                    ? 'Foto lebih dari 2MB' 
                                    : $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Kelas -->
                <div class="form-group">
                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <input 
                            type="number" 
                            name="kelas" 
                            id="kelas" 
                            class="form-input pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" 
                            placeholder="Contoh: 1A / TK Kecil"
                            required
                        >
                    </div>
                </div>
                
                <!-- Tanggal Daftar -->
                <div class="form-group">
                    <label for="tanggal_daftar" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Daftar <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input 
                            type="date" 
                            name="tanggal_daftar" 
                            id="tanggal_daftar" 
                            class="form-input pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" 
                            value="{{ date('Y-m-d') }}"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <div class="flex space-x-4 mt-2">
                        <div class="flex items-center">
                            <input 
                                type="radio" 
                                name="jenis_alkitab" 
                                id="iqro" 
                                value="iqro" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                checked
                            >
                            <label for="iqro" class="ml-2 block text-sm text-gray-700">Iqro</label>
                        </div>
                        <div class="flex items-center">
                            <input 
                                type="radio" 
                                name="jenis_alkitab" 
                                id="Al-Quran" 
                                value="Al-Quran" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                            >
                            <label for="Al-Quran" class="ml-2 block text-sm text-gray-700">Al-Quran</label>
                        </div>
                    </div>
                </div>
            
            <!-- Alamat -->
            <div class="form-group mt-6">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <textarea 
                        name="alamat" 
                        id="alamat" 
                        rows="3" 
                        class="form-textarea pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" 
                        placeholder="Masukkan alamat lengkap"
                        required
                    ></textarea>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-between mt-8 space-y-3 sm:space-y-0 sm:space-x-3">
                <div>
                    <a href="{{ route('admin.murid.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Kembali
                    </a>
                </div>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('admin.murid.show', \App\Models\Murid::latest('id_pendaftaran')->first()?->id_pendaftaran ?? 1) }}"
                        class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Data Terbaru
                    </a>
                    <button 
                        type="submit" 
                        class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview foto ketika diupload
    const fotoInput = document.getElementById('foto_anak');
    const previewImg = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const fotoError = document.getElementById('foto_error');
    
    fotoInput.addEventListener('change', function() {
        fotoError.classList.add('hidden');
        
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            // Validasi ukuran file
            if (file.size > maxSize) {
                fotoError.textContent = 'Foto lebih dari 2MB';
                fotoError.classList.remove('hidden');
                fotoInput.value = '';
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }
            
            // Validasi tipe file
            const fileType = file.type;
            if (!['image/jpeg', 'image/jpg', 'image/png'].includes(fileType)) {
                fotoError.textContent = 'Format file harus JPG, JPEG, atau PNG';
                fotoError.classList.remove('hidden');
                fotoInput.value = '';
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }
            
            // Tampilkan preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Form validation
    const form = document.getElementById('formTambahMurid');
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('border-red-500');
                
                // Add error message if it doesn't exist
                let errorMsg = field.parentNode.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('p');
                    errorMsg.className = 'text-sm text-red-500 mt-1 error-message';
                    errorMsg.textContent = 'Field ini wajib diisi';
                    field.parentNode.appendChild(errorMsg);
                }
            } else {
                field.classList.remove('border-red-500');
                
                // Remove error message if it exists
                const errorMsg = field.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    // Remove error styling on input
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('border-red-500');
            const errorMsg = this.parentNode.querySelector('.error-message');
            if (errorMsg) {
                errorMsg.remove();
            }
        });
    });
});
</script>
@endsection