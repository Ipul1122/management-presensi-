    @extends('components.layouts.pengajar.sidebar')

    @section('sidebar-pengajar')

    
    {{-- Custom CSS untuk animasi arrow --}}
    <style>
    .rotate-180 {
        transform: rotate(180deg);
    }

    .transition-transform {
        transition: transform 0.3s ease-in-out;
    }

    /* Untuk animasi accordion yang lebih smooth */
    [x-show] {
        transition: all 0.3s ease-in-out;
    }

    /* Alternative CSS untuk accordion tanpa Alpine.js */
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .accordion-content.open {
        max-height: 1000px; /* Sesuaikan dengan tinggi konten maksimal */
    }
    </style>


    <div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-blue-700 text-center">Panduan & SOP Pengajar</h1>

        <div class="space-y-6">

            <div x-data="{ open: false }" class="bg-white border border-blue-300 rounded-xl shadow-md overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg">
                <button @click="open = !open" class="w-full text-left px-4 py-3 sm:px-6 sm:py-4 font-semibold text-blue-800 bg-blue-100 hover:bg-blue-200 flex justify-between items-center transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                    <span class="flex items-center text-lg sm:text-xl">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13.5m0-13.5c-4.142 0-7.5 3.164-7.5 7.054s3.358 7.054 7.5 7.054 7.5-3.164 7.5-7.054S16.142 6.253 12 6.253z"></path></svg>
                        Cara Melakukan Absensi Murid
                    </span>
                    {{-- Arrow: down ketika tutup, up ketika buka --}}
                    <svg :class="{'rotate-180': open}" class="w-6 h-6 text-blue-600 transition-transform duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" 
                    x-transition:enter="transition ease-out duration-300" 
                    x-transition:enter-start="opacity-0 max-h-0" 
                    x-transition:enter-end="opacity-100 max-h-screen" 
                    x-transition:leave="transition ease-in duration-200" 
                    x-transition:leave-start="opacity-100 max-h-screen" 
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="px-4 py-3 sm:px-6 sm:py-4 text-gray-700 text-sm sm:text-base border-t border-blue-200 overflow-hidden">
                    <p class="mb-3">Ikuti langkah-langkah berikut untuk mencatat absensi murid:</p>
                    <ol class="list-decimal list-inside space-y-2">
                        <li>Masuk ke halaman <strong>Absensi Murid</strong>, bisa melalui sidebar atau dashboard.</li>
                        <li>Klik tombol <a href="{{ route('pengajar.muridAbsensi.index') }}"> <span class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-xs font-semibold whitespace-nowrap"> + Absen Murid</span>.</li></a>
                        <li>Anda akan diarahkan ke form absensi murid.</li>
                        <li>Pada bagian <strong>Pilih Murid</strong>, pilih murid yang ingin diabsen.</li>
                        <li>Data seperti <strong>Nama Murid</strong>, <strong>Jenis Kelamin</strong>, dan <strong>Jenis Bacaan</strong> akan terisi otomatis.</li>
                        <li>Pilih <strong>Status Kehadiran</strong> (Hadir atau Izin) yang sesuai.</li>
                        <li><strong>Tanggal</strong> akan otomatis terisi hari ini, tidak perlu diubah.</li>
                        <li>Tulis kegiatan murid hari itu di bagian <strong>Catatan</strong>. Contoh: <em>"Baca Iqro halaman 5–8"</em>.</li>
                        <li>Klik tombol <span class="inline-block bg-green-600 text-white px-2 py-1 rounded text-xs font-semibold whitespace-nowrap">Simpan Absensi</span>.</li>
                        <li>Ulangi langkah di atas untuk murid lainnya.</li>
                    </ol>
                </div>
            </div>

            <hr class="border-blue-300 my-8">

            <div class="pt-4">
                <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-blue-700 text-center">SOP Pengajar</h2>
                <div x-data="{ open: false }" class="bg-white border border-blue-300 rounded-xl shadow-md overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg">
                    <button @click="open = !open" class="w-full text-left px-4 py-3 sm:px-6 sm:py-4 font-semibold text-blue-800 bg-blue-100 hover:bg-blue-200 flex justify-between items-center transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                        <span class="flex items-center text-lg sm:text-xl">
                            <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2A9 9 0 111 10a9 9 0 0118 0z"></path></svg>
                            SOP Pengajar
                        </span>
                        {{-- Arrow: down ketika tutup, up ketika buka --}}
                        <svg :class="{'rotate-180': open}" class="w-6 h-6 text-blue-600 transition-transform duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-300" 
                        x-transition:enter-start="opacity-0 max-h-0" 
                        x-transition:enter-end="opacity-100 max-h-screen" 
                        x-transition:leave="transition ease-in duration-200" 
                        x-transition:leave-start="opacity-100 max-h-screen" 
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="px-4 py-3 sm:px-6 sm:py-4 text-gray-700 text-sm sm:text-base border-t border-blue-200 overflow-hidden">
                        <p class="mb-3">Sebagai pengajar, harap perhatikan Standar Operasional Prosedur (SOP) berikut:</p>
                        <ol class="list-decimal list-inside space-y-2">
                            <li>Datang <strong>tepat waktu</strong> dan <strong>jangan terlambat</strong>.</li>
                            <li>Pastikan semua murid yang hadir terdata di sistem Absensi.</li>
                            <li><span class="inline-block bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold whitespace-nowrap bold">Dilarang</span> melakukan kekerasan fisik maupun mental terhadap murid.</li>
                            <li>Wajib memberikan konfirmasi apabila tidak bisa hadir mengajar.</li>
                            <li>Informasi ketidakhadiran disampaikan minimal H-1 sebelum jadwal mengajar.</li>
                            <li>Tegaskan dan berikan arahan yang jelas kepada murid apabila tidak bisa diatur.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <hr class="border-blue-300 my-8">

            <div class="pt-4">
                <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-blue-700 text-center">Fitur Website Absensi</h2>
                <div x-data="{ open: false }" class="bg-white border border-blue-300 rounded-xl shadow-md overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg">
                    <button @click="open = !open" class="w-full text-left px-4 py-3 sm:px-6 sm:py-4 font-semibold text-blue-800 bg-blue-100 hover:bg-blue-200 flex justify-between items-center transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                        <span class="flex items-center text-lg sm:text-xl">
                            <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Apa Saja Fitur yang Digunakan?
                        </span>
                        {{-- Arrow: down ketika tutup, up ketika buka --}}
                        <svg :class="{'rotate-180': open}" class="w-6 h-6 text-blue-600 transition-transform duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-300" 
                        x-transition:enter-start="opacity-0 max-h-0" 
                        x-transition:enter-end="opacity-100 max-h-screen" 
                        x-transition:leave="transition ease-in duration-200" 
                        x-transition:leave-start="opacity-100 max-h-screen" 
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="px-4 py-3 sm:px-6 sm:py-4 text-gray-700 text-sm sm:text-base border-t border-blue-200 overflow-hidden">
                        <p class="mb-3">Website absensi ini memiliki fitur-fitur utama sebagai berikut:</p>
                        <ol class="list-decimal list-inside space-y-2">
                            <li><a href="{{ route('pengajar.dashboard') }}" class="text-blue-600"> <strong>Dashboard</strong> </a>: Tampilan utama setelah login, menampilkan absen murid, info murid, nama pengajar, dan jadwal.</li>
                            <li><a href="{{ route('pengajar.muridAbsensi.index') }}" class="text-blue-600"> <strong>Absen Murid</strong> </a>: Melakukan absensi murid TPA.</li>
                            <li><a href="{{ route('pengajar.riwayatMuridAbsensi.index') }}" class="text-blue-600"> <strong>Riwayat Murid</strong> </a>: Melihat hasil riwayat absensi yang telah dicatat.</li>
                            <li><a href="{{ route('pengajar.infoDataMurid.index') }}" class="text-blue-600"> <strong>Info Data Murid</strong> </a>: Melihat semua data murid TPA yang telah terdaftar.</li>
                            <li><a href="{{ route('pengajar.infoDataPengajar.index') }}" class="text-blue-600"> <strong>Info Data Pengajar</strong> </a>: Melihat semua data pengajar TPA yang telah terdaftar.</li>
                            <li><a href="{{ route('pengajar.panduanPengajar.index') }}" class="text-blue-600"> <strong>Panduan Pengajar</strong> </a>: Halaman yang sedang Anda lihat ini, berisi panduan penggunaan sistem.</li>
                            <li><strong class="text-red-600">Logout</strong>: Keluar dari halaman dashboard dan kembali ke halaman login.</li>
                            <li><strong>Versi Web</strong>: Informasi versi pengembangan web.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Accordion (Jika tidak menggunakan Alpine.js) --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk vanilla JavaScript accordion (backup jika Alpine.js tidak ada)
        const accordionButtons = document.querySelectorAll('[data-accordion-button]');
        
        accordionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const arrow = this.querySelector('.accordion-arrow');
                const isOpen = content.style.display === 'block';
                
                // Close all accordions first
                accordionButtons.forEach(btn => {
                    const otherContent = btn.nextElementSibling;
                    const otherArrow = btn.querySelector('.accordion-arrow');
                    otherContent.style.display = 'none';
                    if (otherArrow) {
                        otherArrow.classList.remove('rotate-180');
                    }
                });
                
                // Open clicked accordion if it was closed
                if (!isOpen) {
                    content.style.display = 'block';
                    if (arrow) {
                        arrow.classList.add('rotate-180');
                    }
                }
            });
        });
    });
    </script>
    @endsection