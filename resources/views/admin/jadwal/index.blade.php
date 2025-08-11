@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Jadwal</h1>
                <p class="text-gray-600 text-sm sm:text-base">Kelola jadwal kegiatan dan pengajar</p>
            </div>
            <a href="{{ route('admin.jadwal.create') }}" 
               class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span class="hidden sm:inline">Tambah Jadwal</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Bulk Actions -->
    <form method="POST" action="{{ route('admin.jadwal.bulkDestroy') }}" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <!-- Bulk Delete Button -->
        <div class="mb-4 flex justify-between items-center">
            <div class="flex items-center">
                <input type="checkbox" id="select-all" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="select-all" class="ml-2 text-sm text-gray-700">Pilih Semua</label>
            </div>
            <button type="submit" 
                    onclick="return confirm('Yakin ingin menghapus semua jadwal terpilih?')"
                    class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Terpilih
            </button>
        </div>

        <!-- Schedule Cards - Mobile View -->
        <div class="block lg:hidden space-y-4">
            @forelse($jadwals as $jadwal)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center">
                        <input type="checkbox" name="selected_ids[]" value="{{ $jadwal->id }}" 
                               class="row-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded mr-3">
                        <h3 class="font-semibold text-gray-900 text-sm">{{ $jadwal->nama_jadwal }}</h3>
                    </div>
                </div>
                
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->locale('id')->isoFormat('DD MMM YYYY') }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $jadwal->pukul_jadwal }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                            <span class="text-white text-xs font-medium">
                                {{ strtoupper(substr($jadwal->nama_pengajar_jadwal, 0, 1)) }}
                            </span>
                        </div>
                        {{ $jadwal->nama_pengajar_jadwal }}
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-medium">Kegiatan:</span> {{ $jadwal->kegiatan_jadwal }}
                    </div>
                    <div class="text-sm font-semibold text-green-600">
                        Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" 
                       class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500">Belum ada jadwal</p>
            </div>
            @endforelse
        </div>

        <!-- Desktop Table -->
        <div class="hidden lg:block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <span class="sr-only">Select</span>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengajar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-4">
                                <input type="checkbox" name="selected_ids[]" value="{{ $jadwal->id }}" 
                                       class="row-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $jadwal->nama_jadwal }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->locale('id')->isoFormat('DD MMM YYYY') }}
                                </div>
                                <div class="text-sm text-gray-500">{{ $jadwal->pukul_jadwal }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm font-medium">
                                            {{ strtoupper(substr($jadwal->nama_pengajar_jadwal, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-gray-900">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $jadwal->kegiatan_jadwal }}</td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-green-600">
                                    Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-amber-500 text-white text-xs font-medium rounded-md hover:bg-amber-600 transition-colors duration-200">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-medium rounded-md hover:bg-red-600 transition-colors duration-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-gray-500">Belum ada jadwal</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <!-- Pagination -->
    @if($jadwals->hasPages())
    <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-3">
        {{ $jadwals->links('pagination::simple-tailwind') }}
    </div>
    @endif
</div>

<script>
// Select All functionality
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

// Update select all when individual checkboxes change
document.querySelectorAll('.row-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allCheckboxes = document.querySelectorAll('.row-checkbox');
        const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        const selectAll = document.getElementById('select-all');
        
        if (checkedCheckboxes.length === 0) {
            selectAll.indeterminate = false;
            selectAll.checked = false;
        } else if (checkedCheckboxes.length === allCheckboxes.length) {
            selectAll.indeterminate = false;
            selectAll.checked = true;
        } else {
            selectAll.indeterminate = true;
        }
    });
});
</script>
@endsection