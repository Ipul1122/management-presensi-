<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    
    {{-- Import Font Quicksand --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @vite('resources/css/app.css', 'resources/js/app.js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #10b981; /* Emerald-500 */
            border-radius: 4px;
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }
        
        /* Custom backdrop blur */
        .backdrop-blur-custom {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #059669, #34d399); 
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Hover animations */
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-custom border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <div class="flex-shrink-0 flex items-center gap-2">
                    {{-- <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <i class="fas fa-quran"></i>
                    </div> --}}
                    <a href="{{ route('index') }}" class="text-2xl font-bold text-gray-800 tracking-tight hover:text-emerald-600 transition-colors">
                        TPA Nurul Haq
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('index') }}" class="text-gray-600 hover:text-emerald-600 font-bold relative group text-sm uppercase tracking-wide">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-gray-600 hover:text-emerald-600 font-bold flex items-center group text-sm uppercase tracking-wide focus:outline-none">
                            Informasi
                            <svg class="ml-1 h-4 w-4 text-gray-400 group-hover:text-emerald-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                        </button>
                        
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0 transform scale-95 translate-y-2" 
                            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0" 
                            x-transition:leave="transition ease-in duration-150" 
                            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0" 
                            x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                            class="absolute left-0 mt-4 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 py-3 z-50">
                            
                            <a href="{{ route('user.informasi.visiDanMisi.index') }}" class="flex items-center px-5 py-3 text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 group transition-colors">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-bullseye text-emerald-600"></i>
                                </div>
                                <span class="font-semibold">Visi dan Misi</span>
                            </a>
                            <a href="{{ route('user.informasi.dataMurid.index') }}" class="flex items-center px-5 py-3 text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 group transition-colors">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users text-blue-600"></i>
                                </div>
                                <span class="font-semibold">Data Murid</span>
                            </a>
                            <a href="{{ route('user.informasi.dataPengajar.index') }}" class="flex items-center px-5 py-3 text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 group transition-colors">
                                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-chalkboard-teacher text-amber-600"></i>
                                </div>
                                <span class="font-semibold">Data Pengajar</span>
                            </a>
                            <a href="{{ route('user.informasi.jadwal.index') }}" class="flex items-center px-5 py-3 text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 group transition-colors">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-calendar-alt text-purple-600"></i>
                                </div>
                                <span class="font-semibold">Jadwal Belajar</span>
                            </a>
                            <a href="{{ route('user.informasi.riwayatMurid.index') }}" class="flex items-center px-5 py-3 text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 group transition-colors">
                                <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-history text-teal-600"></i>
                                </div>
                                <span class="font-semibold">Riwayat Murid</span>
                            </a>
                            <a href="{{route('user.semuaPoinMuridUser.index')}}" class="flex items-center px-5 py-3 text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 group transition-colors">
                                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-star text-rose-600"></i>
                                </div>
                                <span class="font-semibold">Poin & Prestasi</span>
                            </a>
                        </div>
                    </div>
                    
                    <a href="{{ route('user.galeri.index') }}" class="text-gray-600 hover:text-emerald-600 font-bold relative group text-sm uppercase tracking-wide">
                        Galeri
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('user.pendaftaran.index') }}" class="text-gray-600 hover:text-emerald-600 font-bold relative group text-sm uppercase tracking-wide">
                        Pendaftaran
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('user.peraturan.index') }}" class="text-gray-600 hover:text-emerald-600 font-bold relative group text-sm uppercase tracking-wide">
                        Peraturan
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('user.kontak.index') }}" class="text-gray-600 hover:text-emerald-600 font-bold relative group text-sm uppercase tracking-wide">
                        Kontak
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                <div class="hidden md:block">
                    <a href="{{ route('user.pendaftaran.index') }}" target="_blank" 
                       class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-emerald-200 hover:shadow-emerald-300 hover:-translate-y-1 transform transition-all duration-300 flex items-center group">
                        <i class="fas fa-user-plus mr-2 group-hover:rotate-12 transition-transform"></i>
                        Daftar Sekarang
                    </a>
                </div>

                <button x-data="{ open: false }" @click="open = !open; document.getElementById('mobile-menu').classList.toggle('hidden')" 
                        class="md:hidden p-2 rounded-lg text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-xl">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('index') }}" class="block text-gray-700 hover:text-emerald-600 font-semibold py-2">Home</a>
                
                <div x-data="{ mobileOpen: false }" class="border-b border-gray-50 pb-4">
                    <button @click="mobileOpen = !mobileOpen" 
                            class="flex items-center justify-between w-full text-gray-700 hover:text-emerald-600 font-semibold py-2">
                        <span>Informasi</span>
                        <svg class="h-4 w-4 transition-transform duration-300" :class="{ 'rotate-180': mobileOpen }" 
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="mobileOpen" x-transition class="ml-4 mt-2 space-y-2 border-l-2 border-emerald-100 pl-4">
                        <a href="{{ route('user.informasi.visiDanMisi.index') }}" class="block py-2 text-gray-600 hover:text-emerald-600">Visi dan Misi</a>
                        <a href="{{route('user.informasi.dataMurid.index')}}" class="block py-2 text-gray-600 hover:text-emerald-600">Data Murid</a>
                        <a href="{{route('user.informasi.dataPengajar.index')}}" class="block py-2 text-gray-600 hover:text-emerald-600">Data Pengajar</a>
                        <a href="{{route('user.informasi.jadwal.index')}}" class="block py-2 text-gray-600 hover:text-emerald-600">Jadwal</a>
                        <a href="{{route('user.informasi.riwayatMurid.index')}}" class="block py-2 text-gray-600 hover:text-emerald-600">Riwayat Murid</a>
                        <a href="{{route('user.semuaPoinMuridUser.index')}}" class="block py-2 text-gray-600 hover:text-emerald-600">Poin Murid</a>
                    </div>
                </div>
                
                <a href="{{route('user.galeri.index')}}" class="block text-gray-700 hover:text-emerald-600 font-semibold py-2">Galeri</a>
                <a href="{{route('user.pendaftaran.index')}}" class="block text-gray-700 hover:text-emerald-600 font-semibold py-2">Pendaftaran</a>
                <a href="{{route('user.peraturan.index')}}" class="block text-gray-700 hover:text-emerald-600 font-semibold py-2">Peraturan</a>
                <a href="{{route('user.kontak.index')}}" class="block text-gray-700 hover:text-emerald-600 font-semibold py-2">Kontak</a>
                
                <a href="{{ route('user.pendaftaran.index') }}" target="_blank" 
                   class="block bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-3 rounded-xl text-center font-bold shadow-lg mt-6 active:scale-95 transition-transform">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-20 flex-grow">
        @yield('navbar-user')
    </main>

    <footer class="relative bg-gradient-to-r from-emerald-500 to-teal-400 text-white mt-auto overflow-hidden">
        
        {{-- Hiasan Background (Circles) --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-yellow-300 opacity-20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        {{-- <div class="w-12 h-12 bg-white text-emerald-600 rounded-2xl flex items-center justify-center text-2xl shadow-lg transform rotate-3">
                            <i class="fas fa-quran"></i>
                        </div> --}}
                        <h2 class="text-3xl font-bold tracking-tight drop-shadow-md">TPA Nurul Haq</h2>
                    </div>
                    <p class="text-emerald-50 font-medium leading-relaxed bg-white/10 p-4 rounded-xl border border-white/20 backdrop-blur-sm">
                        "Membimbing generasi Qur'ani dengan penuh kasih sayang, ilmu, dan akhlak Islami."
                    </p>
                    
                    {{-- Social Media Buttons (Warna Warni) --}}
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-white text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white hover:-translate-y-1 transition-all shadow-md">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white text-pink-500 rounded-full flex items-center justify-center hover:bg-pink-500 hover:text-white hover:-translate-y-1 transition-all shadow-md">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/085693672730" class="w-10 h-10 bg-white text-green-500 rounded-full flex items-center justify-center hover:bg-green-500 hover:text-white hover:-translate-y-1 transition-all shadow-md">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-yellow-200 drop-shadow-sm border-b-2 border-white/20 pb-2 inline-block">Menu Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('index') }}" class="group flex items-center text-emerald-50 hover:text-white hover:translate-x-2 transition-all font-medium">
                            <span class="w-2 h-2 bg-yellow-300 rounded-full mr-3 group-hover:scale-150 transition-transform"></span>Beranda
                        </a></li>
                        <li><a href="{{ route('user.informasi.dataMurid.index') }}" class="group flex items-center text-emerald-50 hover:text-white hover:translate-x-2 transition-all font-medium">
                            <span class="w-2 h-2 bg-yellow-300 rounded-full mr-3 group-hover:scale-150 transition-transform"></span>Informasi
                        </a></li>
                        <li><a href="{{route('user.galeri.index')}}" class="group flex items-center text-emerald-50 hover:text-white hover:translate-x-2 transition-all font-medium">
                            <span class="w-2 h-2 bg-yellow-300 rounded-full mr-3 group-hover:scale-150 transition-transform"></span>Galeri Foto
                        </a></li>
                        <li><a href="{{route('user.pendaftaran.index')}}" class="group flex items-center text-emerald-50 hover:text-white hover:translate-x-2 transition-all font-medium">
                            <span class="w-2 h-2 bg-yellow-300 rounded-full mr-3 group-hover:scale-150 transition-transform"></span>Pendaftaran
                        </a></li>
                    </ul>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-yellow-200 drop-shadow-sm border-b-2 border-white/20 pb-2 inline-block">Hubungi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start bg-white/10 p-3 rounded-xl hover:bg-white/20 transition-colors cursor-default">
                            <i class="fas fa-map-marker-alt text-yellow-300 text-xl mr-3 mt-1"></i>
                            <span class="text-white text-sm leading-snug">
                                Jl. Rawa Bahagia I No.8, Grogol, Jakarta Barat 11450
                            </span>
                        </li>
                        <li class="flex items-center bg-white/10 p-3 rounded-xl hover:bg-white/20 transition-colors cursor-default">
                            <i class="fas fa-phone text-yellow-300 text-xl mr-3"></i>
                            <span class="text-white font-medium">0856-9367-2730 (Admin)</span>
                        </li>
                        {{-- <li class="flex items-center bg-white/10 p-3 rounded-xl hover:bg-white/20 transition-colors cursor-default">
                            <i class="fas fa-envelope text-yellow-300 text-xl mr-3"></i>
                            <span class="text-white text-sm">tpa.nurulhaq@gmail.com</span>
                        </li> --}}
                    </ul>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-yellow-200 drop-shadow-sm border-b-2 border-white/20 pb-2 inline-block">Lokasi</h3>
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white/30 transform hover:scale-105 transition-transform duration-300">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.738454302736!2d106.79538937413047!3d-6.1657695604241525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f642d88d5841%3A0x6c31ab35f182053a!2sMasjid%20Nurul%20Haq!5e0!3m2!1sid!2sid!4v1750151052295!5m2!1sid!2sid" 
                            width="100%" 
                            height="180" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/20 mt-12 pt-8 text-center">
                <p class="text-emerald-100 font-medium text-sm">
                    © {{ date('Y') }} <span class="font-bold text-white">TPA Nurul Haq</span>. 
                    Dibuat dengan <i class="fas fa-heart text-red-500 animate-pulse mx-1"></i> dan Semangat Belajar.
                </p>
            </div>
        </div>
    </footer>

    <div x-data="visitTimer()" x-init="startTimer()" x-show="showPopover" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 transform scale-90 translate-y-4" 
         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 transform scale-100 translate-y-0" 
         x-transition:leave-end="opacity-0 transform scale-90 translate-y-4"
         class="fixed bottom-6 right-6 bg-white border border-emerald-100 shadow-2xl rounded-2xl w-80 p-6 z-50">
        
        <div class="flex items-start mb-4">
            <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-emerald-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-bold text-gray-900">
                    Sudah <span x-text="elapsedMinutes" class="text-emerald-600 text-base"></span> menit di sini!
                </p>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                    Tertarik mendaftarkan putra-putri Anda? Yuk daftar sekarang!
                </p>
            </div>
        </div>
        
        <div class="flex gap-2">
            <a href="https://forms.gle/xwMYkaf2YXzuKiE99" target="_blank" 
               class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold text-center transition-colors shadow-md shadow-emerald-200">
                <i class="fas fa-user-plus mr-1"></i> Daftar
            </a>
            <button @click="dismiss()" 
                    class="px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-lg text-sm font-medium transition-colors border border-gray-100">
                Nanti
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('visitTimer', () => ({
                showPopover: false,
                elapsedMinutes: 0,
                shownTimes: [],
                
                startTimer() {
                    setInterval(() => {
                        this.elapsedMinutes++;
                        if ([1, 3, 5, 10].includes(this.elapsedMinutes) && !this.shownTimes.includes(this.elapsedMinutes)) {
                            this.shownTimes.push(this.elapsedMinutes);
                            this.showPopover = true;
                        }
                    }, 60000); 
                },
                
                dismiss() {
                    this.showPopover = false;
                }
            }));
        });
    </script>

</body>
</html>