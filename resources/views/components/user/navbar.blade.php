<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 3px;
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }
        
        /* Custom backdrop blur */
        .backdrop-blur-custom {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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
<body class="bg-gray-50 text-gray-800">

    <!-- Modern Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-custom border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-2xl font-bold gradient-text hover-scale">
                        TPA Nurul Haq
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('index') }}" class="text-gray-700 hover:text-blue-600 font-medium relative group">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    
                    <!-- Dropdown Menu -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="text-gray-700 hover:text-blue-600 font-medium flex items-center group">
                            Informasi
                            <svg class="ml-1 h-4 w-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </button>
                        
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0 transform scale-95 translate-y-2" 
                            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0" 
                            x-transition:leave="transition ease-in duration-150" 
                            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0" 
                            x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                            class="absolute left-0 mt-3 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            
                            <a href="{{ route('user.informasi.visiDanMisi.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 group">
                                <i class="fas fa-bullseye mr-3 text-blue-500 group-hover:scale-110 transition-transform"></i>
                                <span>Visi dan Misi</span>
                            </a>
                            <a href="{{ route('user.informasi.dataMurid.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 group">
                                <i class="fas fa-users mr-3 text-blue-500 group-hover:scale-110 transition-transform"></i>
                                <span>Data Murid</span>
                            </a>
                            <a href="{{ route('user.informasi.dataPengajar.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 group">
                                <i class="fas fa-chalkboard-teacher mr-3 text-blue-500 group-hover:scale-110 transition-transform"></i>
                                <span>Data Pengajar</span>
                            </a>
                            <a href="{{ route('user.informasi.jadwal.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 group">
                                <i class="fas fa-calendar-alt mr-3 text-blue-500 group-hover:scale-110 transition-transform"></i>
                                <span>Jadwal</span>
                            </a>
                            <a href="{{ route('user.informasi.riwayatMurid.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 group">
                                <i class="fas fa-history mr-3 text-blue-500 group-hover:scale-110 transition-transform"></i>
                                <span>Riwayat Murid</span>
                            </a>
                        </div>
                    </div>
                    
                    <a href="{{ route('user.galeri.index') }}" class="text-gray-700 hover:text-blue-600 font-medium relative group">
                        Galeri
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('user.pendaftaran.index') }}" class="text-gray-700 hover:text-blue-600 font-medium relative group">
                        Pendaftaran
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('user.kontak.index') }}" class="text-gray-700 hover:text-blue-600 font-medium relative group">
                        Kontak
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="https://forms.gle/xwMYkaf2YXzuKiE99" target="_blank" 
                       class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-lg hover:shadow-xl hover-lift transform transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button x-data="{ open: false }" @click="open = !open; document.getElementById('mobile-menu').classList.toggle('hidden')" 
                        class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('index') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Home</a>
                
                <div x-data="{ mobileOpen: false }" class="border-b border-gray-100 pb-4">
                    <button @click="mobileOpen = !mobileOpen" 
                            class="flex items-center justify-between w-full text-gray-700 hover:text-blue-600 font-medium py-2">
                        <span>Informasi</span>
                        <svg class="h-4 w-4 transition-transform duration-300" :class="{ 'rotate-180': mobileOpen }" 
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="mobileOpen" x-transition class="ml-4 mt-3 space-y-3">
                        <a href="{{ route('user.informasi.visiDanMisi.index') }}" class="flex items-center text-gray-600 hover:text-blue-600 py-2">
                            <i class="fas fa-bullseye mr-3 text-blue-500"></i>
                            <span>Visi dan Misi</span>
                        </a>
                        <a href="{{route('user.informasi.dataMurid.index')}}" class="flex items-center text-gray-600 hover:text-blue-600 py-2">
                            <i class="fas fa-users mr-3 text-blue-500"></i>
                            <span>Data Murid</span>
                        </a>
                        <a href="{{route('user.informasi.dataPengajar.index')}}" class="flex items-center text-gray-600 hover:text-blue-600 py-2">
                            <i class="fas fa-chalkboard-teacher mr-3 text-blue-500"></i>
                            <span>Data Pengajar</span>
                        </a>
                        <a href="{{route('user.informasi.jadwal.index')}}" class="flex items-center text-gray-600 hover:text-blue-600 py-2">
                            <i class="fas fa-calendar-alt mr-3 text-blue-500"></i>
                            <span>Jadwal</span>
                        </a>
                        <a href="{{route('user.informasi.riwayatMurid.index')}}" class="flex items-center text-gray-600 hover:text-blue-600 py-2">
                            <i class="fas fa-history mr-3 text-blue-500"></i>
                            <span>Riwayat Murid</span>
                        </a>
                    </div>
                </div>
                
                <a href="{{route('user.galeri.index')}}" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Galeri</a>
                <a href="{{route('user.pendaftaran.index')}}" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Pendaftaran</a>
                <a href="{{route('user.testimoni.index')}}" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Kontak</a>
                <a href="https://forms.gle/xwMYkaf2YXzuKiE99" target="_blank" 
                   class="block bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-3 rounded-lg text-center font-semibold shadow-lg mt-4">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('navbar-user')
    </main>

    <!-- Modern Footer -->
    <footer class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Brand Section -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold">TPA Nurul Haq</h2>
                    <p class="text-blue-100 leading-relaxed">
                        Membimbing generasi Qur'ani dengan penuh kasih sayang, ilmu, dan akhlak Islami untuk masa depan yang cerah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Menu Utama</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-home mr-2"></i>Beranda
                        </a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>Informasi
                        </a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-images mr-2"></i>Galeri
                        </a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-user-plus mr-2"></i>Pendaftaran
                        </a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-envelope mr-2"></i>Kontak
                        </a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Kontak Kami</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 mt-1 text-blue-300"></i>
                            <span class="text-blue-100 text-sm">
                                Jl. Rawa Bahagia I No.8, Grogol, Jakarta Barat 11450
                            </span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-blue-300"></i>
                            <span class="text-blue-100">0812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-300"></i>
                            <span class="text-blue-100">tpa.nurulhaq@gmail.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-blue-300"></i>
                            <span class="text-blue-100">Senin - Minggu: 08.00 - 17.00</span>
                        </li>
                    </ul>
                </div>

                <!-- Location Map -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Lokasi Kami</h3>
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.738454302736!2d106.79538937413047!3d-6.1657695604241525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f642d88d5841%3A0x6c31ab35f182053a!2sMasjid%20Nurul%20Haq!5e0!3m2!1sid!2sid!4v1750151052295!5m2!1sid!2sid" 
                            width="100%" 
                            height="150" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-blue-500/30 mt-8 pt-8 text-center">
                <p class="text-blue-100 text-sm">
                    &copy; 2025 TPA Nurul Haq. Dibuat dengan <i class="fas fa-heart text-red-400"></i> untuk generasi Qur'ani.
                </p>
            </div>
        </div>
    </footer>

    <!-- Notification Popover -->
    <div x-data="visitTimer()" x-init="startTimer()" x-show="showPopover" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 transform scale-90 translate-y-4" 
         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 transform scale-100 translate-y-0" 
         x-transition:leave-end="opacity-0 transform scale-90 translate-y-4"
         class="fixed bottom-6 right-6 bg-white border border-gray-200 shadow-2xl rounded-xl w-80 p-6 z-50">
        
        <div class="flex items-start mb-4">
            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-blue-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                    Sudah <span x-text="elapsedMinutes" class="font-bold text-blue-600"></span> menit mengunjungi website!
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Jangan lewatkan kesempatan bergabung dengan kami
                </p>
            </div>
        </div>
        
        <div class="flex space-x-2">
            <a href="https://forms.gle/xwMYkaf2YXzuKiE99" target="_blank" 
               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium text-center transition-colors">
                <i class="fas fa-user-plus mr-1"></i>
                Daftar
            </a>
            <button @click="dismiss()" 
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors">
                Nanti
            </button>
            <button @click="dismiss()" 
                    class="px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg text-sm font-medium transition-colors">
                <i class="fas fa-check mr-1"></i>
                Sudah
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
                    }, 60000); // 1 minute
                },
                
                dismiss() {
                    this.showPopover = false;
                }
            }));
        });
    </script>

</body>
</html>