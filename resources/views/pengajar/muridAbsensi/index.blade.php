@extends('components.layouts.pengajar')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border-l-4 border-blue-500">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-blue-800 mb-2">Data Absensi Murid</h2>
                    <p class="text-blue-600">Kelola dan pantau kehadiran murid</p>
                </div>
                <a href="{{ route('pengajar.muridAbsensi.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 focus:ring-4 focus:ring-blue-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Absen Murid
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Murid</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $absensis->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hadir Hari Ini</p>
                        <p class="text-2xl font-bold text-green-800">{{ $absensis->where('jenis_status', 'Hadir')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Izin</p>
                        <p class="text-2xl font-bold text-red-800">{{ $absensis->where('jenis_status', 'Izin')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">Daftar Absensi Murid</h3>
            </div>
            
            <!-- Mobile View -->
            <div class="block md:hidden">
                @foreach ($absensis as $absen)
                    <div class="border-b border-gray-200 p-4 {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-pink-50' : 'bg-sky-50' }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-pink-200' : 'bg-sky-200' }} flex items-center justify-center">
                                    @if($absen->jenis_kelamin == 'Perempuan')
                                        <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $absen->nama_murid }}</h4>
                                    <p class="text-sm {{ $absen->jenis_kelamin == 'Perempuan' ? 'text-pink-600' : 'text-sky-600' }}">
                                        {{ $absen->jenis_kelamin }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $absen->jenis_status == 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $absen->jenis_status }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-500">Jenis Bacaan:</span>
                                <p class="font-medium text-blue-700">{{ $absen->jenis_bacaan }}</p>
                            </div>
                            <div>
                                <span class="text-gray-500">Tanggal:</span>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        
                        @if($absen->catatan)
                            <div class="mt-3 p-2 bg-gray-50 rounded">
                                <span class="text-gray-500 text-sm">Catatan:</span>
                                <p class="text-sm text-gray-700 mt-1">{{ $absen->catatan }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Nama Murid</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Jenis Bacaan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Tanggal Absen</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($absensis as $absen)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-pink-25' : 'bg-sky-25' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-pink-200' : 'bg-sky-200' }} flex items-center justify-center">
                                            @if($absen->jenis_kelamin == 'Perempuan')
                                                <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $absen->nama_murid }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full 
                                        {{ $absen->jenis_kelamin == 'Perempuan' ? 'bg-pink-100 text-pink-800' : 'bg-sky-100 text-sky-800' }}">
                                        {{ $absen->jenis_kelamin }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-blue-700 font-medium">{{ $absen->jenis_bacaan }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                        {{ $absen->jenis_status == 'Hadir' ?  'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $absen->jenis_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($absen->catatan)
                                        <div class="max-w-xs">
                                            <p class="text-sm text-gray-600 truncate" title="{{ $absen->catatan }}">
                                                {{ $absen->catatan }}
                                            </p>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">Tidak ada catatan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 bg-white rounded-lg shadow-md p-4">
            {{ $absensis->links() }}
        </div>
    </div>
</div>

<style>
.bg-pink-25 {
    background-color: #fef7f7;
}
.bg-sky-25 {
    background-color: #f0f9ff;
}
</style>
@endsection