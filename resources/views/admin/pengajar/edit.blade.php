@extends('components.layouts.admin.sidebar-and-navbar')


@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 p-4 md:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6 border-l-4 border-green-600">
            <div class="flex items-center space-x-3">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Pengajar</h1>
                    <p class="text-gray-600">Perbarui informasi pengajar dengan lengkap</p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-500 p-6">
                <h2 class="text-xl font-semibold text-white flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Form Edit Data</span>
                </h2>
            </div>

            <form action="{{ route('admin.pengajar.update', $pengajar->id_pendaftaran) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nama Pengajar -->
                    <div class="form-group">
                        <label for="nama_pengajar" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Nama Pengajar</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="text" 
                            id="nama_pengajar"
                            name="nama_pengajar" 
                            value="{{ $pengajar->nama_pengajar }}" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300 bg-gray-50 focus:bg-white" 
                            placeholder="Masukkan nama lengkap pengajar"
                            required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <span>Jenis Kelamin</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select id="jenis_kelamin" 
                                name="jenis_kelamin" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300 bg-gray-50 focus:bg-white" 
                                required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" {{ $pengajar->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $pengajar->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="form-group mt-6">
                    <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Alamat</span>
                            <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <textarea id="alamat" 
                            name="alamat" 
                            rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300 bg-gray-50 focus:bg-white resize-none" 
                            placeholder="Masukkan alamat lengkap pengajar"
                            required>{{ $pengajar->alamat }}</textarea>
                </div>

                <!-- Deskripsi -->
                <div class="form-group mt-6">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Deskripsi</span>
                            <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <textarea id="deskripsi" 
                            name="deskripsi" 
                            rows="4"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300 bg-gray-50 focus:bg-white resize-none" 
                            placeholder="Masukkan deskripsi tentang pengajar, pengalaman, keahlian, dll."
                            required>{{ $pengajar->deskripsi }}</textarea>
                </div>

                <!-- Upload Foto -->
                <div class="form-group mt-6">
                    <label for="foto_pengajar" class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Foto Pengajar</span>
                        </span>
                    </label>
                    <div class="relative">
                        <div class="flex items-center justify-center w-full">
                            <label for="foto_pengajar" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-green-400 transition-all duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG atau GIF (MAX. 2MB)</p>
                                </div>
                                <input id="foto_pengajar" name="foto_pengajar" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        
                        <!-- File name display -->
                        <div id="fileName" class="mt-2 text-sm text-gray-600 hidden">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="fileNameText"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="button" 
                            onclick="history.back()" 
                            class="flex-1 sm:flex-none px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </span>
                    </button>
                    <button type="submit" 
                            class="flex-1 px-8 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-xl hover:from-green-700 hover:to-green-600 transform hover:scale-105 transition-all duration-300 font-medium shadow-lg hover:shadow-xl">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span>Update Data Pengajar</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Popover for file size warning -->
<div id="fileSizePopover" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl p-6 m-4 max-w-sm w-full transform transition-all duration-300">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">Ukuran File Terlalu Besar</h3>
            </div>
        </div>
        <p class="text-gray-600 mb-6">File yang dipilih berukuran lebih dari 2MB. Silakan pilih file dengan ukuran yang lebih kecil.</p>
        <button onclick="closePopover()" class="w-full px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors duration-300">
            Tutup
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('foto_pengajar');
    const fileName = document.getElementById('fileName');
    const fileNameText = document.getElementById('fileNameText');
    const popover = document.getElementById('fileSizePopover');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Check file size (2MB = 2 * 1024 * 1024 bytes)
            const maxSize = 2 * 1024 * 1024;
            
            if (file.size > maxSize) {
                // Show popover
                popover.classList.remove('hidden');
                // Clear the file input
                fileInput.value = '';
                fileName.classList.add('hidden');
                return;
            }
            
            // Show file name
            fileNameText.textContent = file.name;
            fileName.classList.remove('hidden');
        } else {
            fileName.classList.add('hidden');
        }
    });

    // Add smooth focus effects
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('transform', 'scale-105');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('transform', 'scale-105');
        });
    });
});

function closePopover() {
    document.getElementById('fileSizePopover').classList.add('hidden');
}

// Close popover when clicking outside
document.getElementById('fileSizePopover').addEventListener('click', function(e) {
    if (e.target === this) {
        closePopover();
    }
});
</script>

<style>
.form-group {
    transition: all 0.3s ease;
}

.form-group:hover {
    transform: translateY(-1px);
}

/* Custom scrollbar for textareas */
textarea::-webkit-scrollbar {
    width: 6px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

textarea::-webkit-scrollbar-thumb {
    background: #16a34a;
    border-radius: 10px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #15803d;
}

/* Animation for file upload area */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection