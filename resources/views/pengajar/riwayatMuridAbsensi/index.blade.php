@extends('components.layouts.pengajar.sidebar')

@section('sidebar-pengajar')

{{-- Custom CSS untuk animasi dan styling tambahan --}}
<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .hover-scale {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #112aca 100%);
    }
    
    .card-shadow {
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .btn-modern {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .btn-modern:hover {
        background: linear-gradient(45deg, #764ba2, #667eea);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }
    
    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table-row-yellow {
        background-color: #fef3c7 !important;
        transition: all 0.3s ease;
    }
    
    .table-row-yellow:hover {
        background-color: #fde68a !important;
    }
    
    .murid-perempuan {
        background: linear-gradient(135deg, #fce7f3, #f3e8ff);
        color: #be185d;
        font-weight: 600;
    }
    
    .murid-laki {
        background: linear-gradient(135deg, #e0f2fe, #e1f5fe);
        color: #0369a1;
        font-weight: 600;
    }
    
    .hadir-tinggi {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
        font-weight: 700;
    }

    /* Styling untuk indikator data absensi */
    .date-has-data {
        position: relative;
    }
    
    .date-has-data::after {
        content: '•';
        position: absolute;
        top: 2px;
        right: 2px;
        background: #10b981;
        color: white;
        border-radius: 50%;
        width: 8px;
        height: 8px;
        font-size: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    .date-selected.date-has-data::after {
        background: #ffffff;
        color: #10b981;
    }


    
</style>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="text-center mb-8 fade-in">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">📚 Riwayat Absensi Murid</h1>
            <p class="text-gray-600 text-lg">Kelola dan pantau kehadiran murid dengan mudah</p>
        </div>

        {{-- Filter Card --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">📅</span>
                Filter Periode
            </h2>
            
            <form method="GET" action="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="bulan" class="block text-sm font-semibold text-gray-700">Pilih Bulan:</label>
                    <select name="bulan" id="bulan" onchange="this.form.submit()" 
                            class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                        @foreach ($bulanList as $bln)
                            <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($bln)->translatedFormat('F Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        {{-- Rekap Kehadiran Section --}}
        @if (!empty($rekap && count($rekap)) > 0)
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <span class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">📊</span>
                    Rekap Kehadiran
                </h2>
                <div class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                    @if (!empty($bulanDipilih))
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $bulanDipilih)->translatedFormat('F Y') }}
                    @else
                        -
                    @endif
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="gradient-bg  text-white">
                            <th class="px-6 py-4 text-left rounded-tl-xl font-semibold">No</th>
                            <th class="px-6 py-4 text-left font-semibold">Nama Murid</th>
                            <th class="px-6 py-4 text-center rounded-tr-xl font-semibold">Jumlah Hadir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $nama => $jumlah)
                            @php
                                // Ambil gender dari database (gunakan cache sederhana untuk efisiensi)
                                static $genderCache = [];
                                if (!isset($genderCache[$nama])) {
                                    $genderCache[$nama] = \App\Models\Murid::where('nama_anak', $nama)->value('jenis_kelamin');
                                }
                                $jenisKelamin = strtolower($genderCache[$nama] ?? '');
                                $genderClass = $jenisKelamin === 'perempuan' ? 'murid-perempuan' : 'murid-laki';
                            @endphp
                            <tr class="table-row-yellow text-left border-b border-black hover:shadow-md transition-all duration-200 ">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-left">
                                    <span class="px-4 py-[3px] sm:text-left rounded font-semibold {{ $genderClass }}">
                                        {{ $nama }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-4 py-2 rounded-full font-bold {{ $jumlah > 4 ? 'hadir-tinggi' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $jumlah > 4 ? '🌟' : '📈' }} {{ $jumlah }}x
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Filter Detail Section - Updated --}}
<div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
        <span class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">🔍</span>
        Filter Detail
    </h2>
    
    <form method="GET" id="filterForm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Dropdown Bulan --}}
            <div>
                <label for="bulan2" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Bulan</label>
                <select name="bulan" id="bulan2" class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200" onchange="this.form.submit()">
                    @foreach ($bulanList as $bulan)
                        <option value="{{ $bulan }}" {{ $bulan == $bulanDipilih ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Dropdown Murid --}}
            <div>
                <label for="murid" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Murid</label>
                <select name="murid" id="murid" class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200" onchange="this.form.submit()">
                    <option value="">-- Semua Murid --</option>
                    @foreach ($daftarMurid as $murid)
                        @php
                            $jenisKelamin = strtolower($murid->jenis_kelamin ?? '');
                            $genderIcon = $jenisKelamin === 'perempuan' ? '👧' : '👦';
                        @endphp
                        <option value="{{ $murid->nama_murid }}" {{ $murid->nama_murid == $muridDipilih ? 'selected' : '' }}>
                            {{ $genderIcon }} {{ $murid->nama_murid }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Calendar Layout Tanggal --}}
        @if ($jumlahHari)
            <div class="space-y-4 mt-6">
                <label class="block text-sm font-semibold text-gray-700">📅 Pilih Tanggal</label>
                
                {{-- Legend --}}
                <div class="flex flex-wrap items-center gap-4 mb-4 text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-gray-200 rounded border-2 relative">
                            <div class="absolute top-0 right-0 w-2 h-2 bg-green-500 rounded-full transform translate-x-1 -translate-y-1"></div>
                        </div>
                        <span class="text-gray-600">Ada data absensi</span>
                    </div>
                    @if($muridDipilih)
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-blue-500 rounded border-2"></div>
                            <span class="text-gray-600">{{ $muridDipilih }} hadir</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-gray-200 rounded border-2"></div>
                        <span class="text-gray-600">Tidak ada data</span>
                    </div>
                </div>
                
                {{-- Clear Selection Button --}}
                <div class="flex items-center space-x-2 mb-4">
                    <button type="button" onclick="clearDateSelection()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200">
                        🗑️ Hapus Pilihan Tanggal
                    </button>
                    {{-- @if($muridDipilih)
                        <button type="button" onclick="clearMuridSelection()" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200">
                            👤 Hapus Pilihan Murid
                        </button>
                    @endif --}}
                    @if($tanggalDipilih)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                            Terpilih: {{ $tanggalDipilih }}
                        </span>
                    @endif
                    @if($muridDipilih)
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                            Murid: {{ $muridDipilih }}
                        </span>
                    @endif
                </div>
                
                {{-- Calendar Grid --}}
                <div class="grid grid-cols-7 gap-2 max-w-md">
                    @for ($i = 1; $i <= $jumlahHari; $i++)
                        @php
                            $hasData = in_array($i, $tanggalDenganData);
                            $isSelected = ($i == $tanggalDipilih);
                            $muridHadirHariIni = in_array($i, $tanggalAbsensiMurid);
                        @endphp
                        <button type="button" 
                                onclick="selectDate({{ $i }})"
                                class="date-btn {{ $hasData ? 'date-has-data' : '' }} {{ $isSelected ? 'date-selected' : '' }} {{ $muridHadirHariIni && $muridDipilih ? 'murid-hadir-hari-ini' : '' }} w-10 h-10 md:w-12 md:h-12 rounded-lg border-2 font-semibold text-sm transition-all duration-200 hover:scale-105 relative
                                    {{ $isSelected ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white border-blue-500 shadow-lg' : 
                                    ($muridHadirHariIni && $muridDipilih ? 'bg-gradient-to-r from-blue-400 to-blue-500 text-white border-blue-400' : 
                                    'bg-white hover:bg-orange-50 text-gray-700 border-gray-200 hover:border-blue-300') }}">
                            {{ $i }}
                        </button>
                    @endfor
                </div>
                
                {{-- Hidden input untuk tanggal yang dipilih --}}
                <input type="hidden" name="tanggal" id="selectedDate" value="{{ $tanggalDipilih }}">
                
                {{-- Info Calendar --}}
                <div class="text-xs text-gray-500 mt-2">
                    💡 Klik tanggal untuk melihat detail absensi hari tersebut. 
                    @if($muridDipilih)
                        Tanggal biru menunjukkan {{ $muridDipilih }} hadir.
                    @endif
                </div>
            </div>
        @endif
    </form>
</div>

{{-- Riwayat Murid Section --}}
@if ($muridDipilih && $riwayatMurid && count($riwayatMurid) > 0)
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">👤</span>
                Riwayat Absensi {{ $muridDipilih }}
            </h2>
            <div class="text-sm bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                {{ \Carbon\Carbon::createFromFormat('Y-m', $bulanDipilih)->translatedFormat('F Y') }}
            </div>
        </div>

        {{-- Statistik Murid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @php
                $totalHadir = $riwayatMurid->where('jenis_status', 'Hadir')->count();
                // $totalSakit = $riwayatMurid->where('jenis_status', 'Sakit')->count();
                $totalIzin = $riwayatMurid->where('jenis_status', 'Izin')->count();
                $totalAlpha = $riwayatMurid->where('jenis_status', 'Alpha')->count();
            @endphp
            <div class="bg-green-50 p-4 rounded-xl text-center">
                <div class="text-2xl font-bold text-green-600">{{ $totalHadir }}</div>
                <div class="text-sm text-green-700 font-medium">✅ Hadir</div>
            </div>
            {{-- <div class="bg-yellow-50 p-4 rounded-xl text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $totalSakit }}</div>
                <div class="text-sm text-yellow-700 font-medium">🤒 Sakit</div>
            </div> --}}
            <div class="bg-blue-50 p-4 rounded-xl text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $totalIzin }}</div>
                <div class="text-sm text-blue-700 font-medium">📝 Izin</div>
            </div>
            <div class="bg-red-50 p-4 rounded-xl text-center">
                <div class="text-2xl font-bold text-red-600">{{ $totalAlpha }}</div>
                <div class="text-sm text-red-700 font-medium">❌ Alpha</div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                        <th class="px-6 py-4 text-left rounded-tl-xl font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-center font-semibold">Status</th>
                        <th class="px-6 py-4 text-left font-semibold">Catatan</th>
                        <th class="px-6 py-4 text-center rounded-tr-xl font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayatMurid as $riwayat)
                        <tr class="table-row-yellow border-b border-gray-100 hover:shadow-md transition-all duration-200">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ \Carbon\Carbon::parse($riwayat->tanggal_absen)->translatedFormat('d F Y') }}
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($riwayat->tanggal_absen)->translatedFormat('l') }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch(strtolower($riwayat->jenis_status)) {
                                        case 'hadir':
                                            $statusClass = 'bg-green-100 text-green-800';
                                            // $statusIcon = '✅';
                                            break;
                                        // case 'sakit':
                                        //     $statusClass = 'bg-yellow-100 text-yellow-800';
                                        //     $statusIcon = '🤒';
                                        //     break;
                                        case 'izin':
                                            $statusClass = 'bg-blue-100 text-blue-800';
                                            $statusIcon = '📝';
                                            break;
                                        // case 'alpha':
                                        //     $statusClass = 'bg-red-100 text-red-800';
                                        //     $statusIcon = '❌';
                                        //     break;
                                        default:
                                            $statusClass = 'bg-gray-100 text-gray-800';
                                            $statusIcon = '❓';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusIcon }} {{ $riwayat->jenis_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $riwayat->catatan ?: '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('pengajar.riwayatMuridAbsensi.edit', $riwayat->id) }}" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg font-semibold transition-colors duration-200 text-xs">
                                        Edit
                                    </a>
                                    <form action="{{ route('pengajar.riwayatMuridAbsensi.hapus', $riwayat->id) }}" method="POST" class="inline" onsubmit="return confirmDelete('{{ $riwayat->nama_murid }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg font-semibold transition-colors duration-200 text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@elseif($muridDipilih)
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg fade-in mb-8">
        <div class="flex items-center">
            <span class="text-yellow-500 text-2xl mr-3">⚠️</span>
            <p class="text-yellow-700 font-semibold">Tidak ada riwayat absensi untuk {{ $muridDipilih }} pada bulan ini.</p>
        </div>
    </div>
@endif
{{-- ----------------------------------------------- --}}

{{-- Data Absensi Tanggal Tertentu --}}
@if ($tanggalDipilih && $absensiTanggal && count($absensiTanggal) > 0)
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span class="bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">📅</span>
                Absensi Tanggal {{ $tanggalDipilih }} {{ \Carbon\Carbon::createFromFormat('Y-m', $bulanDipilih)->translatedFormat('F Y') }}
            </h2>
            <div class="text-sm bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-semibold">
                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $bulanDipilih.'-'.str_pad($tanggalDipilih, 2, '0', STR_PAD_LEFT))->translatedFormat('l') }}
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gradient-to-r from-purple-500 to-pink-600 text-white">
                        <th class="px-6 py-4 text-left rounded-tl-xl font-semibold">Nama Murid</th>
                        <th class="px-6 py-4 text-center font-semibold">Status</th>
                        <th class="px-6 py-4 text-left font-semibold">Catatan</th>
                        <th class="px-6 py-4 text-center rounded-tr-xl font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensiTanggal as $absensi)
                        <tr class="table-row-yellow border-b border-gray-100 hover:shadow-md transition-all duration-200">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                @php
                                    $jenisKelamin = strtolower($absensi->jenis_kelamin ?? '');
                                    $genderClass = $jenisKelamin === 'perempuan' ? 'murid-perempuan' : 'murid-laki';
                                @endphp
                                <span class="px-4 py-1 rounded-full {{ $genderClass }}">
                                    {{ $absensi->nama_murid }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch(strtolower($absensi->jenis_status)) {
                                        case 'hadir':
                                            $statusClass = 'bg-green-100 text-green-800';
                                            $statusIcon = '✅';
                                            break;
                                        case 'izin':
                                            $statusClass = 'bg-blue-100 text-blue-800';
                                            $statusIcon = '📝';
                                            break;
                                        case 'alpha':
                                            $statusClass = 'bg-red-100 text-red-800';
                                            $statusIcon = '❌';
                                            break;
                                        default:
                                            $statusClass = 'bg-gray-100 text-gray-800';
                                            $statusIcon = '❓';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusIcon }} {{ $absensi->jenis_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $absensi->catatan ?: '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('pengajar.riwayatMuridAbsensi.edit', $absensi->id) }}" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg font-semibold transition-colors duration-200 text-xs">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('pengajar.riwayatMuridAbsensi.hapus', $absensi->id) }}" method="POST" class="inline" onsubmit="return confirmDelete('{{ $absensi->nama_murid }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg font-semibold transition-colors duration-200 text-xs">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@elseif($tanggalDipilih)
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg fade-in mb-8">
        <div class="flex items-center">
            <span class="text-yellow-500 text-2xl mr-3">⚠️</span>
            <p class="text-yellow-700 font-semibold">
                @if($muridDipilih)
                    Tidak ada data absensi untuk {{ $muridDipilih }} pada tanggal {{ $tanggalDipilih }}.
                @else
                    Tidak ada data absensi pada tanggal {{ $tanggalDipilih }}.
                @endif
            </p>
        </div>
    </div>
@endif


{{-- ----------------------------------------------- --}}

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-4 fade-in">
                <div class="flex items-center">
                    <span class="text-green-500 text-2xl mr-3">✅</span>
                    <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-4 fade-in">
                <div class="flex items-center">
                    <span class="text-red-500 text-2xl mr-3">❌</span>
                    <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                </div>
            </div>
        @endif

    </div>
</div>

{{-- JavaScript untuk interaktivitas tambahan --}}
<script>
    // Function untuk select tanggal
    function selectDate(date) {
        // Update hidden input
        document.getElementById('selectedDate').value = date;
        
        // Update visual selection
        document.querySelectorAll('.date-btn').forEach(btn => {
            btn.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-indigo-500', 'text-white', 'border-blue-500', 'shadow-lg', 'date-selected');
            btn.classList.add('bg-white', 'hover:bg-orange-50', 'text-gray-700', 'border-gray-200', 'hover:border-blue-300');
        });
        
        // Highlight selected date
        event.target.classList.remove('bg-white', 'hover:bg-orange-50', 'text-gray-700', 'border-gray-200', 'hover:border-blue-300');
        event.target.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-indigo-500', 'text-white', 'border-blue-500', 'shadow-lg', 'date-selected');
        
        // Submit form
        document.getElementById('filterForm').submit();
    }
    
    // Function untuk clear selection
    function clearDateSelection() {
        document.getElementById('selectedDate').value = '';
        
        // Reset semua button ke default state
        document.querySelectorAll('.date-btn').forEach(btn => {
            btn.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-indigo-500', 'text-white', 'border-blue-500', 'shadow-lg', 'date-selected');
            btn.classList.add('bg-white', 'hover:bg-orange-50', 'text-gray-700', 'border-gray-200', 'hover:border-blue-300');
        });
        
        // Submit form untuk refresh
        document.getElementById('filterForm').submit();
    }

    // Animasi loading saat form disubmit
    document.querySelectorAll('select').forEach(select => {
        select.addEventListener('change', function() {
            if (this.form) {
                // Tambahkan loading indicator
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                loadingDiv.innerHTML = `
                    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                        <span class="text-gray-700 font-medium">Memuat data...</span>
                    </div>
                `;
                document.body.appendChild(loadingDiv);
            }
        });
    });

    // Smooth scroll animation untuk section yang muncul
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.fade-in');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
    });

    // Tooltip untuk tanggal yang memiliki data
    document.querySelectorAll('.date-has-data').forEach(dateBtn => {
        dateBtn.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute bg-gray-800 text-white text-xs rounded py-1 px-2 -top-8 left-1/2 transform -translate-x-1/2 z-10';
            tooltip.textContent = 'Ada data absensi';
            this.style.position = 'relative';
            this.appendChild(tooltip);
        });
        
        dateBtn.addEventListener('mouseleave', function() {
            const tooltip = this.querySelector('.absolute');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });

    // Konfirmasi sebelum hapus data
    function confirmDelete(nama) {
        return confirm(`Apakah Anda yakin ingin menghapus data absensi untuk ${nama}?\n\nTindakan ini tidak dapat dibatalkan.`);
    }

    // Auto-hide notifikasi setelah 5 detik
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = document.querySelectorAll('.bg-green-50, .bg-red-50');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 5000);
        });
    });
</script>