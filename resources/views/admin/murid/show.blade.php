@extends('components.layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm flex justify-between items-center" role="alert">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-green-700 hover:text-green-900" 
                    onclick="this.parentElement.style.display='none'">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Header Section with Actions -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">
            <span class="border-b-4 border-blue-500 pb-1">Daftar Data Murid</span>
        </h1>
        
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.murid.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-200 shadow-md font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Murid Baru
            </a>
            
            <a href="{{ route('admin.murid.index') }}" 
                class="bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-200 shadow-md font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Card for Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <!-- Table Container with Responsive Scroll -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">#</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">Nama Anak</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">Jenis Kelamin</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">Alamat</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">Kelas</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">Tanggal Daftar</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-700 text-left">Foto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($murids as $murid)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-3 px-4 text-gray-700">{{ $loop->iteration + ($murids->currentPage() - 1) * $murids->perPage() }}</td>
                            <td class="py-3 px-4 text-gray-700 font-medium">{{ $murid->nama_anak }}</td>
                            <td class="py-3 px-4 text-gray-700">
                                @if($murid->jenis_kelamin == 'Laki-laki')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Laki-laki</span>
                                @else
                                    <span class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Perempuan</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-gray-700">{{ $murid->alamat }}</td>
                            <td class="py-3 px-4">
                                <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $murid->kelas }}</span>
                            </td>
                            <td class="py-3 px-4 text-gray-700">{{ \Carbon\Carbon::parse($murid->tanggal_daftar)->format('d M Y') }}</td>
                            <td class="py-3 px-4">
                                @if ($murid->foto_anak)
                                    <img src="{{ asset('storage/' . $murid->foto_anak) }}" 
                                         class="w-14 h-14 object-cover rounded-full border-2 border-gray-200 shadow hover:scale-150 transition-transform duration-300" 
                                         alt="Foto {{ $murid->nama_anak }}">
                                @else
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-500 rounded-full w-14 h-14">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center text-gray-500 bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    <path d="M10 12a1 1 0 100-2 1 1 0 000 2z" />
                                </svg>
                                <p class="text-lg font-medium">Belum ada data murid.</p>
                                <p class="mt-1 text-sm">Silakan tambahkan data murid baru terlebih dahulu.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination with better styling -->
    <div class="mt-6">
        <div class="bg-white rounded-lg shadow-sm p-4">
            {{ $murids->links() }}
        </div>
    </div>
</div>
@endsection