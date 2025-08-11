@extends('components.layouts.pengajar.sidebar')
@section('sidebar-pengajar')

<style>
/* Custom animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.6s ease-out;
}

/* Smooth hover effects */
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Custom scrollbar untuk table */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<!-- Header dengan Breadcrumb -->
<div class="bg-gradient-to-r from-blue-50 to-indigo-100 p-6 rounded-xl mb-6">
    <nav class="flex items-center space-x-2 text-sm mb-4">
        <a href="{{ route('pengajar.dashboard') }}" class="flex items-center px-3 py-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 text-blue-600 hover:text-blue-800">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>
        <span class="text-gray-400">›</span>
        <span class="text-gray-600 font-medium">Informasi Data Murid</span>
    </nav>
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">📚 Data Murid</h1>
            <p class="text-gray-600">Kelola dan pantau informasi data murid Anda</p>
        </div>
        <div class="hidden md:block">
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <div class="text-2xl font-bold text-blue-600">{{ $totalMurid }}</div>
                <div class="text-sm text-gray-500">Total Murid</div>
            </div>
        </div>
    </div>
</div>

<!-- Cards Summary -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card Laki-laki -->
    <div class="bg-gradient-to-br from-sky-400 to-sky-600 p-6 rounded-xl text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $totalLaki }}</div>
                <div class="text-sky-100 text-sm font-medium">Laki-laki</div>
            </div>
            <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 bg-white bg-opacity-20 rounded-lg p-2">
            <div class="text-xs text-sky-100">Persentase: {{ $totalMurid > 0 ? round(($totalLaki / $totalMurid) * 100, 1) : 0 }}%</div>
        </div>
    </div>

    <!-- Card Perempuan -->
    <div class="bg-gradient-to-br from-pink-400 to-pink-600 p-6 rounded-xl text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $totalPerempuan }}</div>
                <div class="text-pink-100 text-sm font-medium">Perempuan</div>
            </div>
            <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 bg-white bg-opacity-20 rounded-lg p-2">
            <div class="text-xs text-pink-100">Persentase: {{ $totalMurid > 0 ? round(($totalPerempuan / $totalMurid) * 100, 1) : 0 }}%</div>
        </div>
    </div>

    <!-- Card Iqro -->
    <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 p-6 rounded-xl text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $totalIqro }}</div>
                <div class="text-emerald-100 text-sm font-medium">Iqro</div>
            </div>
            <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 bg-white bg-opacity-20 rounded-lg p-2">
            <div class="text-xs text-emerald-100">Persentase: {{ $totalMurid > 0 ? round(($totalIqro / $totalMurid) * 100, 1) : 0 }}%</div>
        </div>
    </div>

    <!-- Card Al-Qur'an -->
    <div class="bg-gradient-to-br from-amber-400 to-amber-600 p-6 rounded-xl text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $totalQuran }}</div>
                <div class="text-amber-100 text-sm font-medium">Al-Qur'an</div>
            </div>
            <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 bg-white bg-opacity-20 rounded-lg p-2">
            <div class="text-xs text-amber-100">Persentase: {{ $totalMurid > 0 ? round(($totalQuran / $totalMurid) * 100, 1) : 0 }}%</div>
        </div>
    </div>
</div>

<!-- Filter dan Search (Optional Enhancement) -->
<div class="bg-white p-6 rounded-xl shadow-sm mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center space-x-4">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Murid</h2>
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ $totalMurid }} murid</span>
        </div>
        {{-- <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium">
                📊 Export Data
            </button>
        </div> --}}
    </div>
</div>

<!-- Table Container dengan responsiveness -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <!-- Desktop Table -->
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Murid</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Bacaan</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($data as $index => $murid)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-medium">
                            {{ $index + 1 }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full {{ $murid->jenis_kelamin == 'Perempuan' ? 'bg-gradient-to-br from-pink-400 to-pink-500' : 'bg-gradient-to-br from-sky-400 to-sky-500' }} flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($murid->nama_murid, 0, 1)) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $murid->nama_murid }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $murid->jenis_kelamin == 'Perempuan' ? 'bg-pink-100 text-pink-800' : 'bg-sky-100 text-sky-800' }}">
                            @if($murid->jenis_kelamin == 'Perempuan')
                                👩 Perempuan
                            @else
                                👨 Laki-laki
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $murid->jenis_bacaan == 'iqro' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            @if($murid->jenis_bacaan == "Iqro")
                                📖 Iqro
                            @else
                                📚 Al-Qur'an
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✅ Aktif
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden divide-y divide-gray-200">
        @foreach ($data as $index => $murid)
        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full {{ $murid->jenis_kelamin == 'Perempuan' ? 'bg-gradient-to-br from-pink-400 to-pink-500' : 'bg-gradient-to-br from-sky-400 to-sky-500' }} flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($murid->nama_murid, 0, 1)) }}
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $murid->nama_murid }}</p>
                        <div class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                            #{{ $index + 1 }}
                        </div>
                    </div>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $murid->jenis_kelamin == 'Perempuan' ? 'bg-pink-100 text-pink-800' : 'bg-sky-100 text-sky-800' }}">
                            @if($murid->jenis_kelamin == 'Perempuan')
                                👩 Perempuan
                            @else
                                👨 Laki-laki
                            @endif
                        </span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $murid->jenis_bacaan == 'iqro' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            @if($murid->jenis_bacaan == "Iqro")
                                📖 Iqro
                            @else
                                📚 Al-Qur'an
                            @endif
                        </span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✅ Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Pagination dengan styling modern -->
<div class="mt-8 flex justify-center">
    <div class="bg-white rounded-lg shadow-sm p-4">
        {{ $data->links('pagination::simple-tailwind') }}
    </div>
</div>

<!-- Footer Info -->
<div class="mt-8 bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-xl">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div class="flex items-center space-x-2 text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm">Total Murid Unik: <strong class="text-gray-800">{{ $totalMurid }}</strong></span>
        </div>
        <div class="mt-2 md:mt-0 text-xs text-gray-500">
            Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
        </div>
    </div>
</div>

@endsection

