@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8 px-4">
    <div class="max-w-6xl mx-auto">
        

        <!-- Form Container -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-indigo-700 p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Formulir Pendaftaran</h2>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                        <div class="w-2 h-2 bg-white/70 rounded-full"></div>
                        <div class="w-2 h-2 bg-white/50 rounded-full"></div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.murid.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="formTambahMurid">
                @csrf

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-red-800 font-medium">Terdapat kesalahan input:</h3>
                        </div>
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center">
                                    <span class="w-1 h-1 bg-red-500 rounded-full mr-2"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Photo Upload Section -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">
                        Foto Anak <span class="text-red-500">*</span>
                    </label>
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="relative">
                            <div class="w-32 h-32 border-3 border-dashed border-gray-300 rounded-2xl flex items-center justify-center overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 transition-all duration-300 hover:border-blue-400 group">
                                <img id="preview" src="#" alt="Preview" class="w-full h-full object-cover rounded-2xl hidden">
                                <div id="placeholder" class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2 group-hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-xs text-gray-500 font-medium">Upload Foto</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <label for="foto_anak" class="cursor-pointer">
                                <div class="inline-flex items-center px-6 py-3 border-2 border-blue-200 rounded-xl shadow-sm text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    Pilih Foto
                                </div>
                            </label>
                            <input type="file" name="foto_anak" id="foto_anak" accept=".jpg,.jpeg,.png" class="sr-only" required>
                            <p class="text-xs text-gray-500 mt-2">JPG, JPEG, PNG (Maksimal 2MB)</p>
                            <div id="foto_error" class="text-sm text-red-500 hidden mt-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Form Fields Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Nama Anak -->
                        <div class="form-group">
                            <label for="nama_anak" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Anak <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="nama_anak" id="nama_anak" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                    placeholder="Masukkan nama lengkap anak" required>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group">
                            <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                </div>
                                <select name="jenis_kelamin" id="jenis_kelamin" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 appearance-none bg-white" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Nama Ayah -->
                        <div class="form-group">
                            <label for="ayah" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Ayah <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="ayah" id="ayah" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                    placeholder="Masukkan nama ayah" required>
                            </div>
                        </div>

                        <!-- Nama Ibu -->
                        <div class="form-group">
                            <label for="ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Ibu <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="ibu" id="ibu" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                    placeholder="Masukkan nama ibu" required>
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div class="form-group">
                            <label for="kelas" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <select name="kelas" id="kelas" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 appearance-none bg-white" required>
                                    <option value="">Pilih Kelas</option>
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}">Kelas {{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Nomor Telepon -->
                        <div class="form-group">
                            <label for="nomor_telepon" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="tel" name="nomor_telepon" id="nomor_telepon" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                    placeholder="Masukkan nomor telepon" required>
                            </div>
                        </div>

                        <!-- Tanggal Daftar -->
                        <div class="form-group">
                            <label for="tanggal_daftar" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Daftar <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" name="tanggal_daftar" id="tanggal_daftar" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700" 
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <!-- Al-Kitab -->
                        <div class="form-group">
                            <label for="jenis_alkitab" class="block text-sm font-semibold text-gray-700 mb-2">
                                Al-Kitab <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <select name="jenis_alkitab" id="jenis_alkitab" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 appearance-none bg-white" required>
                                    <option value="">Pilih Al-Kitab</option>
                                    <option value="iqro">Iqro</option>
                                    <option value="Al-Quran">Al-Qur'an</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-4 left-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <textarea name="alamat" id="alamat" rows="4" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 text-gray-700 placeholder-gray-400 resize-none" 
                                    placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-12 pt-8 border-t border-gray-200 space-y-4 sm:space-y-0">
                    <a href="{{ route('admin.murid.index') }}" 
                        class="inline-flex items-center px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Kembali
                    </a>
                    
                    <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span id="submitText">Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formTambahMurid');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    
    // Photo preview functionality
    const fotoInput = document.getElementById('foto_anak');
    const previewImg = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const fotoError = document.getElementById('foto_error');
    
    fotoInput.addEventListener('change', function() {
        fotoError.classList.add('hidden');
        
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            // Validate file size
            if (file.size > maxSize) {
                fotoError.textContent = 'Ukuran foto tidak boleh lebih dari 2MB';
                fotoError.classList.remove('hidden');
                fotoInput.value = '';
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }
            
            // Validate file type
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                fotoError.textContent = 'Format file harus JPG, JPEG, atau PNG';
                fotoError.classList.remove('hidden');
                fotoInput.value = '';
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Real-time validation
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
        });
        
        input.addEventListener('blur', function() {
            validateField(this);
        });
    });
    
    function validateField(field) {
        const isValid = field.checkValidity() && field.value.trim() !== '';
        
        if (isValid) {
            field.classList.remove('border-red-500', 'border-red-300');
            field.classList.add('border-green-500');
            removeErrorMessage(field);
        } else if (field.value.trim() !== '') {
            field.classList.remove('border-green-500', 'border-gray-200');
            field.classList.add('border-red-500');
            showErrorMessage(field);
        } else {
            field.classList.remove('border-green-500', 'border-red-500');
            field.classList.add('border-gray-200');
            removeErrorMessage(field);
        }
    }
    
    function showErrorMessage(field) {
        removeErrorMessage(field);
        
        let message = 'Field ini wajib diisi';
        
        if (field.type === 'email') {
            message = 'Format email tidak valid';
        } else if (field.type === 'tel') {
            message = 'Format nomor telepon tidak valid';
        }
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-sm text-red-500 mt-2 flex items-center error-message';
        errorDiv.innerHTML = `
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            ${message}
        `;
        
        field.parentNode.appendChild(errorDiv);
    }
    
    function removeErrorMessage(field) {
        const errorMsg = field.parentNode.querySelector('.error-message');
        if (errorMsg) {
            errorMsg.remove();
        }
    }
    
    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all fields
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            validateField(field);
            if (!field.checkValidity() || field.value.trim() === '') {
                isValid = false;
            }
        });
        
        if (!isValid) {
            // Scroll to first error
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
                firstError.focus();
            }
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        submitText.textContent = 'Menyimpan...';
        
        // Add loading spinner
        const spinner = document.createElement('div');
        spinner.className = 'animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2';
        spinner.id = 'loadingSpinner';
        submitBtn.insertBefore(spinner, submitText);
        
        // Submit form
        setTimeout(() => {
            form.submit();
        }, 500);
    });
    
    // Auto-format phone number
    const phoneInput = document.getElementById('nomor_telepon');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        // Add country code if not present
        if (value.length > 0 && !value.startsWith('62')) {
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            } else {
                value = '62' + value;
            }
        }
        
        // Format the number
        if (value.length > 2) {
            value = value.replace(/^62/, '62 ');
        }
        if (value.length > 6) {
            value = value.replace(/^62 (\d{3})/, '62 $1-');
        }
        if (value.length > 11) {
            value = value.replace(/^62 (\d{3})-(\d{4})/, '62 $1-$2-');
        }
        
        e.target.value = value;
    });
    
    // Auto-capitalize names
    const nameInputs = ['nama_anak', 'ayah', 'ibu'];
    nameInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        input.addEventListener('input', function(e) {
            const words = e.target.value.split(' ');
            const capitalizedWords = words.map(word => {
                if (word.length > 0) {
                    return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                }
                return word;
            });
            e.target.value = capitalizedWords.join(' ');
        });
    });
    
    // Interactive feedback for select fields
    const selectFields = form.querySelectorAll('select');
    selectFields.forEach(select => {
        select.addEventListener('change', function() {
            if (this.value !== '') {
                this.classList.add('text-gray-700');
                this.classList.remove('text-gray-400');
            } else {
                this.classList.add('text-gray-400');
                this.classList.remove('text-gray-700');
            }
        });
    });
    
    // Add smooth transitions to form fields
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.02)';
            this.style.transition = 'all 0.2s ease-in-out';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Progress indicator
    let filledFields = 0;
    const totalFields = form.querySelectorAll('[required]').length;
    
    function updateProgress() {
        filledFields = 0;
        form.querySelectorAll('[required]').forEach(field => {
            if (field.value.trim() !== '') {
                filledFields++;
            }
        });
        
        const progress = (filledFields / totalFields) * 100;
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            progressBar.style.width = progress + '%';
        }
    }
    
    // Add progress bar to header
    const formHeader = document.querySelector('.bg-gradient-to-r.from-blue-600');
    if (formHeader) {
        const progressContainer = document.createElement('div');
        progressContainer.className = 'w-full bg-white/20 rounded-full h-1 mt-4';
        progressContainer.innerHTML = '<div class="progress-bar bg-white h-1 rounded-full transition-all duration-500" style="width: 0%"></div>';
        formHeader.appendChild(progressContainer);
    }
    
    // Update progress on input
    inputs.forEach(input => {
        input.addEventListener('input', updateProgress);
    });
    
    // Initialize progress
    updateProgress();
    
    // Add success animation for completed fields
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim() !== '' && this.checkValidity()) {
                this.classList.add('animate-pulse');
                setTimeout(() => {
                    this.classList.remove('animate-pulse');
                }, 600);
            }
        });
    });
});
</script>

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group {
    animation: slideIn 0.6s ease-out;
}

.form-group:nth-child(odd) {
    animation-delay: 0.1s;
}

.form-group:nth-child(even) {
    animation-delay: 0.2s;
}

input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.error-message {
    animation: slideIn 0.3s ease-out;
}

@media (max-width: 768px) {
    .grid.grid-cols-1.lg\\:grid-cols-2 {
        gap: 1.5rem;
    }
}
</style>
@endsection