@extends('components.user.navbar')

@section('navbar-user')

    {{-- Import Font Quicksand dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        

        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-up {
            animation: fadeUp 0.8s ease-out forwards;
        }

        /* Gradient Text */
        .text-gradient-emerald {
            background: linear-gradient(135deg, #059669 0%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Custom Scrollbar for Modal */
        .modal-scroll::-webkit-scrollbar {
            width: 8px;
        }
        .modal-scroll::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        .modal-scroll::-webkit-scrollbar-thumb {
            background: #10b981; 
            border-radius: 4px;
        }
    </style>

    {{-- 1. HERO SECTION --}}
    <section class="relative w-full overflow-hidden bg-gradient-to-b from-emerald-50 via-white to-white pt-24 pb-16 lg:pt-32 lg:pb-24">
        {{-- Background Blobs Decoration --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-amber-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float"></div>
        <div class="absolute top-0 left-0 -ml-20 -mt-20 w-72 h-72 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float" style="animation-delay: 2s"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                {{-- Left Content --}}
                <div class="space-y-8 text-center lg:text-left fade-up">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-emerald-100 text-emerald-800 text-sm font-semibold mb-2">
                        <span class="mr-2">✨</span> TPA Nurul Haq
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-gray-900">
                        Membangun Generasi <br>
                        <span class="text-gradient-emerald">Qur'ani & Berakhlak</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Rumah kedua bagi buah hati Anda untuk belajar Al-Qur'an, adab, dan ilmu pengetahuan dalam lingkungan yang ceria dan penuh kasih sayang.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('user.daftar.index') }}" target="_blank" 
                           class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-emerald-600 border border-transparent rounded-2xl hover:bg-emerald-700 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600">
                            Daftar Sekarang
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="#program" 
                           class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-emerald-700 transition-all duration-200 bg-emerald-50 border border-emerald-200 rounded-2xl hover:bg-emerald-100 hover:text-emerald-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Lihat Program
                        </a>
                    </div>

                    {{-- Mini Stats --}}
                    <div class="pt-8 flex items-center justify-center lg:justify-start gap-8 text-gray-500 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            Terpercaya
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                            Berpengalaman
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            Fasilitas Lengkap
                        </div>
                    </div>
                </div>

                {{-- Right Image --}}
                <div class="relative lg:h-auto flex justify-center">
                    <div class="relative w-full max-w-lg mx-auto">
                        <div class="absolute top-0 -left-4 w-72 h-72 bg-amber-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-pulse"></div>
                        <div class="absolute bottom-0 -right-4 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-pulse" style="animation-delay: 1s"></div>
                        <img src="{{ asset('images/hero-section-homepages.svg') }}" 
                             alt="Anak Mengaji" 
                             class="relative transform hover:scale-105 transition duration-500 drop-shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. STATISTIK SINGKAT (Baru) --}}
    <section class="py-10 bg-emerald-600 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-emerald-500/50">
            <div>
                <div class="flex justify-center items-baseline mb-1">
                    <span id="murid-count" class="text-3xl font-bold">0</span>
                    <span class="text-3xl font-bold ml-1">+</span>
                </div>
                <p class="text-emerald-100 text-sm">Murid Aktif</p>
            </div>

            <div>
                <div class="flex justify-center items-baseline mb-1">
                    <span id="pengajar-count" class="text-3xl font-bold">0</span>
                    <span class="text-3xl font-bold ml-1">+</span>
                </div>
                <p class="text-emerald-100 text-sm">Pengajar</p>
            </div>

            <div>
                <p class="text-3xl font-bold mb-1">2 th +</p>
                <p class="text-emerald-100 text-sm">Berdiri</p>
            </div>

            <div>
                <p class="text-3xl font-bold mb-1">100%</p>
                <p class="text-emerald-100 text-sm">Ceria</p>
            </div>
        </div>
    </section>

    {{-- 3. VISI & MISI (Refactored: Cards Layout) --}}
    <section class="py-20 bg-white" id="visi-misi">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm">Tentang Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Visi & Misi TPA Nurul Haq</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-emerald-200 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-100 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6 text-2xl relative z-10">
                        🌟
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi Kami</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        "Menjadikan TPA rumah kedua sebagai pusat pembelajaran yang inspiratif, tempat anak-anak tumbuh cerdas, berakhlak mulia, dan berani berinovasi."
                    </p>
                </div>

                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-amber-200 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6 text-2xl relative z-10">
                        🎯
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Edukasi ilmu pengetahuan umum (Matematika, IPA, dll)</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Membangun kreatifitas, berpikir kritis, & logika</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Pembentukan karakter, adab, dan etika Islami</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Membaca Iqro dan Al-Qur'an dengan tartil</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. PROGRAM UNGGULAN (Baru - Content Additions) --}}
    <section id="program" class="py-20 bg-emerald-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-amber-600 font-bold tracking-wider uppercase text-sm">Kurikulum</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Program Unggulan</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Kami memadukan pendidikan agama dan umum agar anak siap menghadapi masa depan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow text-center">
                    <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center text-3xl mb-4">📖</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tahsin & Tahfidz</h3>
                    <p class="text-gray-600 text-sm">Bimbingan membaca Al-Qur'an dari nol hingga lancar serta hafalan surat-surat pendek.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow text-center">
                    <div class="w-16 h-16 mx-auto bg-amber-100 rounded-full flex items-center justify-center text-3xl mb-4">🕌</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Fiqih Ibadah</h3>
                    <p class="text-gray-600 text-sm">Praktik sholat, wudhu, dan doa harian yang diajarkan dengan metode menyenangkan.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-3xl mb-4">🎨</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Kreativitas</h3>
                    <p class="text-gray-600 text-sm">Menggambar, mewarnai, dan bimbingan pelajaran sekolah (Matematika/IPA) sepulang sekolah.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. GALERI (Refactored: Better Overlay & Layout) --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Galeri Kegiatan</h2>
                <p class="text-gray-500 mt-2">Keseruan santri saat belajar dan bermain</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 h-[600px] md:h-[500px]">
                {{-- Item Besar Kiri --}}
                <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-2xl cursor-pointer shadow-lg"
                     onclick="openModal('{{ asset('images/foto_tpa/foto_tpa5.jpg') }}', 'Benefit Murid Terbaik')">
                    <img src="{{ asset('images/foto_tpa/foto_tpa5.jpg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Galeri">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h3 class="text-white text-xl font-bold">Benefit Murid Terbaik</h3>
                        <p class="text-gray-300 text-sm mt-1">Apresiasi prestasi santri</p>
                    </div>
                </div>

                {{-- Item Kanan Atas --}}
                <div class="col-span-1 relative group overflow-hidden rounded-2xl cursor-pointer shadow-md"
                     onclick="openModal('{{ asset('images/foto_tpa/foto_tpa1.jpg') }}', 'Pesantren Ramadhan')">
                    <img src="{{ asset('images/foto_tpa/foto_tpa1.jpg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Galeri">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-white font-bold text-sm">Pesantren Ramadhan</h3>
                    </div>
                </div>

                {{-- Item Kanan Atas 2 --}}
                <div class="col-span-1 relative group overflow-hidden rounded-2xl cursor-pointer shadow-md"
                     onclick="openModal('{{ asset('images/foto_tpa/foto_tpa2.jpg') }}', 'Lomba Gambar')">
                    <img src="{{ asset('images/foto_tpa/foto_tpa2.jpg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Galeri">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-white font-bold text-sm">Lomba Gambar</h3>
                    </div>
                </div>

                {{-- Item Kanan Bawah Panjang --}}
                <div class="col-span-2 relative group overflow-hidden rounded-2xl cursor-pointer shadow-md"
                     onclick="openModal('{{ asset('images/foto_tpa/foto_tpa6.jpg') }}', 'Refreshing Outdoor')">
                    <img src="{{ asset('images/foto_tpa/foto_tpa6.jpg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Galeri">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-white font-bold text-lg">Refreshing & Outbound</h3>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('user.galeri.index') }}" class="inline-block text-emerald-600 font-semibold hover:text-emerald-800 transition">
                    Lihat Semua Galeri &rarr;
                </a>
            </div>
        </div>
    </section>

    {{-- 6. TESTIMONI (Refactored: Grid Layout) --}}
    <section id="testimoni" class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Kata Mereka</h2>
                <p class="text-gray-500 mt-2">Apa kata orang tua santri tentang TPA Nurul Haq?</p>
            </div>

            @if ($testimonis->isEmpty())
                <div class="bg-white p-8 rounded-2xl shadow-sm text-center max-w-lg mx-auto border border-dashed border-gray-300">
                    <div class="text-5xl mb-4">💬</div>
                    <p class="text-gray-600 mb-4">Belum ada testimoni saat ini. Jadilah yang pertama memberikan ulasan!</p>
                    <a href="{{ route('user.testimoni.index') }}" class="inline-block px-6 py-2 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition">
                        Tulis Testimoni
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($testimonis->where('status', 'approved')->take(6) as $testimoni)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4 mb-4">
                                @if($testimoni->foto_user)
                                    <img src="{{ asset('storage/' . $testimoni->foto_user) }}" alt="foto" class="h-12 w-12 rounded-full object-cover ring-2 ring-emerald-100">
                                @else
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-400 to-green-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                        {{ strtoupper(substr($testimoni->nama_user, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $testimoni->nama_user }}</h4>
                                    <div class="flex text-amber-400 text-xs">
                                        ★★★★★
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 italic text-sm leading-relaxed">"{{ $testimoni->isi_testimoni }}"</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-10">
                    <a href="{{ route('user.testimoni.index') }}" class="inline-flex items-center space-x-2 text-emerald-600 font-semibold hover:text-emerald-800 transition p-2 bg-emerald-50 rounded-lg px-4">
                        <span>Lihat Semua & Berikan Ulasan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    


    {{-- IMAGE MODAL (Logic Updated) --}}
    <div x-data="{ open: false, imgSrc: '', imgTitle: '' }"
         @open-image-modal.window="open = true; imgSrc = $event.detail.src; imgTitle = $event.detail.title"
         @keydown.escape.window="open = false"
         class="relative z-[9999]">
         
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/90 backdrop-blur-sm"></div>

        <div x-show="open"
             class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
             @click.self="open = false">
             
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="relative max-w-5xl w-full bg-transparent shadow-2xl rounded-2xl overflow-hidden flex flex-col items-center justify-center">
                 
                 <button @click="open = false" class="absolute top-4 right-4 z-50 text-white hover:text-gray-300 bg-black/50 rounded-full p-2 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                 </button>

                 <img :src="imgSrc" :alt="imgTitle" class="max-h-[85vh] w-auto object-contain rounded-lg shadow-2xl border-4 border-white/10">
                 
                 <div class="mt-4 text-center">
                    <h3 class="text-white text-xl font-semibold tracking-wide" x-text="imgTitle"></h3>
                    <a :href="imgSrc" download class="mt-4 inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition text-sm font-medium shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Foto
                    </a>
                 </div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        // Helper function untuk trigger Alpine modal
        function openModal(src, title) {
            window.dispatchEvent(new CustomEvent('open-image-modal', {
                detail: { src: src, title: title }
            }));
        }

        function countUp(id, target) {
        let el = document.getElementById(id);
        if (!el) return;
        
        // Pastikan target adalah angka integer
        target = parseInt(target);
        
        let count = 0;
        // Logic kecepatan: target besar lebih cepat, target kecil lebih lambat
        let duration = 2000; // Durasi animasi total 2 detik
        let intervalTime = 20; // Update setiap 20ms
        let steps = duration / intervalTime; 
        let increment = target > 0 ? Math.ceil(target / steps) : 0;

        if (target === 0) {
            el.textContent = 0;
            return;
        }

        let interval = setInterval(() => {
            count += increment;
            if (count >= target) {
                count = target;
                clearInterval(interval);
            }
            el.textContent = count.toLocaleString('id-ID'); 
        }, intervalTime);
    }

    document.addEventListener("DOMContentLoaded", () => {
        // Mengambil data dari variabel Blade Controller
        // Menggunakan json_encode untuk memastikan output aman (menjadi angka murni)
        let totalMurid = {{ $murids ?? 0 }};
        let totalPengajar = {{ $pengajars ?? 0 }};

        countUp('murid-count', totalMurid);
        countUp('pengajar-count', totalPengajar);
    });
    </script>

@endsection