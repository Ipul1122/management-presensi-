@extends('components.layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 p-4 md:p-6">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-green-100">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-green-700 to-emerald-600 bg-clip-text text-transparent">
                    Daftar Pengajar
                </h1>
                <p class="text-green-600 mt-1">Kelola data pengajar dengan mudah</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <button onclick="bulkDelete()" 
                        class="group relative overflow-hidden bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:from-red-600 hover:to-red-700 hover:shadow-lg hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                        id="bulk-delete-btn" disabled>
                    <span class="relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Terpilih
                    </span>
                    <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                </button>
                <a href="{{ route('admin.pengajar.create') }}" 
                class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:from-green-700 hover:to-emerald-700 hover:shadow-lg hover:scale-105 active:scale-95">
                    <span class="relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Pengajar
                    </span>
                    <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                </a>
                <a href="{{ route('admin.dashboard') }}">
                    <button class="text-sm text-green-600 hover:text-green-800 underline transition-colors duration-200">
                        Kembali ke Dashboard
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-green-100 overflow-hidden animate-slide-up">
        <!-- Search and Filter Bar -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-6">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <!-- Search Input -->
                <div class="relative flex-1 max-w-md">
                    <input type="text" id="search-input" placeholder="Cari pengajar..." 
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-green-200 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 bg-white/80">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Gender Filter -->
                <div class="flex flex-col sm:flex-row gap-3 items-center">
                    <label class="text-sm font-medium text-green-700">Filter Jenis Kelamin:</label>
                    <div class="flex gap-2">
                        <button type="button" id="filter-all" onclick="filterByGender('all')" 
                                class="filter-btn active px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-green-600 text-white shadow-md hover:shadow-lg">
                            Semua
                        </button>
                        <button type="button" id="filter-male" onclick="filterByGender('Laki-laki')" 
                                class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-white text-green-600 border border-green-200 hover:bg-green-50 hover:border-green-300">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                Laki-laki
                            </div>
                        </button>
                        <button type="button" id="filter-female" onclick="filterByGender('Perempuan')" 
                                class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-white text-green-600 border border-green-200 hover:bg-green-50 hover:border-green-300">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                Perempuan
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Results Counter -->
                <div class="text-sm text-green-600 bg-green-100 px-4 py-2 rounded-lg whitespace-nowrap">
                    Total: <span class="font-semibold" id="results-count">{{ count($pengajars) }}</span> pengajar
                </div>
            </div>

            <!-- Clear Filters Button -->
            <div class="mt-4 flex justify-end">
                <button type="button" id="clear-filters" onclick="clearAllFilters()" 
                        class="text-sm text-green-600 hover:text-green-800 underline transition-colors duration-200 hidden">
                    Hapus semua filter
                </button>
            </div>
        </div>

        <!-- Table -->
        <form id="bulk-delete-form" method="POST" action="{{ route('admin.pengajar.bulkDelete') }}">
            @csrf
            @method('DELETE')
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-green-700 to-emerald-700 text-white">
                            <th class="py-4 px-6 text-left">
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" onclick="toggleAll(this)" 
                                        class="w-5 h-5 text-green-600 bg-white border-2 border-green-300 rounded focus:ring-green-500 focus:ring-2 transition-all duration-200">
                                    <span class="ml-2 text-sm font-medium group-hover:text-green-100 transition-colors">Pilih</span>
                                </label>
                            </th>
                            <th class="py-4 px-6 text-left font-semibold">ID</th>
                            <th class="py-4 px-6 text-left font-semibold">Nama</th>
                            <th class="py-4 px-6 text-left font-semibold">Jenis Kelamin</th>
                            <th class="py-4 px-6 text-left font-semibold hidden md:table-cell">Alamat</th>
                            <th class="py-4 px-6 text-left font-semibold">Foto</th>
                            <th class="py-4 px-6 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-green-100" id="table-body">
                        @foreach ($pengajars as $index => $pengajar)
                            <tr class="group hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 transition-all duration-300 animate-fade-in-row" 
                                style="animation-delay: {{ $index * 0.1 }}s" data-search="{{ strtolower($pengajar->nama_pengajar . ' ' . $pengajar->jenis_kelamin . ' ' . $pengajar->alamat) }}">
                                <td class="py-4 px-6">
                                    <input type="checkbox" name="ids[]" value="{{ $pengajar->id_pendaftaran }}" 
                                        class="row-checkbox w-5 h-5 text-green-600 bg-white border-2 border-green-300 rounded focus:ring-green-500 focus:ring-2 transition-all duration-200"
                                        onchange="updateBulkDeleteButton()">
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{-- ID PENGAJAR --}}
                                        {{ $pengajar->id_pendaftaran }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            {{-- FOTO PENGAJAR --}}
                                            @if($pengajar->foto_pengajar)
                                                <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                                    alt="foto" class="h-10 w-10 rounded-full object-cover border-2 border-green-200">
                                            @else
                                            {{-- NAMA PENGAJAR --}}
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-semibold">
                                                    {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $pengajar->nama_pengajar }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        {{-- JENIS KELAMIN --}}
                                    {{ $pengajar->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                        {{ $pengajar->jenis_kelamin }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $pengajar->alamat }}">
                                        {{-- ALAMAT PENGAJAR --}}
                                        {{ $pengajar->alamat }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    {{-- FOTO PENGAJAR --}}
                                    @if($pengajar->foto_pengajar)
                                        <button onclick="showImage('{{ asset('storage/' . $pengajar->foto_pengajar) }}')" 
                                                class="relative group cursor-pointer">
                                            <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                                alt="foto" class="w-12 h-12 object-cover rounded-lg border-2 border-green-200 group-hover:border-green-400 transition-all duration-300">
                                            <div class="absolute inset-0 bg-black/20 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </div>
                                        </button>
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.pengajar.show', $pengajar->id_pendaftaran) }}" 
                                        class="group p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:scale-110 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.pengajar.edit', $pengajar->id_pendaftaran) }}" 
                                        class="group p-2 rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 hover:scale-110 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.pengajar.destroy', $pengajar->id_pendaftaran) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="group p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200" 
                                                    onclick="return confirm('Yakin ingin menghapus pengajar {{ $pengajar->nama_pengajar }}?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-full">
        <img id="modal-image" src="" alt="Preview" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fade-in-row {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.8s ease-out;
}

.animate-fade-in-row {
    animation: fade-in-row 0.5s ease-out forwards;
    opacity: 0;
}

/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: linear-gradient(to right, #059669, #10b981);
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to right, #047857, #059669);
}

/* Filter button styles */
.filter-btn.active {
    background: linear-gradient(to right, #059669, #10b981) !important;
    color: white !important;
    border: none !important;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.filter-btn:not(.active):hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>

<script>
function toggleAll(source) {
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(cb => {
        cb.checked = source.checked;
        cb.dispatchEvent(new Event('change'));
    });
    updateBulkDeleteButton();
}

function updateBulkDeleteButton() {
    const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
    
    if (checkboxes.length > 0) {
        bulkDeleteBtn.disabled = false;
        bulkDeleteBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        bulkDeleteBtn.innerHTML = `
            <span class="relative z-10 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus ${checkboxes.length} Terpilih
            </span>
            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
        `;
    } else {
        bulkDeleteBtn.disabled = true;
        bulkDeleteBtn.classList.add('opacity-50', 'cursor-not-allowed');
        bulkDeleteBtn.innerHTML = `
            <span class="relative z-10 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Terpilih
            </span>
        `;
    }
}

function bulkDelete() {
    const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
    if (checkboxes.length === 0) {
        alert('Pilih minimal satu pengajar untuk dihapus');
        return;
    }
    
    if (confirm(`Yakin ingin menghapus ${checkboxes.length} pengajar yang dipilih?`)) {
        document.getElementById('bulk-delete-form').submit();
    }
}

function showImage(src) {
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    modalImage.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('image-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Search and Filter functionality
let currentGenderFilter = 'all';
let currentSearchTerm = '';

function filterByGender(gender) {
    currentGenderFilter = gender;
    
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('bg-white', 'text-green-600', 'border', 'border-green-200');
        btn.classList.remove('bg-green-600', 'text-white', 'shadow-md');
    });
    
    const activeBtn = document.getElementById(`filter-${gender === 'all' ? 'all' : gender === 'Laki-laki' ? 'male' : 'female'}`);
    activeBtn.classList.add('active');
    activeBtn.classList.remove('bg-white', 'text-green-600', 'border', 'border-green-200');
    activeBtn.classList.add('bg-green-600', 'text-white', 'shadow-md');
    
    applyFilters();
    updateClearFiltersButton();
}

function applyFilters() {
    const rows = document.querySelectorAll('#table-body tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const searchData = row.getAttribute('data-search');
        const genderCell = row.querySelector('td:nth-child(4) span').textContent.trim();
        
        const matchesSearch = currentSearchTerm === '' || searchData.includes(currentSearchTerm);
        const matchesGender = currentGenderFilter === 'all' || genderCell === currentGenderFilter;
        
        if (matchesSearch && matchesGender) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update results counter
    document.getElementById('results-count').textContent = visibleCount;
}

function clearAllFilters() {
    currentGenderFilter = 'all';
    currentSearchTerm = '';
    document.getElementById('search-input').value = '';
    
    // Reset filter buttons
    filterByGender('all');
    
    // Show all rows
    document.querySelectorAll('#table-body tr').forEach(row => {
        row.style.display = '';
    });
    
    // Update counter
    const totalRows = document.querySelectorAll('#table-body tr').length;
    document.getElementById('results-count').textContent = totalRows;
    
    updateClearFiltersButton();
}

function updateClearFiltersButton() {
    const clearBtn = document.getElementById('clear-filters');
    if (currentGenderFilter !== 'all' || currentSearchTerm !== '') {
        clearBtn.classList.remove('hidden');
    } else {
        clearBtn.classList.add('hidden');
    }
}

// Search functionality
document.getElementById('search-input').addEventListener('input', function(e) {
    currentSearchTerm = e.target.value.toLowerCase();
    applyFilters();
    updateClearFiltersButton();
});

// Initialize bulk delete button state
document.addEventListener('DOMContentLoaded', function() {
    updateBulkDeleteButton();
    
    // Add event listeners to all checkboxes
    document.querySelectorAll('.row-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkDeleteButton);
    });
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection