@extends('components.layouts.pengajar.sidebar')
@section('sidebar-pengajar')

<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
.select2-container .select2-selection--single { height: 42px; padding: 6px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 40px; }
.btn-modern { transition: all 0.3s ease; transform: translateY(0); }
.btn-modern:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
.btn-modern:active { transform: translateY(0); }

/* Color themes for different categories */
.theme-alquran {
    border-color: #db2777;
    background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
}

.theme-iqro {
    border-color: #2563eb;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
}

.theme-perempuan .jenis-kelamin {
    background: linear-gradient(135deg, #fdf2f8, #fce7f3) !important;
    border-color: #db2777 !important;
    color: #be185d !important;
    font-weight: 600;
}

.theme-laki-laki .jenis-kelamin {
    background: linear-gradient(135deg, #eff6ff, #dbeafe) !important;
    border-color: #2563eb !important;
    color: #1d4ed8 !important;
    font-weight: 600;
}

.theme-alquran .jenis-bacaan {
    background: linear-gradient(135deg, #fdf2f8, #fce7f3) !important;
    border-color: #db2777 !important;
    color: #be185d !important;
    font-weight: 600;
}

.theme-iqro .jenis-bacaan {
    background: linear-gradient(135deg, #eff6ff, #dbeafe) !important;
    border-color: #2563eb !important;
    color: #1d4ed8 !important;
    font-weight: 600;
}

/* Animated transition for theme changes */
.absensi-item {
    transition: all 0.4s ease;
}

/* Enhanced styling for themed cards */
.theme-alquran .card-header {
    background: linear-gradient(135deg, #db2777, #be185d);
    color: white;
}

.theme-iqro .card-header {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
}

.card-header {
    padding: 8px 16px;
    border-radius: 8px 8px 0 0;
    margin: -16px -16px 16px -16px;
    font-weight: 600;
    font-size: 14px;
    text-align: center;
    transition: all 0.3s ease;
}

.theme-indicator {
    position: absolute;
    top: 8px;
    left: 8px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.theme-alquran .theme-indicator {
    background-color: #db2777;
    box-shadow: 0 0 15px rgba(219, 39, 119, 0.4);
}

.theme-iqro .theme-indicator {
    background-color: #2563eb;
    box-shadow: 0 0 15px rgba(37, 99, 235, 0.4);
}
</style>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl mb-8 p-6 lg:p-8 flex items-center space-x-4">
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

            <div class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-1 lg:grid-cols-3 lg:gap-4">
                <div class="lg:order-1">
                    <button type="button" id="add-absensi"
                        class="btn-modern w-full flex items-center justify-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Absensi
                    </button>
                </div>
                <div class="lg:order-2">
                    <button type="submit"
                        class="btn-modern w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Semua Absensi
                    </button>
                </div>
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
        </form>
    </div>
</div>

<!-- JS jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
jQuery(document).ready(function($) {
    const muridData = @json($murids);
    const container = $('#absensi-container');
    let absensiIndex = 0;

    function createAbsensiForm(index) {
        let muridOptions = muridData.map(m => `<option value="${m.nama_anak}">${m.nama_anak}</option>`).join('');

        return `
        <div class="absensi-item border border-gray-300 rounded-xl p-4 mb-4 relative bg-gray-50">
            <div class="theme-indicator"></div>
            <div class="card-header" style="display: none;">
                <span class="theme-text"></span>
            </div>
            <button type="button" class="remove-absensi absolute top-2 right-2 text-red-500 hover:text-red-700 z-10">✕</button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Murid</label>
                    <select name="absensi[${index}][nama_murid]" class="murid-select w-full" required>
                        <option value="">-- Pilih Murid --</option>
                        ${muridOptions}
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Murid</label>
                    <input type="text" name="absensi[${index}][nama_display]" class="nama-display w-full p-2 border rounded bg-gray-100" readonly required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <input type="text" name="absensi[${index}][jenis_kelamin]" class="jenis-kelamin w-full p-2 border rounded bg-gray-100" readonly required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Bacaan</label>
                    <input type="text" name="absensi[${index}][jenis_bacaan]" class="jenis-bacaan w-full p-2 border rounded bg-gray-100" readonly required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Kehadiran</label>
                    <select name="absensi[${index}][jenis_status]" class="w-full p-2 border rounded" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir">✅ Hadir</option>
                        <option value="izin">📝 Izin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Absen</label>
                    <input type="date" name="absensi[${index}][tanggal_absen]" value="{{ date('Y-m-d') }}" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                <textarea name="absensi[${index}][catatan]" rows="2" class="w-full p-2 border rounded" placeholder="Jelaskan Iqro atau Al-Qur'an..." required></textarea>
            </div>
        </div>
        `;
    }

    function updateTheme(item) {
        const jenisKelamin = item.find('.jenis-kelamin').val()?.toLowerCase();
        const jenisBacaan = item.find('.jenis-bacaan').val()?.toLowerCase();
        const cardHeader = item.find('.card-header');
        const themeText = item.find('.theme-text');
        
        // Reset all theme classes
        item.removeClass('theme-alquran theme-iqro theme-perempuan theme-laki-laki');
        
        // Apply jenis bacaan theme
        if (jenisBacaan && jenisBacaan.includes('al-qur') || jenisBacaan === 'alquran') {
            item.addClass('theme-alquran');
            cardHeader.show();
            themeText.text('📖 Al-Qur\'an');
        } else if (jenisBacaan && jenisBacaan.includes('iqro')) {
            item.addClass('theme-iqro');
            cardHeader.show();
            themeText.text('📚 Iqro');
        } else {
            cardHeader.hide();
        }
        
        // Apply jenis kelamin theme
        if (jenisKelamin === 'perempuan' || jenisKelamin === 'p') {
            item.addClass('theme-perempuan');
        } else if (jenisKelamin === 'laki-laki' || jenisKelamin === 'l') {
            item.addClass('theme-laki-laki');
        }
    }

    // Tambah absensi
    $('#add-absensi').click(function() {
        container.append(createAbsensiForm(absensiIndex));
        container.find('.murid-select').last().select2({ 
            placeholder: "-- Pilih Murid --", 
            allowClear: true 
        });
        absensiIndex++;
    });

    // Hapus absensi
    container.on('click', '.remove-absensi', function() {
        $(this).closest('.absensi-item').remove();
    });

    // Auto-fill data murid and update theme
    container.on('change', '.murid-select', function() {
        let selectedName = $(this).val()?.trim() || '';
        let parent = $(this).closest('.absensi-item');
        let murid = muridData.find(m => (m.nama_anak || '').trim().toLowerCase() === selectedName.toLowerCase());

        if (murid) {
            parent.find('.nama-display').val(murid.nama_anak || '');
            parent.find('.jenis-kelamin').val(murid.jenis_kelamin || '');
            parent.find('.jenis-bacaan').val(murid.jenis_alkitab || '');
            
            // Update theme after filling data
            setTimeout(() => {
                updateTheme(parent);
            }, 100);
        } else {
            parent.find('.nama-display').val('');
            parent.find('.jenis-kelamin').val('');
            parent.find('.jenis-bacaan').val('');
            
            // Reset theme
            parent.removeClass('theme-alquran theme-iqro theme-perempuan theme-laki-laki');
            parent.find('.card-header').hide();
        }
    });

    // Add initial form on page load
    if (container.children().length === 0) {
        $('#add-absensi').click();
    }
});
</script>

@endsection