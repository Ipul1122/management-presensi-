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

                <!-- Container untuk semua form -->
                <div id="formContainer">

                    <!-- Satu set form pendaftaran -->
                    <div class="form-pendaftaran border rounded-2xl p-6 mb-6 bg-white relative">
                        <button type="button" class="btnHapusForm absolute top-2 right-2 text-red-500 hover:text-red-700 hidden">
                            ✕
                        </button>

                        <!-- Foto Anak -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-4">
                                Foto Anak <span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                                <div class="relative">
                                    <div class="w-32 h-32 border-3 border-dashed border-gray-300 rounded-2xl flex items-center justify-center overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 transition-all duration-300 hover:border-blue-400 group">
                                        <img src="#" alt="Preview" class="previewFoto w-full h-full object-cover rounded-2xl hidden">
                                        <div class="placeholder text-center">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2 group-hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-xs text-gray-500 font-medium">Upload Foto</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center sm:text-left">
                                    <label class="cursor-pointer">
                                        <div class="inline-flex items-center px-6 py-3 border-2 border-blue-200 rounded-xl shadow-sm text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            Pilih Foto
                                        </div>
                                        <input type="file" name="foto_anak[]" accept=".jpg,.jpeg,.png" class="sr-only inputFoto" required>
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2">JPG, JPEG, PNG (Maksimal 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Grid Form -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Anak <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_anak[]" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" placeholder="Masukkan nama lengkap anak" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <select name="jenis_kelamin[]" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                                    <input type="text" name="ayah[]" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" placeholder="Masukkan nama ayah" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                                    <input type="text" name="ibu[]" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" placeholder="Masukkan nama ibu" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label>
                                    <select name="kelas[]" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" required>
                                        <option value="">Pilih Kelas</option>
                                        @for ($i = 1; $i <= 9; $i++)
                                            <option value="{{ $i }}">Kelas {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nomor Telepon <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="nomor_telepon[]" id 
                                        class="w-full border-2 border-gray-200 rounded-xl py-3 px-4 nomor-telepon" 
                                        placeholder="Masukkan nomor telepon" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Daftar <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_daftar[]" value="{{ date('Y-m-d') }}" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Al-Kitab <span class="text-red-500">*</span></label>
                                    <select name="jenis_alkitab[]" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4" required>
                                        <option value="">Pilih Al-Kitab</option>
                                        <option value="iqro">Iqro</option>
                                        <option value="Al-Quran">Al-Qur'an</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                                    <textarea name="alamat[]" rows="4" class="w-full border-2 border-gray-200 rounded-xl py-3 px-4 resize-none" placeholder="Masukkan alamat lengkap" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Tombol Tambah Daftar -->
                <div class="mt-6">
                    <button type="button" id="btnTambahDaftar" class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700">
                        + Tambah Daftar
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-12 pt-8 border-t border-gray-200 space-y-4 sm:space-y-0">
                    <a href="{{ route('admin.murid.index') }}" 
                        class="inline-flex items-center px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400">
                        Kembali
                    </a>
                    <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700">
                        Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>

document.getElementById('btnTambahDaftar').addEventListener('click', function () {
    let container = document.getElementById('formContainer');
    let originalForm = container.querySelector('.form-pendaftaran');
    let clone = originalForm.cloneNode(true);

    // Reset semua input di clone
    clone.querySelectorAll('input, textarea, select').forEach(function (el) {
        el.value = '';
        if (el.type === 'file') el.value = null;
    });

    // Tampilkan tombol hapus
    clone.querySelector('.btnHapusForm').classList.remove('hidden');

    // Reset preview foto
    clone.querySelector('.previewFoto').classList.add('hidden');
    clone.querySelector('.placeholder').classList.remove('hidden');

    container.appendChild(clone);
});

// Event hapus form
document.addEventListener('click', function(e){
    if(e.target.classList.contains('btnHapusForm')){
        e.target.closest('.form-pendaftaran').remove();
    }
});

// Event preview foto
document.addEventListener('change', function(e){
    if(e.target.classList.contains('inputFoto')){
        let file = e.target.files[0];
        let preview = e.target.closest('.form-pendaftaran').querySelector('.previewFoto');
        let placeholder = e.target.closest('.form-pendaftaran').querySelector('.placeholder');

        if(file){
            let reader = new FileReader();
            reader.onload = function(evt){
                preview.src = evt.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }
});

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