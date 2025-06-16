@extends('components.user.navbar')

@section( 'content')

     <style>
        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .gradient-text {
            background: linear-gradient(
                45deg,
                #1d4ed8,
                #1e40af,
                #2563eb,
                #3b82f6,
                #60a5fa,
                #1d4ed8
            );
            background-size: 300% 300%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 3s ease-in-out infinite;
        }
        
        .gradient-text-highlight {
            background: linear-gradient(
                45deg,
                #2563eb,
                #3b82f6,
                #60a5fa,
                #1d4ed8,
                #1e40af,
                #2563eb
            );
            background-size: 300% 300%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 2.5s ease-in-out infinite reverse;
        }

        /* MODAL GALERI */
        .modal {
            backdrop-filter: blur(10px);
        }
        
        .modal-content {
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

    </style>


    {{-- Hero Section --}}
    <section class="w-full bg-gradient-to-br from-emerald-100 to-white py-16 px-6 md:px-12 lg:px-20">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-2 items-center gap-10">
            
            {{-- Left Content --}}
            <div class="space-y-6 text-center md:text-left">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold gradient-text leading-tight">
                    Daftar TPA jadi <br>
                    <span class="gradient-text-highlight">Lebih Mudah</span> <br>
                    Di Website 
                </h1>
                <p class="text-gray-600 text-lg sm:text-xl">
                    Dibangun untuk mempermudah orang tua melihat perkembangan anak murid selama di TPA Nurul Haq.
                </p>
                <a href="" 
                class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 shadow-md">
                    Daftar Yuk
                </a>
            </div>

            {{-- Right Image --}}
            <div class="flex justify-center ">
                <img src="{{ asset('images/hero-section-homepage-image.svg') }}" 
                    alt="Ilustrasi Hero" 
                    class="max-w-full h-auto md:max-w-[85%] rounded-xl drop-shadow-xl">
            </div>

        </div>
    </section>

    {{-- VISI MISI --}}
    <section class="py-16 bg-gray-50" id="visi-misi">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10 text-emerald-700">Visi & Misi TPA Nurul Haq</h2>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left: Visi -->
            <div class="w-full md:w-1/2 mr-28">
                <div x-data="{ open: true }" class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                    <button @click="open = !open" class="w-full  px-5 py-4 bg-emerald-100 font-semibold text-emerald-700 hover:bg-emerald-200 text-center">
                        Visi
                    </button>
                    <div x-show="open" x-transition class="px-5 py-4 text-gray-700">
                        <p>
                            Menjadikan TPA rumah kedua sebagai pusat pembelajaran yang inspiratif, tempat anak-anak tumbuh cerdas, berakhlak mulia, dan berani berinovasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Misi -->
            <div class="w-full md:w-1/2">
                <div x-data="{ open: true }" class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                    <button @click="open = !open" class="w-full text-center px-5 py-4 bg-emerald-100 font-semibold text-emerald-700 hover:bg-emerald-200">
                        Misi
                    </button>
                    <div x-show="open" x-transition class="px-5 py-4 text-gray-700 space-y-2">
                        <ul class="list-disc pl-5">
                            <li>Memberikan edukasi ilmu pengetahuan seperti matematika, IPA, IPS dll</li>
                            <li>Membangun kreatifitas, berpikir kritis, berlogika</li>
                            <li>Mempelajari adab, etika dan moral </li>
                            <li>Membaca alkitab iqro atau Al-Qur'an</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


 <!-- GALERI -->
    <section class="bg-white">
        <div class="py-4 px-2 mx-auto max-w-screen-xl sm:py-4 lg:px-6">
            <h2 class="text-3xl font-bold text-center mb-10 text-emerald-700">Galeri TPA</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 h-full">
                <div class="col-span-2 sm:col-span-1 md:col-span-2 bg-gray-50 h-auto md:h-full flex flex-col">
                    <a href="#" onclick="openModal('{{ asset('images/foto_tpa/foto_tpa5.jpg') }}', 'Benefit Murid Terbaik')" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 flex-grow cursor-pointer object-cover">
                        <img src="{{ asset('images/foto_tpa/foto_tpa5.jpg') }}" alt="Benefit Murid Terbaik" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"><span class="gradient-text-highlight">Benefit Murid Terbaik</span></h3>
                    </a>
                </div>
                <div class="col-span-2 sm:col-span-1 md:col-span-2 bg-stone-50">
                    <a href="#" onclick="openModal('{{ asset('images/foto_tpa/foto_tpa1.jpg') }}', 'Pesantren Ramadhan')" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 mb-4 cursor-pointer">
                        <img src="{{ asset('images/foto_tpa/foto_tpa1.jpg') }}" alt="Pesantren Ramadhan" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"><span class="gradient-text-highlight">Pesantren Ramadhan</span></h3>
                    </a>
                    <div class="grid gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-2">
                        <a href="#" onclick="openModal('{{ asset('images/foto_tpa/foto_tpa4.jpg') }}', 'Benefit')" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 cursor-pointer">
                            <img src="{{ asset('images/foto_tpa/foto_tpa4.jpg') }}" alt="Benefit" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                            <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"><span class="gradient-text-highlight">Benefit</span></h3>
                        </a>
                        <a href="#" onclick="openModal('{{ asset('images/foto_tpa/foto_tpa3.jpg') }}', 'Benefit')" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 cursor-pointer">
                            <img src="{{ asset('images/foto_tpa/foto_tpa3.jpg') }}" alt="Benefit" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                            <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"><span class="gradient-text-highlight">Benefit</span></h3>
                        </a>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-1 md:col-span-1 bg-sky-50 h-auto md:h-full flex flex-col">
                    <a href="#" onclick="openModal('{{ asset('images/foto_tpa/foto_tpa2.jpg') }}', 'Lomba Gambar')" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 flex-grow cursor-pointer">
                        <img src="{{ asset('images/foto_tpa/foto_tpa2.jpg') }}" alt="Lomba Gambar" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"><span class="gradient-text-highlight">Lomba Gambar</span></h3>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Full Preview -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 modal">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative max-w-4xl w-full modal-content">
                <!-- Header dengan tombol Back dan Download -->
                <div class="flex justify-between items-center mb-4">
                    <button onclick="closeModal()" class="flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali</span>
                    </button>
                    
                    <h3 id="modalTitle" class="text-white text-xl font-semibold text-center flex-1"></h3>
                    
                    <button onclick="downloadImage()" class="flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Download</span>
                    </button>
                </div>
                
                <!-- Gambar -->
                <div class="bg-white rounded-lg p-2">
                    <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain rounded">
                </div>                
            </div>
        </div>
    </div>


    {{-- TESTIMONI --}}
    <section class="bg-white py-16" id="testimoni">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-emerald-700 mb-10">Testimoni Orang Tua</h2>

        <div 
            x-data="{
                testimonials: [
                    {
                        foto: '{{ asset("images/testimoni1.jpg") }}',
                        nama: 'Bunda Aisyah',
                        deskripsi: 'Anak saya jadi lebih semangat belajar mengaji dan selalu ingin datang ke TPA setiap hari.'
                    },
                    {
                        foto: '{{ asset("images/testimoni2.jpg") }}',
                        nama: 'Pak Fadli',
                        deskripsi: 'Saya merasa lebih tenang karena bisa memantau perkembangan anak melalui web ini.'
                    },
                    {
                        foto: '{{ asset("images/testimoni3.jpg") }}',
                        nama: 'Ibu Rina',
                        deskripsi: 'Guru-gurunya ramah dan metode ngajinya menyenangkan. Terima kasih TPA Nurul Haq!'
                    }
                ],
                active: 0,
                get showControls() {
                    return this.testimonials.length > 3;
                }
            }"
            class="relative"
        >
            <!-- Wrapper -->
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out"
                    :style="`transform: translateX(-${active * 100}%); width: ${testimonials.length * 100}%`">
                    
                    <template x-for="(item, index) in testimonials" :key="index">
                        <div class="w-full sm:w-1/2 md:w-1/3 flex-shrink-0 p-4">
                            <div class="bg-gray-50 rounded-lg p-6 shadow text-center h-full flex flex-col items-center">
                                <img :src="item.foto" alt="foto"
                                    class="w-16 h-16 rounded-full object-cover mb-4 border-2 border-emerald-500">
                                <h3 class="text-lg font-semibold text-emerald-700" x-text="item.nama"></h3>
                                <p class="text-sm text-gray-600 mt-2" x-text="item.deskripsi"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Navigasi Panah -->
            <template x-if="showControls">
                <div>
                    <button 
                        @click="active = active === 0 ? testimonials.length - 3 : active - 1"
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white border rounded-full shadow p-2 hover:bg-emerald-100">
                        <i class="fas fa-chevron-left text-emerald-700"></i>
                    </button>
                    <button 
                        @click="active = active + 1 >= testimonials.length - 2 ? 0 : active + 1"
                        class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white border rounded-full shadow p-2 hover:bg-emerald-100">
                        <i class="fas fa-chevron-right text-emerald-700"></i>
                    </button>
                </div>
            </template>
        </div>
    </div>
</section>



    <script>

        // MODAL GALERI

        // Inisialisasi variabel untuk menyimpan gambar yang sedang ditampilkan
        let currentImageSrc = '';
        let currentImageTitle = '';

        function openModal(imageSrc, imageTitle) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            
            currentImageSrc = imageSrc;
            currentImageTitle = imageTitle;
            
            modalImage.src = imageSrc;
            modalImage.alt = imageTitle;
            modalTitle.textContent = imageTitle;
            
            modal.classList.remove('hidden');
            modal.classList.add('fade-in');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('fade-in');
            document.body.style.overflow = 'auto';
        }

        async function downloadImage() {
            if (currentImageSrc) {
                try {
                    // Tampilkan loading
                    showNotification('Mengunduh foto...', 'info');
                    
                    // Fetch gambar sebagai blob
                    const response = await fetch(currentImageSrc);
                    const blob = await response.blob();
                    
                    // Buat URL untuk blob
                    const blobUrl = window.URL.createObjectURL(blob);
                    
                    // Membuat link download
                    const link = document.createElement('a');
                    link.href = blobUrl;
                    link.download = currentImageTitle.replace(/\s+/g, '_').toLowerCase() + '.jpg';
                    link.style.display = 'none';
                    
                    // Trigger download
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    // Cleanup blob URL
                    window.URL.revokeObjectURL(blobUrl);
                    
                    // Tampilkan notifikasi sukses
                    showNotification('Foto berhasil diunduh!', 'success');
                    
                } catch (error) {
                    console.error('Error downloading image:', error);
                    showNotification('Gagal mengunduh foto. Coba lagi.', 'error');
                }
            }
        }

        function showNotification(message, type = 'success') {
            // Membuat notifikasi dengan berbagai tipe
            const notification = document.createElement('div');
            let bgColor = 'bg-emerald-600';
            let icon = '✓';
            
            if (type === 'error') {
                bgColor = 'bg-red-600';
                icon = '✗';
            } else if (type === 'info') {
                bgColor = 'bg-blue-600';
                icon = 'ℹ';
            }
            
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 flex items-center space-x-2`;
            notification.innerHTML = `
                <span class="text-lg font-bold">${icon}</span>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            // Hapus notifikasi setelah 3 detik
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }

        // Tutup modal ketika klik di luar gambar
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Tutup modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>

@endsection
