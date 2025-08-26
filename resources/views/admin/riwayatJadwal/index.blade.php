@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')

<style>
    .card { 
        transition: all 0.2s ease; 
    }
    .card:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 8px 25px -8px rgba(0,0,0,0.15); 
    }
    .accordion-content.open { 
        max-height: 2000px; 
    }
    .accordion-icon.rotate { 
        transform: rotate(180deg); 
    }
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 50;
    }
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 50;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .modal-overlay.open { 
        display: flex; 
    }
</style>

<div class="p-4 md:p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">

        {{-- Toast Notifications --}}
        @if (session('success'))
            <div class="toast">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow">
                    ✅ {{ session('success') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="toast">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow">
                    ❌ Terjadi kesalahan. Periksa input Anda.
                </div>
            </div>
        @endif

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                📅 Riwayat Jadwal
            </h1>
            <p class="text-gray-600">Kelola dan lihat riwayat jadwal yang telah berlalu</p>
        </div>

        {{-- Filter Form --}}
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select name="bulan" class="w-full rounded-md border-gray-300 text-sm" 
                            onchange="this.form.submit()" 
                            onmouseover="showMonthTooltip(this)"
                            onmouseout="hideTooltip()">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $currentYear = request('tahun') ?: date('Y');
                                $hasSchedule = isset($jadwalData[$currentYear . '-' . $i]);
                                $scheduleCount = $hasSchedule ? $jadwalData[$currentYear . '-' . $i]->jumlah : 0;
                            @endphp
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}
                                    data-has-schedule="{{ $hasSchedule ? 'true' : 'false' }}"
                                    data-schedule-count="{{ $scheduleCount }}">
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                @if($hasSchedule) • ({{ $scheduleCount }} jadwal) @endif
                            </option>
                        @endfor
                    </select>
                    <!-- Tooltip untuk bulan -->
                    <div id="monthTooltip" class="absolute z-10 invisible opacity-0 bg-blue-600 text-white text-xs rounded-lg py-2 px-3 shadow-lg transition-all duration-200 transform -translate-y-1 pointer-events-none top-full mt-1 left-0">
                        <span id="monthTooltipText">Pilih bulan untuk melihat jadwal</span>
                        <div class="absolute -top-1 left-4 w-0 h-0 border-l-2 border-r-2 border-b-2 border-transparent border-b-blue-600"></div>
                    </div>
                </div>
                
                <div class="flex-1 relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <select name="tahun" class="w-full rounded-md border-gray-300 text-sm" 
                            onchange="updateMonthOptions(); this.form.submit()"
                            onmouseover="showYearTooltip(this)"
                            onmouseout="hideTooltip()">
                        <option value="">Semua Tahun</option>
                        @foreach ($availableYears as $year)
                            @php
                                $hasScheduleInYear = $jadwalData->keys()->filter(function($key) use ($year) {
                                    return str_starts_with($key, $year . '-');
                                })->count() > 0;
                                $totalSchedulesInYear = $jadwalData->filter(function($item, $key) use ($year) {
                                    return str_starts_with($key, $year . '-');
                                })->sum('jumlah');
                            @endphp
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}
                                    data-has-schedule="{{ $hasScheduleInYear ? 'true' : 'false' }}"
                                    data-schedule-count="{{ $totalSchedulesInYear }}">
                                {{ $year }}
                                @if($hasScheduleInYear) • ({{ $totalSchedulesInYear }} jadwal) @endif
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip untuk tahun -->
                    <div id="yearTooltip" class="absolute z-10 invisible opacity-0 bg-green-600 text-white text-xs rounded-lg py-2 px-3 shadow-lg transition-all duration-200 transform -translate-y-1 pointer-events-none top-full mt-1 left-0">
                        <span id="yearTooltipText">Pilih tahun untuk melihat jadwal</span>
                        <div class="absolute -top-1 left-4 w-0 h-0 border-l-2 border-r-2 border-b-2 border-transparent border-b-green-600"></div>
                    </div>
                </div>
                
                <div class="flex gap-2 items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition">
                        Tampilkan
                    </button>
                    @if(request('bulan') && request('tahun'))
                        <a href="{{ route('admin.riwayatJadwal.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
                           target="_blank"
                           class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition">
                            📄 PDF
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Bulk Actions --}}
        <div class="bg-white rounded-lg shadow-sm p-3 mb-6 flex flex-wrap items-center gap-3">
            <label class="flex items-center gap-2">
                <input id="selectAll" type="checkbox" class="rounded">
                <span class="text-sm">Pilih Semua</span>
            </label>
            
            <div class="ml-auto flex gap-2">
                <button id="invertBtn" class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600">
                    Balikkan
                </button>
                
                <form id="bulkDeleteForm" action="{{ route('admin.riwayatJadwal.bulkDelete') }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <input type="hidden" name="ids" id="selectedIds">
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                        Hapus Terpilih
                    </button>
                </form>
                
                <form action="{{ route('admin.riwayatJadwal.deleteAll') }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-800 text-white px-3 py-1 rounded text-sm hover:bg-red-900"
                            onclick="return confirm('Hapus semua data?')">
                        Hapus Semua
                    </button>
                </form>
            </div>
        </div>

        {{-- Schedule List --}}
        @forelse ($groupedByMonth as $month => $jadwals)
            <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                {{-- Month Header --}}
                <div class="bg-blue-600 text-white p-4 cursor-pointer" onclick="toggleAccordion(this)">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold">{{ $month }}</h3>
                            <p class="text-blue-100 text-sm">
                                {{ count($jadwals) }} jadwal • 
                                Total: Rp {{ number_format($jadwals->sum('gaji'), 0, ',', '.') }}
                            </p>
                        </div>
                        <svg class="accordion-icon w-5 h-5 transition-transform duration-200" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- Month Content --}}
                <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
                    <div class="p-4 space-y-3">
                        @foreach ($jadwals as $jadwal)
                            <div class="card border border-gray-200 rounded-lg p-4">
                                <div class="flex flex-col md:flex-row md:items-start gap-3">
                                    {{-- Checkbox & Info --}}
                                    <div class="flex gap-3 flex-1">
                                        <input type="checkbox" class="schedule-checkbox mt-1 rounded" value="{{ $jadwal->id }}">
                                        
                                        <div class="flex-1 space-y-2">
                                            <h4 class="font-bold text-gray-800 text-lg">{{ $jadwal->nama_jadwal }}</h4>
                                            
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-600">
                                                <div class="flex items-center gap-2">
                                                    <span>📅</span>
                                                    <span>{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span>⏰</span>
                                                    <span>{{ $jadwal->pukul_jadwal }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span>👨‍🏫</span>
                                                    <span>{{ $jadwal->nama_pengajar_jadwal }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span>💰</span>
                                                    <span class="font-semibold text-green-600">
                                                        Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            @if($jadwal->kegiatan_jadwal)
                                                <div class="text-sm text-gray-600">
                                                    <span class="font-medium">Kegiatan:</span> {{ $jadwal->kegiatan_jadwal }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex gap-2">
                                        <button onclick="openEditModal({{ $jadwal->id }}, '{{ $jadwal->nama_jadwal }}', '{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('Y-m-d') }}', '{{ $jadwal->pukul_jadwal }}', '{{ $jadwal->nama_pengajar_jadwal }}', '{{ $jadwal->kegiatan_jadwal }}', {{ $jadwal->gaji }})"
                                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Edit
                                        </button>
                                        
                                        <form action="{{ route('admin.riwayatJadwal.destroy', $jadwal->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Hapus jadwal ini?')"
                                                    class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="text-center py-12">
                <div class="bg-white rounded-lg shadow-sm p-8 max-w-md mx-auto">
                    <div class="text-6xl mb-4">📅</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Riwayat</h3>
                    <p class="text-gray-600">Tidak ada riwayat jadwal yang tersedia saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="modal-overlay">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-4 border-b flex items-center justify-between">
            <h3 class="text-lg font-bold">Edit Jadwal</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST">
            @csrf @method('PUT')
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jadwal</label>
                    <input type="text" name="nama_jadwal" id="edit_nama" 
                           class="w-full rounded-md border-gray-300" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal_jadwal" id="edit_tanggal" 
                           class="w-full rounded-md border-gray-300" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                    <input type="text" name="pukul_jadwal" id="edit_pukul" 
                           placeholder="08:00 - 09:00" class="w-full rounded-md border-gray-300" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pengajar</label>
                    <input type="text" name="nama_pengajar_jadwal" id="edit_pengajar" 
                           class="w-full rounded-md border-gray-300" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gaji (Rp)</label>
                    <input type="number" name="gaji" id="edit_gaji" min="0" 
                           class="w-full rounded-md border-gray-300">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kegiatan</label>
                    <textarea name="kegiatan_jadwal" id="edit_kegiatan" rows="3" 
                              class="w-full rounded-md border-gray-300"></textarea>
                </div>
            </div>

            <div class="p-6 border-t flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" 
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Tooltip functions
function showMonthTooltip(selectElement) {
    const tooltip = document.getElementById('monthTooltip');
    const tooltipText = document.getElementById('monthTooltipText');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    
    if (selectElement.value === '') {
        tooltipText.textContent = 'Pilih bulan untuk melihat jadwal';
    } else {
        const hasSchedule = selectedOption.getAttribute('data-has-schedule') === 'true';
        const scheduleCount = selectedOption.getAttribute('data-schedule-count');
        
        if (hasSchedule && scheduleCount > 0) {
            tooltipText.textContent = `Ada ${scheduleCount} jadwal di bulan ini`;
        } else {
            tooltipText.textContent = 'Tidak ada jadwal di bulan ini';
        }
    }
    
    tooltip.classList.remove('invisible', 'opacity-0');
    tooltip.classList.add('visible', 'opacity-100');
}

function showYearTooltip(selectElement) {
    const tooltip = document.getElementById('yearTooltip');
    const tooltipText = document.getElementById('yearTooltipText');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    
    if (selectElement.value === '') {
        tooltipText.textContent = 'Pilih tahun untuk melihat jadwal';
    } else {
        const hasSchedule = selectedOption.getAttribute('data-has-schedule') === 'true';
        const scheduleCount = selectedOption.getAttribute('data-schedule-count');
        
        if (hasSchedule && scheduleCount > 0) {
            tooltipText.textContent = `Ada ${scheduleCount} jadwal di tahun ini`;
        } else {
            tooltipText.textContent = 'Tidak ada jadwal di tahun ini';
        }
    }
    
    tooltip.classList.remove('invisible', 'opacity-0');
    tooltip.classList.add('visible', 'opacity-100');
}

function hideTooltip() {
    const monthTooltip = document.getElementById('monthTooltip');
    const yearTooltip = document.getElementById('yearTooltip');
    
    monthTooltip.classList.add('invisible', 'opacity-0');
    monthTooltip.classList.remove('visible', 'opacity-100');
    
    yearTooltip.classList.add('invisible', 'opacity-0');
    yearTooltip.classList.remove('visible', 'opacity-100');
}

// Update month options when year changes
function updateMonthOptions() {
    const yearSelect = document.querySelector('select[name="tahun"]');
    const monthSelect = document.querySelector('select[name="bulan"]');
    const selectedYear = yearSelect.value;
    
    // Update month options based on selected year
    for (let i = 1; i < monthSelect.options.length; i++) {
        const option = monthSelect.options[i];
        const monthValue = option.value;
        
        if (selectedYear && jadwalData) {
            const key = selectedYear + '-' + monthValue;
            const scheduleData = jadwalData[key];
            const hasSchedule = scheduleData ? true : false;
            const scheduleCount = scheduleData ? scheduleData.jumlah : 0;
            
            option.setAttribute('data-has-schedule', hasSchedule ? 'true' : 'false');
            option.setAttribute('data-schedule-count', scheduleCount);
            
            // Update option text
            const monthName = option.textContent.split(' •')[0]; // Get month name without count
            option.textContent = monthName + (hasSchedule ? ` • (${scheduleCount} jadwal)` : '');
        } else {
            // Reset to default when no year selected
            option.setAttribute('data-has-schedule', 'false');
            option.setAttribute('data-schedule-count', '0');
            
            const monthName = option.textContent.split(' •')[0];
            option.textContent = monthName;
        }
    }
}

// Accordion functionality
function toggleAccordion(element) {
    const content = element.nextElementSibling;
    const icon = element.querySelector('.accordion-icon');
    
    if (content.classList.contains('open')) {
        content.classList.remove('open');
        content.style.maxHeight = '0px';
        icon.classList.remove('rotate');
    } else {
        content.classList.add('open');
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.classList.add('rotate');
    }
}

// Bulk selection
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.schedule-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

document.getElementById('invertBtn').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('.schedule-checkbox');
    checkboxes.forEach(cb => cb.checked = !cb.checked);
});

document.getElementById('bulkDeleteForm').addEventListener('submit', function(e) {
    const selected = Array.from(document.querySelectorAll('.schedule-checkbox:checked'))
                         .map(cb => cb.value);
    
    if (selected.length === 0) {
        alert('Pilih minimal satu jadwal untuk dihapus.');
        e.preventDefault();
        return false;
    }
    
    if (!confirm(`Hapus ${selected.length} jadwal terpilih?`)) {
        e.preventDefault();
        return false;
    }
    
    document.getElementById('selectedIds').value = selected.join(',');
});

// Modal functions
function openEditModal(id, nama, tanggal, pukul, pengajar, kegiatan, gaji) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_tanggal').value = tanggal;
    document.getElementById('edit_pukul').value = pukul;
    document.getElementById('edit_pengajar').value = pengajar;
    document.getElementById('edit_kegiatan').value = kegiatan;
    document.getElementById('edit_gaji').value = gaji;
    
    document.getElementById('editForm').action = `/admin/riwayatJadwal/${id}`;
    document.getElementById('editModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('open');
    document.body.style.overflow = '';
}

// Auto-hide toast
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.querySelector('.toast');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});

// Close modal on overlay click
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});

// ESC to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeEditModal();
});
</script>

@endsection