@extends('components.layouts.pengajar.sidebar');

@section('sidebar-pengajar')
    
<div class="p-4 sm:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Informasi Data Pengajar</h1>
        <p class="text-gray-600 text-sm sm:text-base">Kelola dan lihat informasi lengkap pengajar</p>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Table Header with Gradient -->
                <thead class="bg-gradient-to-r from-blue-400 to-indigo-600">
                    <tr>
                        <th class="px-3 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>No</span>
                            </div>
                        </th>
                        <th class="px-3 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Nama Pengajar</span>
                            </div>
                        </th>
                        <th class="px-3 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white uppercase tracking-wider hidden sm:table-cell">
                            <div class="flex items-center space-x-1">
                                <span>Jenis Kelamin</span>
                            </div>
                        </th>
                        <th class="px-3 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Foto</span>
                            </div>
                        </th>
                        <th class="px-3 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white uppercase tracking-wider hidden md:table-cell">
                            <div class="flex items-center space-x-1">
                                <span>Deskripsi</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                
                <!-- Table Body -->
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($pengajars as $index => $pengajar)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- Number Column -->
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">
                                        {{ $pengajars->firstItem() + $index }}
                                    </span>
                                </div>
                            </td>
                            
                            <!-- Name Column -->
                            <td class="px-3 sm:px-6 py-4">
                                <div class="flex flex-col">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $pengajar->nama_pengajar }}
                                    </div>
                                    <!-- Show gender on mobile -->
                                    <div class="text-xs text-gray-500 sm:hidden">
                                        {{ $pengajar->jenis_kelamin }}
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Gender Column (Hidden on mobile) -->
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $pengajar->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $pengajar->jenis_kelamin }}
                                </span>
                            </td>
                            
                            <!-- Photo Column -->
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($pengajar->foto_pengajar)
                                        <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                            alt="Foto {{ $pengajar->nama_pengajar }}" 
                                            class="h-12 w-12 sm:h-14 sm:w-14 rounded-full object-cover border-3 border-white shadow-md ring-2 ring-gray-200 cursor-pointer hover:ring-blue-400 hover:scale-105 transition-all duration-200"
                                            onclick="openImageModal('{{ asset('storage/' . $pengajar->foto_pengajar) }}', '{{ $pengajar->nama_pengajar }}')">
                                    @else
                                        <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-semibold text-lg shadow-md ring-2 ring-gray-200">
                                            {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Description Column (Hidden on mobile and tablet) -->
                            <td class="px-3 sm:px-6 py-4 hidden md:table-cell">
                                <div class="text-sm text-gray-700 max-w-xs">
                                    <p class="line-clamp-2">{{ $pengajar->deskripsi }}</p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-sm font-medium text-gray-900">Belum ada data pengajar</h3>
                                        <p class="text-xs text-gray-500 mt-1">Data pengajar akan ditampilkan di sini</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        <div class="bg-white rounded-lg shadow border border-gray-200 p-1">
            {{ $pengajars->links('pagination::simple-tailwind') }}
        </div>
    </div>
</div>

<!-- Image Modal for Full View -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center z-50 hidden">
    <div class="relative max-w-4xl max-h-screen p-4">
        <!-- Close Button -->
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors duration-200">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Image Container -->
        <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
            <div class="p-4 bg-gradient-to-r from-blue-400 to-indigo-600">
                <h3 id="modalTitle" class="text-white font-semibold text-lg"></h3>
            </div>
            <div class="p-4 flex justify-center">
                <img id="modalImage" src="" alt="" class="max-w-full max-h-96 object-contain rounded-lg shadow-md">
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    // Function to open image modal
    function openImageModal(imageSrc, teacherName) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        
        modalImage.src = imageSrc;
        modalImage.alt = 'Foto ' + teacherName;
        modalTitle.textContent = 'Foto ' + teacherName;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
    
    // Function to close image modal
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto'; // Restore background scrolling
    }
    
    // Close modal when clicking outside the image
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
@endsection