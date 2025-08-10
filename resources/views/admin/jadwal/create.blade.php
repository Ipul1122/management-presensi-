@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')

    <style>
    @media (    max-width: 640px) {
        .min-h-screen {
            padding: 1rem;
        }
        
        .grid-cols-1 {
            grid-template-columns: 1fr;
        }
        
        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }
    }
    
    /* Custom focus states */
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Smooth animations */
    * {
        transition: all 0.2s ease-in-out;
    }
    
    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 6px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Jadwal</h1>
            </div>
            <p class="text-gray-600">Buat jadwal baru untuk kegiatan pembelajaran</p>
        </div>

        <!-- Warning Message -->
        @if($pengajars->isEmpty())
            <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-400 p-4 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-amber-800">
                            <span class="font-medium">Perhatian!</span> Belum ada data pengajar. Silakan 
                            <a href="{{ route('admin.pengajar.create') }}" class="font-medium text-blue-600 hover:text-blue-500 underline decoration-2 underline-offset-2 transition-colors duration-200">tambahkan pengajar</a> 
                            terlebih dahulu.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Informasi Jadwal</h2>
                <p class="text-blue-100 text-sm mt-1">Lengkapi semua field yang diperlukan</p>
            </div>
            
            <form method="POST" action="{{ route('admin.jadwal.store') }}" class="p-6 space-y-6">
    @csrf

    <div id="jadwal-container" class="space-y-8">
        <!-- Satu blok jadwal -->
        <div class="jadwal-item border border-gray-200 rounded-xl p-4 relative bg-gray-50">
            <button type="button" class="remove-jadwal absolute top-2 right-2 text-red-500 hover:text-red-700 hidden">
                ✕
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Nama Jadwal -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Jadwal<span class="text-red-500">*</span></label>
                    <input type="text" name="nama_jadwal[]" placeholder="Masukkan nama jadwal" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 hover:bg-white">
                </div>

                <!-- Tanggal Jadwal -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Tanggal Jadwal<span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_jadwal[]" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 hover:bg-white">
                </div>

               <!-- Pukul Jadwal -->
<div class="space-y-2">
    <label class="block text-sm font-semibold text-gray-700">
        Waktu Jadwal <span class="text-red-500">*</span>
    </label>
    <input 
    type="text" 
    name="pukul_jadwal[]" 
    value="16:00 - 17:00" 
    readonly 
    required
    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed"
/>

</div>

                <!-- Pengajar -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Pengajar</label>
                    @foreach($pengajars as $pengajar)
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="nama_pengajar_jadwal[0][]" value="{{ $pengajar->nama_pengajar }}"
                                class="form-checkbox text-blue-600">
                            <span class="ml-2">{{ $pengajar->nama_pengajar }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Kegiatan -->
            <div class="mt-4 space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Kegiatan Jadwal<span class="text-red-500">*</span></label>
                <textarea name="kegiatan_jadwal[]" rows="4" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 hover:bg-white resize-none"
                    placeholder="Deskripsikan kegiatan..."></textarea>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah Jadwal -->
    <div>
        <button type="button" id="add-jadwal" 
            class="px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition">
            + Tambah Jadwal
        </button>
    </div>

    <!-- Tombol Submit -->
    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="history.back()" 
            class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50">Batal</button>
        <button type="submit" 
            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700">
            Simpan Jadwal
        </button>
    </div>
</form>
        </div>
    </div>
</div>

<!-- Additional CSS for better mobile experience -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('jadwal-container');
    const addBtn = document.getElementById('add-jadwal');

    addBtn.addEventListener('click', function() {
    const firstJadwal = container.querySelector('.jadwal-item');
    const newJadwal = firstJadwal.cloneNode(true);

    // Reset input & checkbox
    newJadwal.querySelectorAll('input, textarea').forEach(input => {
        if (input.type === 'checkbox') {
            input.checked = false;
        } else if (input.name === 'pukul_jadwal[]') {
            // Tetapkan default waktu
            input.value = '16:00 - 17:00';
        } else {
            input.value = '';
        }
    });

    // Ubah index pengajar agar unik
    const index = container.querySelectorAll('.jadwal-item').length;
    newJadwal.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.name = `nama_pengajar_jadwal[${index}][]`;
    });

    // Tampilkan tombol hapus
    newJadwal.querySelector('.remove-jadwal').classList.remove('hidden');

    container.appendChild(newJadwal);
});


    // Event hapus jadwal
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-jadwal')) {
            e.target.closest('.jadwal-item').remove();
        }
    });
});
</script>

@endsection