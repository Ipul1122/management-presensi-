@extends('components.layouts.pengajar.sidebar')
@section('sidebar-pengajar')

<!-- Tambahkan CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
.select2-container .select2-selection--single {
    height: 42px;
    padding: 6px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
}

/* Custom button animations */
.btn-modern {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.btn-modern:active {
    transform: translateY(0);
}
</style>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl mb-8 p-6 lg:p-8">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Form Absensi Murid</h1>
                    <p class="text-gray-600 mt-1">Bisa menambahkan absensi beberapa murid sekaligus</p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg shadow-sm">
                <ul class="mt-2 text-sm text-red-700 list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengajar.muridAbsensi.store') }}" method="POST" id="multi-absensi-form" class="bg-white rounded-2xl shadow-xl p-6 lg:p-8 space-y-8">
            @csrf

            <div id="absensi-container"></div>

            <!-- Modern Button Container -->
            <div class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-1 lg:grid-cols-3 lg:gap-4">
                
                <!-- Add Absensi Button -->
                <div class="lg:order-1">
                    <button type="button" id="add-absensi"
                        class="btn-modern w-full flex items-center justify-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Absensi
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="lg:order-2">
                    <button type="submit"
                        class="btn-modern w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Semua Absensi
                    </button>
                </div>

                <!-- Back Button -->
                <div class="lg:order-3">
                    <a href="{{ route('pengajar.muridAbsensi.index') }}" class="block">
                        <button type="button"   
                            class="btn-modern w-full flex items-center justify-center px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </button>
                    </a>
                </div>
            </div>

            <!-- Mobile-First Alternative Layout (Optional) -->
            {{-- <div class="block sm:hidden space-y-3">
                <button type="button" id="add-absensi-mobile"
                    class="btn-modern w-full flex items-center justify-center px-4 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg shadow-sm text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah
                </button>
                
                <button type="submit"
                    class="btn-modern w-full flex items-center justify-center px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-lg shadow-sm text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Semua
                </button>
                
                <a href="{{ route('pengajar.muridAbsensi.index') }}" class="block">
                    <button type="button" 
                        class="btn-modern w-full flex items-center justify-center px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg shadow-sm text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </button>
                </a>
            </div> --}}

        </form>
    </div>
</div>

<!-- JS Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.getElementById('add-absensi');
    const addBtnMobile = document.getElementById('add-absensi-mobile');
    
    if (addBtnMobile) {
        addBtnMobile.addEventListener('click', function() {
            addBtn.click();
        });
    }
});

    const muridData = @json($murids);
    const container = document.getElementById('absensi-container');
    const addBtn = document.getElementById('add-absensi');

    function createAbsensiForm(index) {
        let muridOptions = muridData.map(m => 
            `<option value="${m.nama_anak}">${m.nama_anak}</option>`
        ).join('');

        return `
        <div class="absensi-item border border-gray-300 rounded-xl p-4 mb-4 relative bg-gray-50">
            <button type="button" class="remove-absensi absolute top-2 right-2 text-red-500 hover:text-red-700">✕</button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Pilih Murid</label>
                    <select name="absensi[${index}][nama_murid]" class="murid-select w-full" required>
                        <option value="">-- Pilih Murid --</option>
                        ${muridOptions}
                    </select>
                </div>
                <div>
                    <label>Nama Murid</label>
                    <input type="text" name="absensi[${index}][nama_display]" class="nama-display w-full p-2 border rounded bg-gray-100" readonly required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label>Jenis Kelamin</label>
                    <input type="text" name="absensi[${index}][jenis_kelamin]" class="jenis-kelamin w-full p-2 border rounded bg-gray-100" readonly required>
                </div>
                <div>
                    <label>Jenis Bacaan</label>
                    <input type="text" name="absensi[${index}][jenis_bacaan]" class="jenis-bacaan w-full p-2 border rounded bg-gray-100" readonly required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label>Status Kehadiran</label>
                    <select name="absensi[${index}][jenis_status]" class="w-full p-2 border rounded" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir">✅ Hadir</option>
                        <option value="izin">📝 Izin</option>
                    </select>
                </div>
                <div>
                    <label>Tanggal Absen</label>
                    <input type="date" name="absensi[${index}][tanggal_absen]" value="{{ date('Y-m-d') }}" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <div class="mt-4">
                <label>Catatan</label>
                <textarea name="absensi[${index}][catatan]" rows="2" class="w-full p-2 border rounded" placeholder="Jelaskan Iqro atau Al-Qur'an..." required></textarea>
            </div>
        </div>
        `;
    }

    let absensiIndex = 0;

    addBtn.addEventListener('click', () => {
        container.insertAdjacentHTML('beforeend', createAbsensiForm(absensiIndex));

        // Inisialisasi Select2 untuk dropdown baru
        $(`.murid-select`).select2({
            placeholder: "-- Pilih Murid --",
            allowClear: true
        });

        absensiIndex++;
    });

    // Event Hapus
    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-absensi')) {
            e.target.closest('.absensi-item').remove();
        }
    });

    // Event ketika murid dipilih
    $(document).on('change', '.murid-select', function() {
        let selectedName = $(this).val();
        let parent = $(this).closest('.absensi-item');
        let murid = muridData.find(m => m.nama_anak === selectedName);

        if (murid) {
            parent.find('.nama-display').val(murid.nama_anak);
            parent.find('.jenis-kelamin').val(murid.jenis_kelamin);
            parent.find('.jenis-bacaan').val(murid.jenis_alkitab);
        } else {
            parent.find('.nama-display').val('');
            parent.find('.jenis-kelamin').val('');
            parent.find('.jenis-bacaan').val('');
        }
    });
</script>

@endsection
