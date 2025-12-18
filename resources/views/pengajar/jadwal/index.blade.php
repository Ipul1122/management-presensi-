@extends('components.layouts.pengajar.sidebar')

@section('sidebar-pengajar')
    

<!-- Jadwal Management Section -->
<div class="bg-white shadow-lg border border-gray-100 overflow-hidden mt-10 mb-10 ">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
        <h3 class="text-2xl font-bold text-white flex items-center">
            <i class="fas fa-calendar-alt mr-3"></i>
            Informasi Jadwal
        </h3>
        <p class="text-indigo-100 mt-2">Informasi jadwal kegiatan TPA</p>
    </div>
    
    <div class="p-6">
        <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
            @csrf
            @method('DELETE')

            <!-- Mobile Card Layout (Hidden on desktop) -->
            <div class="block lg:hidden space-y-4">
                @foreach ($jadwalBulanIni as $jadwal)
                    <div class="bg-gradient-to-r from-white to-gray-50 border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="selected_jadwals[]" value="{{ $jadwal->id }}" 
                                    class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500 focus:ring-2">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-calendar-day text-white text-lg"></i>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            @php
                                $today = \Carbon\Carbon::today();
                                $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_jadwal);
                                
                                if ($tanggal->lt($today)) {
                                    $status = 'Selesai';
                                    $statusClass = 'bg-gray-100 text-gray-600';
                                } elseif ($tanggal->isToday()) {
                                    $status = 'Hari Ini';
                                    $statusClass = 'bg-green-100 text-green-700';
                                } else {
                                    $status = 'Akan Datang';
                                    $statusClass = 'bg-blue-100 text-blue-700';
                                }
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ $status }}
                            </span>
                        </div>
                        
                        <div class="space-y-3">
                            <h4 class="font-bold text-lg text-gray-800 leading-tight">{{ $jadwal->nama_jadwal }}</h4>
                            
                            <div class="grid grid-cols-1 gap-3">
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="fas fa-calendar text-indigo-500 w-4"></i>
                                    <span class="text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="fas fa-clock text-emerald-500 w-4"></i>
                                    <span class="text-sm">{{ $jadwal->pukul_jadwal }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="fas fa-user text-blue-500 w-4"></i>
                                    <span class="text-sm">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                </div>
                                
                                <div class="flex items-start space-x-2 text-gray-600">
                                    <i class="fas fa-tasks text-orange-500 w-4 mt-0.5"></i>
                                    <span class="text-sm">{{ $jadwal->kegiatan_jadwal }}</span>
                                </div>
                                
                                {{-- <div class="flex items-start space-x-2 text-gray-600">
                                    <i class="fas fa-tasks text-orange-500 w-4 mt-0.5"></i>
                                    <span class="text-sm">{ $Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}}</span>
                                </div> --}}
                            </div>
                        </div>
                        
                        <!-- Action Buttons for Mobile -->
                        {{-- <div class="flex justify-end mt-4 space-x-2">
                            <button type="button" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-xs rounded-lg hover:shadow-md transition-all duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button type="button" class="px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 text-white text-xs rounded-lg hover:shadow-md transition-all duration-200">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div> --}}
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table Layout (Hidden on mobile) -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full modern-table">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                            {{-- <th class="px-6 py-4 text-left">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                            </th> --}}
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Pukul</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Nama Jadwal</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Pengajar</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Kegiatan</th>
                            {{-- <th class="px-6 py-4 text-left font-semibold text-gray-700">Gaji</th> --}}
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Status</th>
                            {{-- <th class="px-6 py-4 text-left font-semibold text-gray-700">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($jadwalBulanIni as $jadwal)
                            <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200">
                                {{-- <td class="px-6 py-4">
                                    <input type="checkbox" name="selected_jadwals[]" value="{{ $jadwal->id }}" 
                                        class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                                </td> --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        {{-- TANGGAL JADWAL --}}
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d M Y') }}
                                            </div>
                                            {{-- <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('') }}
                                            </div> --}}
                                        </div>
                                    </div>
                                </td>
                                {{-- PUKUL JADWAL --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                        {{-- <i class="fas fa-clock mr-1 text-xs"></i> --}}
                                        {{ $jadwal->pukul_jadwal }}
                                    </span>
                                </td>
                                {{-- NAMA JADWAL --}}
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $jadwal->nama_jadwal }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        {{-- NAMA PENGAJAR --}}
                                        <span class="text-gray-900 font-medium">{{ $jadwal->nama_pengajar_jadwal }}</span>
                                    </div>
                                </td>
                                {{-- KEGIATAN JADWAL --}}
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="text-gray-900 text-sm leading-relaxed">{{ $jadwal->kegiatan_jadwal }}</p>
                                    </div>
                                </td>
                                {{-- GAJI  --}}
                                {{-- <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="text-gray-900 text-sm leading-relaxed">Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}</p>
                                    </div>
                                </td> --}}
                                <td class="px-6 py-4">
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_jadwal);
                                        
                                        if ($tanggal->lt($today)) {
                                            $status = 'Selesai';
                                            $statusClass = 'bg-gray-100 text-gray-600';
                                            $iconClass = 'fas fa-check-circle';
                                        } elseif ($tanggal->isToday()) {
                                            $status = 'Hari Ini';
                                            $statusClass = 'bg-green-100 text-green-700';
                                            $iconClass = 'fas fa-circle text-green-500';
                                        } else {
                                            $status = 'Akan Datang';
                                            $statusClass = 'bg-blue-100 text-blue-700';
                                            $iconClass = 'fas fa-clock text-blue-500';
                                        }
                                    @endphp
                                    {{-- STATUS JADWAL --}}
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                {{-- <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}">
                                            <button type="button" class="p-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:shadow-md transition-all duration-200 group">
                                                <i class="fas fa-edit text-sm group-hover:scale-110 transition-transform"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            {{-- <div class="flex flex-col sm:flex-row items-center justify-between mt-8 space-y-4 sm:space-y-0 p-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border">
                <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 btn-modern group">
                    <i class="fas fa-cog mr-2 group-hover:rotate-180 transition-transform duration-300"></i>
                    MANAGE Jadwal
                </a>

                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 w-full sm:w-auto">
                    <button type="submit" name="action" value="selected" 
                            class="btn-modern bg-gradient-to-r from-red-500 to-rose-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl flex items-center justify-center group" 
                            onclick="return confirm('Hapus jadwal yang dipilih?')">
                        <i class="fas fa-trash-alt mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="hidden sm:inline">Hapus Terpilih</span>
                        <span class="sm:hidden">Hapus Pilihan</span>
                    </button>

                    <form method="POST" action="{{ route('admin.jadwal.bulkDelete') }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="action" value="all">
                        <button type="submit"  
                        class="btn-modern bg-gradient-to-r from-red-700 to-red-900 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl flex items-center justify-center group" 
                        onclick="return confirm('Hapus semua jadwal?')">
                        <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                        Hapus Semua
                    </button>
                </form>

                </div>
            </div>

            <!-- Empty State -->
            @if($jadwalBulanIni->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Jadwal</h3>
                    <p class="text-gray-500 mb-6">Belum ada jadwal yang tersedia untuk bulan ini</p>
                    <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Jadwal Baru
                    </a>
                            </div>
                        @endif
                    </form>
                </div> --}}
            </div>

@endsection