@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header Section with Stats -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Data Murid</h1>
                    <p class="text-blue-100 mt-1">Manajemen data murid terpadu</p>
                </div>
                {{-- Total Murid --}}
                <div class="mt-4 md:mt-0 flex space-x-4">
                <span class="bg-blue-500 bg-opacity-30 text-white px-4 py-2 rounded-lg">
                <span class="block text-sm">Total Murid</span>
                <span class="font-bold text-xl">{{ $murids->total() }}</span>
                </span>
            </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <div class="p-4">
            @if(session('success'))
                <div id="alert-success" class="flex items-center p-4 mb-4 rounded-lg bg-green-50 text-green-800 border-l-4 border-green-500 animate-fade-in">
                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-green-500 rounded-lg p-1.5 hover:bg-green-100" onclick="document.getElementById('alert-success').remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="alert-error" class="flex items-center p-4 mb-4 rounded-lg bg-red-50 text-red-800 border-l-4 border-red-500 animate-fade-in">
                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="ml-3 text-sm font-medium">{{ session('error') }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-red-500 rounded-lg p-1.5 hover:bg-red-100" onclick="document.getElementById('alert-error').remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Action Toolbar -->
        <div class="px-4 py-3 bg-gray-50 border-b flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h7v7H4V4 M13 4h7v4h-7V4 M13 10h7v10h-7V10 "></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.murid.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Murid
                </a>
                <button type="button" id="bulkDeleteBtn" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Terpilih
                    <span id="selectedCount" class="ml-2 bg-red-700 text-white text-xs px-2 py-1 rounded-full hidden">0</span>
                </button>
            </div>
            
            <div class="w-full sm:w-auto">
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari murid..." class="w-full sm:w-64 pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <select id="genderFilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <select id="kitabFilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Al-Kitab</option>
                        <option value="iqro">Iqro</option>
                        <option value="al-quran">Al-Quran</option>
                    </select>
                    <select id="classFilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kelas</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <form id="muridListForm" action="{{ route('admin.murid.bulkDelete') }}" method="POST">
                @csrf
                @method('DELETE')
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <input type="checkbox" id="selectAll" class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4 cursor-pointer">
                                    <span class="ml-2">Pilih</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <span>Nama Anak</span>
                                    <button type="button" class="ml-1 text-gray-400 hover:text-gray-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Al-kitab</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <span>Tanggal Daftar</span>
                                    <button type="button" class="ml-1 text-gray-400 hover:text-gray-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($murids as $index => $murid)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 murid-row">
                            {{-- ID PENDAFTARAN --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="ids[]" value="{{ $murid->id_pendaftaran }}" class="murid-checkbox rounded text-blue-600 focus:ring-blue-500 h-4 w-4 cursor-pointer">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                            {{-- FOTO ANAK --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($murid->foto_anak)
                                        <div class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 border-2 border-white shadow flex-shrink-0">
                                            <img src="{{ asset('storage/' . $murid->foto_anak) }}" class="h-full w-full object-cover" alt="Foto {{ $murid->nama_anak }}">
                                        </div>
                                    @else
                                        <div class="h-12 w-12 rounded-full overflow-hidden bg-blue-100 flex items-center justify-center text-blue-500 flex-shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            {{-- NAMA Anak --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $murid->nama_anak }}</div>
                            </td>
                            {{-- JENIS KELAMIN --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $murid->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $murid->jenis_kelamin }}
                                </span>
                            </td>
                            {{-- ALAMAT --}}
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">{{ $murid->alamat }}</div>
                            </td>
                            {{-- KELAS --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-green-100 text-green-800">
                                    {{ $murid->kelas }}
                                </span>
                            {{-- AL-KITAB --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $murid->jenis_alkitab == 'iqro' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $murid->jenis_alkitab }}
                                </span>
                            </td>
                            {{-- TANGGAL DAFTAR --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($murid->tanggal_daftar)->format('d M Y') }}
                            </td>
                            {{-- ACTIONS --}}
                            {{-- EDIT BUTTON --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.murid.edit', $murid->id_pendaftaran) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-md transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    {{-- DELETE BUTTTON --}}
                                    <button type="button" class="delete-btn text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-md transition-colors duration-200" 
                                        data-id="{{ $murid->id_pendaftaran }}" 
                                        data-name="{{ $murid->nama_anak }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    {{-- VIEW BUTTON --}}
                                    <button type="button" class="view-btn text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 p-2 rounded-md transition-colors duration-200" 
                                        data-id="{{ $murid->id_pendaftaran }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg mt-4">Belum ada data murid.</p>
                                    <a href="{{ route('admin.murid.create') }}" class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        Tambah Murid Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </form>
        </div>

        <!-- Pagination Section -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $murids->links('pagination::simple-tailwind') }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-center mb-1">Konfirmasi Hapus</h3>
            <p class="text-gray-600 text-center mb-5">Apakah Anda yakin ingin menghapus data <span id="deleteModalName" class="font-semibold"></span>?</p>
            
            <div class="flex justify-center space-x-4">
                <button id="cancelDelete" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 font-medium rounded-lg transition-colors duration-200">Batal</button>
                <form id="deleteSingleItemForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Confirmation Modal -->
<div id="bulkDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-center mb-1">Konfirmasi Hapus Massal</h3>
            <p class="text-gray-600 text-center mb-5">Apakah Anda yakin ingin menghapus <span id="bulkDeleteCount" class="font-semibold"></span> data murid yang dipilih?</p>
            
            <div class="flex justify-center space-x-4">
                <button id="cancelBulkDelete" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 font-medium rounded-lg transition-colors duration-200">Batal</button>
                <button id="confirmBulkDelete" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- View Murid Modal -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-lg font-semibold">Detail Murid</h3>
            <button id="closeViewModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6" id="viewModalContent">
            <!-- Content will be loaded dynamically -->
            <div class="animate-pulse">
                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-gray-200 h-24 w-24"></div>
                </div>
                <div class="space-y-4">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    <div class="h-4 bg-gray-200 rounded w-2/3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</ma>

<script>
    



document.addEventListener("DOMContentLoaded", function () {
    // Select all functionality
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".murid-checkbox");
    const selectedCount = document.getElementById("selectedCount");
    const bulkDeleteBtn = document.getElementById("bulkDeleteBtn");

    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll(
            ".murid-checkbox:checked"
        );
        const count = checkedBoxes.length;
        selectedCount.textContent = count;

        if (count > 0) {
            selectedCount.classList.remove("hidden");
        } else {
            selectedCount.classList.add("hidden");
        }
    }

    selectAll.addEventListener("change", function () {
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            updateSelectedCount();

            // Update selectAll checkbox
            const allChecked =
                document.querySelectorAll(".murid-checkbox:not(:checked)")
                    .length === 0;
            selectAll.checked = allChecked && checkboxes.length > 0;
        });
    });

    // Search and filter functionality
    const searchInput = document.getElementById("searchInput");
    const genderFilter = document.getElementById("genderFilter");
    const kitabFilter = document.getElementById("kitabFilter");
    const classFilter = document.getElementById("classFilter");
    const rows = document.querySelectorAll(".murid-row");

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedGender = genderFilter.value;
        const selectedClass = classFilter.value;
        const selectedKitab = kitabFilter.value;

        rows.forEach((row) => {
            const name = row
                .querySelector("td:nth-child(4)")
                .textContent.toLowerCase();
            const gender = row
                .querySelector("td:nth-child(5) span")
                .textContent.trim();
            const kelasElement = row.querySelector("td:nth-child(7) span");
            const kelas = kelasElement ? kelasElement.textContent.trim() : "";
            const kitab = row
                .querySelector("td:nth-child(8) span")
                .textContent.trim().toLowerCase();

            const matchesSearch = name.includes(searchTerm);
            const matchesGender = !selectedGender || gender === selectedGender;
            const matchesClass = !selectedClass || kelas === selectedClass;
            const matchesKitab = !selectedKitab || kitab === selectedKitab;
            const shouldShow = matchesSearch && matchesGender && matchesClass && matchesKitab;
            row.classList.toggle("hidden", !shouldShow);
        });
    }

    searchInput.addEventListener("keyup", filterRows);
    genderFilter.addEventListener("change", filterRows);
    kitabFilter.addEventListener("change", filterRows);
    classFilter.addEventListener("change", filterRows);
// END OF SEARCH AND FILTER FUNCTIONALITY


    // Single delete modal
    const deleteModal = document.getElementById("deleteModal");
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const cancelDelete = document.getElementById("cancelDelete");
    const deleteModalName = document.getElementById("deleteModalName");
    const deleteSingleItemForm = document.getElementById(
        "deleteSingleItemForm"
    );

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");

            deleteModalName.textContent = name;
            deleteSingleItemForm.action = `/admin/murid/${id}`;
            showModal('deleteModal');
        });
    });

    cancelDelete.addEventListener("click", function () {
        hideModal('deleteModal');
    });

    // Close modal if clicked outside
    deleteModal.addEventListener("click", function (e) {
        if (e.target === deleteModal) {
            hideModal('deleteModal');
        }
    });

    // Bulk delete modal
    const bulkDeleteModal = document.getElementById("bulkDeleteModal");
    const bulkDeleteCount = document.getElementById("bulkDeleteCount");
    const cancelBulkDelete = document.getElementById("cancelBulkDelete");
    const confirmBulkDelete = document.getElementById("confirmBulkDelete");
    const muridListForm = document.getElementById("muridListForm");

    bulkDeleteBtn.addEventListener("click", function () {
        const checkedBoxes = document.querySelectorAll(
            ".murid-checkbox:checked"
        );
        const count = checkedBoxes.length;

        if (count === 0) {
            // Show alert if no items selected
            alert("Silakan pilih minimal satu data untuk dihapus.");
            return;
        }

        bulkDeleteCount.textContent = count;
        showModal('bulkDeleteModal');
    });

    cancelBulkDelete.addEventListener("click", function () {
        hideModal('bulkDeleteModal');
    });

    confirmBulkDelete.addEventListener("click", function () {
        muridListForm.submit();
    });

    // Close modal if clicked outside
    bulkDeleteModal.addEventListener("click", function (e) {
        if (e.target === bulkDeleteModal) {
            hideModal('bulkDeleteModal');
        }
    });

    // View murid details modal
    const viewModal = document.getElementById("viewModal");
    const viewButtons = document.querySelectorAll(".view-btn");
    const closeViewModal = document.getElementById("closeViewModal");
    const viewModalContent = document.getElementById("viewModalContent");

    viewButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            showModal('viewModal');

            // Here you would normally make an AJAX request to get the details
            // For now, we'll simulate loading with a timeout
            setTimeout(() => {
                // This would be replaced with actual data from your backend
                const dummyData = {
                    nama_anak: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(4) div").textContent,
                    foto:
                        document
                            .querySelector(`[data-id="${id}"]`)
                            .closest("tr")
                            .querySelector("td:nth-child(3) img")?.src || null,
                    jenis_kelamin: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(5) span")
                        .textContent.trim(),
                    kelas: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(7) span")
                        .textContent.trim(),
                    jenis_alkitab: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(8) span")
                        .textContent.trim(),
                    alamat: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(6) div").textContent,
                    tanggal_daftar: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(9)")
                        .textContent.trim(),
                };

                // Update modal content with the data
                let photoHtml = "";
                if (dummyData.foto) {
                    photoHtml = `<img src="${dummyData.foto}" class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-lg" alt="Foto Murid">`;
                } else {
                    photoHtml = `
                        <div class="h-32 w-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    `;
                }

                viewModalContent.innerHTML = `
                    <div class="flex flex-col items-center mb-6">
                        ${photoHtml}
                        <h3 class="text-xl font-bold mt-4">${
                            dummyData.nama_anak
                        }</h3>
                        <div class="flex space-x-2 mt-2">
                            <span class="px-3 py-1 text-sm font-medium rounded-full ${
                                dummyData.jenis_kelamin.includes("Laki")
                                    ? "bg-blue-100 text-blue-800"
                                    : "bg-pink-100 text-pink-800"
                            }">
                                ${dummyData.jenis_kelamin}
                            </span>
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                ${dummyData.kelas}
                            </span>
                            <span class="px-3 py-1 text-sm font-medium rounded-full ${
                                dummyData.jenis_alkitab.includes("iqro")
                                    ? "bg-blue-100 text-blue-800"
                                    : "bg-pink-100 text-pink-800"
                            }">
                                ${dummyData.jenis_alkitab}
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">ID Pendaftaran</h4>
                                <p class="text-gray-900">${id}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Tanggal Daftar</h4>
                                <p class="text-gray-900">${
                                    dummyData.tanggal_daftar
                                }</p>
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500">Alamat</h4>
                                <p class="text-gray-900">${dummyData.alamat}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="/admin/murid/${id}/edit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Edit
                        </a>
                        <button type="button" class="delete-btn-modal inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200" 
                            data-id="${id}" 
                            data-name="${dummyData.nama_anak}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </div>
                `;

                // Add event listener to the delete button in the modal
                const deleteButtonInModal =
                    viewModalContent.querySelector(".delete-btn-modal");
                deleteButtonInModal.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const name = this.getAttribute("data-name");

                    deleteModalName.textContent = name;
                    deleteSingleItemForm.action = `/admin/murid/${id}`;
                    hideModal('viewModal');
                    showModal('deleteModal');
                });
            }, 500);
        });
    });

    closeViewModal.addEventListener("click", function () {
        hideModal('viewModal');
    });

    // Close modal if clicked outside
    viewModal.addEventListener("click", function (e) {
        if (e.target === viewModal) {
            hideModal('viewModal');
        }
    });

    // Alert auto-close
    const alerts = document.querySelectorAll("#alert-success, #alert-error");
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.classList.add(
                "opacity-0",
                "transition-opacity",
                "duration-500"
            );
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Add animation for table rows
    rows.forEach((row, index) => {
        row.style.opacity = "0";
        row.style.animation = `fadeIn 0.3s ease forwards ${index * 0.05}s`;
    });

    // Tambahkan event listener untuk memastikan filter dijalankan saat halaman dimuat
    filterRows();

    // Tambahkan event listener untuk perubahan pada dropdown kelas
    classFilter.addEventListener("change", function () {
        console.log("Class filter changed to:", this.value);
        filterRows();
    });

    // Update modal visibility functions
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
});

// Add needed CSS animation
document.head.insertAdjacentHTML(
    "beforeend",
    `
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .overflow-x-auto {
                margin: 0 -1rem;
                width: calc(100% + 2rem);
            }
        }
    </style>
`
);

</script>
@endsection