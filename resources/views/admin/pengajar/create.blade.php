@extends('components.layouts.admin.sidebar-and-navbar')


@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-green-100 to-emerald-50 p-4 md:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-600 to-emerald-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-green-800 mb-2">Tambah Pengajar Baru</h1>
            <p class="text-green-600 text-lg">Lengkapi informasi pengajar dengan detail yang akurat</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-green-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Informasi Pengajar</h2>
                </div>
            </div>

            <form id="pengajarForm" action="{{ route('admin.pengajar.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nama Pengajar -->
                    <div class="md:col-span-2">
                        <label for="nama_pengajar"  class="block text-sm font-semibold text-green-800 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Nama Lengkap Pengajar
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative group">
                            <input type="text" 
                                name="nama_pengajar" 
                                placeholder="Masukkan nama lengkap pengajar" 
                                class="w-full border-2 border-green-200 rounded-xl p-4 pr-12 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-green-50 hover:bg-white group-hover:shadow-md"
                                required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="w-5 h-5 text-green-400 group-focus-within:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-semibold text-green-800 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Jenis Kelamin
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="jenis_kelamin" 
                                    class="w-full border-2 border-green-200 rounded-xl p-4 pr-12 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-green-50 hover:bg-white appearance-none cursor-pointer"
                                    required>
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Laki-laki">👨 Laki-laki</option>
                                <option value="Perempuan">👩 Perempuan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-green-800 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Foto Pengajar
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative group">
                            <input type="file" 
                                name="foto_pengajar" 
                                accept="image/*"
                                id="foto_pengajar"
                                onchange="validateImage(this)"
                                class="w-full border-2 border-green-200 rounded-xl p-4 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-green-50 hover:bg-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 cursor-pointer"
                                required>
                            <div class="mt-2 text-xs text-green-600">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Format: JPG, JPEG, PNG. Maksimal 2MB
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-green-800 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Alamat Lengkap
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative group">
                            <textarea name="alamat" 
                                    placeholder="Masukkan alamat lengkap pengajar (jalan, kecamatan, kota, kode pos)" 
                                    rows="3"
                                    class="w-full border-2 border-green-200 rounded-xl p-4 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-green-50 hover:bg-white resize-none"
                                    required></textarea>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-green-800 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Deskripsi & Keahlian
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative group">
                            <textarea name="deskripsi" 
                                    placeholder="Jelaskan keahlian, pengalaman mengajar, spesialisasi, dan hal menarik lainnya tentang pengajar" 
                                    rows="4"
                                    class="w-full border-2 border-green-200 rounded-xl p-4 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-green-50 hover:bg-white resize-none"
                                    required></textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-green-100">
                    <button type="button" 
                            onclick="resetForm()"
                            class="flex-1 sm:flex-none px-8 py-4 border-2 border-green-300 text-green-700 rounded-xl font-semibold hover:bg-green-50 hover:border-green-400 transition-all duration-300 flex items-center justify-center space-x-2 group">
                        <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Reset Form</span>
                    </button>
                    
                    <button type="submit" 
                            class="flex-1 px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center space-x-2 group">
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Simpan Pengajar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Popover for Image Validation -->
<div id="imagePopover" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl border border-red-200 animate-bounce">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-red-800">File Tidak Valid!</h3>
                <p class="text-sm text-red-600">Ukuran atau format file tidak sesuai</p>
            </div>
        </div>
        
        <div class="bg-red-50 rounded-lg p-4 mb-4">
            <h4 class="font-semibold text-red-800 mb-2">Persyaratan File:</h4>
            <ul class="text-sm text-red-700 space-y-1">
                <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Format: JPG, JPEG, atau PNG
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Ukuran maksimal: 2MB
                </li>
            </ul>
        </div>
        
        <div class="flex gap-3">
            <button onclick="closePopover()" 
                    class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                Batal
            </button>
            <button onclick="closePopover()" 
                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                Pilih Ulang
            </button>
        </div>
    </div>
</div>

<script>
function validateImage(input) {
    const file = input.files[0];
    if (file) {
        const maxSize = 2 * 1024 * 1024; // 2MB
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        
        if (file.size > maxSize || !validTypes.includes(file.type)) {
            showPopover();
            input.value = '';
        }
    }
}

function showPopover() {
    document.getElementById('imagePopover').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePopover() {
    document.getElementById('imagePopover').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mengosongkan semua form?')) {
        document.getElementById('pengajarForm').reset();
        
        // Add reset animation
        const formInputs = document.querySelectorAll('input, textarea, select');
        formInputs.forEach(input => {
            input.style.transform = 'scale(0.95)';
            input.style.transition = 'transform 0.2s ease';
            setTimeout(() => {
                input.style.transform = 'scale(1)';
            }, 100);
        });
    }
}

// Add form validation animation
document.getElementById('pengajarForm').addEventListener('submit', function(e) {
    const button = e.target.querySelector('button[type="submit"]');
    button.innerHTML = `
        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        <span>Menyimpan...</span>
    `;
    button.disabled = true;
});

// Enhanced focus animations
document.querySelectorAll('input, textarea, select').forEach(element => {
    element.addEventListener('focus', function() {
        this.style.transform = 'scale(1.02)';
        this.style.transition = 'all 0.3s ease';
    });
    
    element.addEventListener('blur', function() {
        this.style.transform = 'scale(1)';
    });
});

// Close popover when clicking outside
document.getElementById('imagePopover').addEventListener('click', function(e) {
    if (e.target === this) {
        closePopover();
    }
});

// Close popover with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePopover();
    }
});
</script>

<style>
/* Custom animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { transform: translateX(-20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.animate-fadeIn {
    animation: fadeIn 0.6s ease-out forwards;
}

.animate-slideIn {
    animation: slideIn 0.4s ease-out forwards;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #16a34a, #059669);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #15803d, #047857);
}

/* Enhanced form validation styles */
input:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

input:valid:not(:focus):not(:placeholder-shown) {
    border-color: #22c55e;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
}

/* Responsive improvements */
@media (max-width: 640px) {
    .grid-cols-1 {
        gap: 1rem;
    }
    
    .p-6 {
        padding: 1rem;
    }
    
    .text-3xl {
        font-size: 1.875rem;
    }
}
</style>
@endsection