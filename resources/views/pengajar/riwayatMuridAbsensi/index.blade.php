@extends('components.layouts.pengajar')

@section('content')

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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                <span class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">📅</span>
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
                    <span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">📊</span>
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
                        <tr class="gradient-bg text-white">
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

        {{-- Filter Detail Section --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">🔍</span>
                Filter Detail
            </h2>
            
            <form method="GET" id="filterForm">
                {{-- Dropdown Bulan --}}
                <div class="mb-6">
                    <label for="bulan2" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Bulan</label>
                    <select name="bulan" id="bulan2" class="w-full md:w-1/2 border-2 border-gray-200 px-4 py-3 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-colors duration-200" onchange="this.form.submit()">
                        @foreach ($bulanList as $bulan)
                            <option value="{{ $bulan }}" {{ $bulan == $bulanDipilih ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Calendar Layout Tanggal --}}
                @if ($jumlahHari)
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700">📅 Pilih Tanggal</label>
                        
                        {{-- Clear Selection Button --}}
                        <div class="flex items-center space-x-2 mb-4">
                            <button type="button" onclick="clearDateSelection()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200">
                                🗑️ Hapus Pilihan
                            </button>
                            @if($tanggalDipilih)
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Terpilih: {{ $tanggalDipilih }}
                                </span>
                            @endif
                        </div>
                        
                        {{-- Calendar Grid --}}
                        <div class="grid grid-cols-7 gap-2 max-w-md">
                            @for ($i = 1; $i <= $jumlahHari; $i++)
                                <button type="button" 
                                        onclick="selectDate({{ $i }})"
                                        class="date-btn w-10 h-10 md:w-12 md:h-12 rounded-lg border-2 font-semibold text-sm transition-all duration-200 hover:scale-105 
                                               {{ $i == $tanggalDipilih ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white border-orange-500 shadow-lg' : 'bg-white hover:bg-orange-50 text-gray-700 border-gray-200 hover:border-orange-300' }}">
                                    {{ $i }}
                                </button>
                            @endfor
                        </div>
                        
                        {{-- Hidden input untuk tanggal yang dipilih --}}
                        <input type="hidden" name="tanggal" id="selectedDate" value="{{ $tanggalDipilih }}">
                        
                        {{-- Info Calendar --}}
                        <div class="text-xs text-gray-500 mt-2">
                            💡 Klik tanggal untuk melihat detail absensi hari tersebut
                        </div>
                    </div>
                @endif
            </form>
        </div>

        {{-- Detail Absensi Section --}}
        @if ($absensiTanggal && count($absensiTanggal) > 0)
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 hover-scale fade-in">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <span class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">📋</span>
                        Detail Absensi
                    </h2>
                    <div class="text-sm bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $bulanDipilih)->format('F Y') }}, Tanggal {{ $tanggalDipilih }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="gradient-bg text-white">
                                <th class="px-6 py-4 text-left rounded-tl-xl font-semibold">Nama Murid</th>
                                <th class="px-6 py-4 text-center font-semibold">Status</th>
                                <th class="px-6 py-4 text-left font-semibold">Catatan</th>
                                <th class="px-6 py-4 text-center rounded-tr-xl font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensiTanggal as $absen)
                                @php
                                    $jenisKelamin = strtolower($absen->jenis_kelamin ?? '');
                                    $genderClass = $jenisKelamin === 'perempuan' ? 'murid-perempuan' : 'murid-laki';
                                @endphp
                                <tr class="table-row-yellow border-b border-gray-100 hover:shadow-md transition-all duration-200">
                                    {{-- DETAIL ABSENSI --}}
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-2 rounded-full font-semibold {{ $genderClass }}">
                                            {{ $absen->nama_murid }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusClass = '';
                                            $statusIcon = '';
                                            switch(strtolower($absen->jenis_status)) {
                                                case 'hadir':
                                                    $statusClass = 'bg-green-100 text-green-800';
                                                    $statusIcon = '✅';
                                                    break;
                                                case 'sakit':
                                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                                    $statusIcon = '🤒';
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
                                            {{ $statusIcon }} {{ $absen->jenis_status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $absen->catatan ?: '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('pengajar.riwayatMuridAbsensi.edit', $absen->id) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors duration-200 text-sm">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('pengajar.riwayatMuridAbsensi.hapus', $absen->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data {{ $absen->nama_murid }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors duration-200 text-sm">
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
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg fade-in">
                <div class="flex items-center">
                    <span class="text-red-500 text-2xl mr-3">⚠️</span>
                    <p class="text-red-700 font-semibold">Tidak ada data absensi untuk tanggal ini.</p>
                </div>
            </div>
        @endif

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
            btn.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-red-500', 'text-white', 'border-orange-500', 'shadow-lg');
            btn.classList.add('bg-white', 'hover:bg-orange-50', 'text-gray-700', 'border-gray-200', 'hover:border-orange-300');
        });
        
        // Highlight selected date
        event.target.classList.remove('bg-white', 'hover:bg-orange-50', 'text-gray-700', 'border-gray-200', 'hover:border-orange-300');
        event.target.classList.add('bg-gradient-to-r', 'from-orange-500', 'to-red-500', 'text-white', 'border-orange-500', 'shadow-lg');
        
        // Submit form
        document.getElementById('filterForm').submit();
    }
    
    // Function untuk clear selection
    function clearDateSelection() {
        document.getElementById('selectedDate').value = '';
        
        // Reset semua button ke default state
        document.querySelectorAll('.date-btn').forEach(btn => {
            btn.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-red-500', 'text-white', 'border-orange-500', 'shadow-lg');
            btn.classList.add('bg-white', 'hover:bg-orange-50', 'text-gray-700', 'border-gray-200', 'hover:border-orange-300');
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
                loadingDiv.innerHTML = '<div class="bg-white p-6 rounded-lg flex items-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mr-4"></div><span class="text-gray-700">Memuat data...</span></div>';
                document.body.appendChild(loadingDiv);
            }
        });
    });

    // Loading indicator untuk calendar selection
    document.getElementById('filterForm').addEventListener('submit', function() {
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loadingDiv.innerHTML = '<div class="bg-white p-6 rounded-lg flex items-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-600 mr-4"></div><span class="text-gray-700">Memuat data absensi...</span></div>';
        document.body.appendChild(loadingDiv);
    });

    // Tooltip untuk status absensi
    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            const status = this.textContent.trim();
            this.setAttribute('title', `Status: ${status}`);
        });
    });

    // Konfirmasi hapus yang lebih interaktif
    document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const nama = this.getAttribute('onsubmit').match(/Hapus data (.+?)\?/)[1];
            
            // Custom confirm dialog bisa ditambahkan disini
            if (confirm(`⚠️ Apakah Anda yakin ingin menghapus data absensi ${nama}?\n\nTindakan ini tidak dapat dibatalkan!`)) {
                this.submit();
            }
        });
    });
</script>

@endsection