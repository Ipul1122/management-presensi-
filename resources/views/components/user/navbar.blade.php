<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js') 
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="">

        {{-- Navbar --}}
        {{-- Sticky Navbar --}}
<header class="sticky top-0 z-50 bg-white shadow-sm ">
    <div class="max-w-7xl mx-auto px-auto sm:px-6 lg:px-8 ">
        <div class="flex items-center justify-between h-16">

            {{-- Kiri: Logo atau Nama --}}
            <div class="flex-shrink-0 text-emerald-600 text-2xl font-bold">
                TPA Nurul Haq
            </div>

            {{-- Tengah: Menu Navigasi --}}
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('index') }}" class="text-gray-700 hover:text-emerald-600 transition font-medium">Home</a>
                <a href="{{ route('user.informasi.index') }}" class="text-gray-700 hover:text-emerald-600 transition font-medium">informasi</a>
                <a href="{{ route('user.galeri.index') }}" class="text-gray-700 hover:text-emerald-600 transition font-medium">Galeri</a>
                <a href="#pendaftaran" class="text-gray-700 hover:text-emerald-600 transition font-medium">Pendaftaran</a>
                <a href="#kontak" class="text-gray-700 hover:text-emerald-600 transition font-medium">Kontak</a>
            </nav>

            {{-- Kanan: Tombol Daftar --}}
            <div class="hidden md:block">
                <a href="#pendaftaran" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-emerald-700 transition">
                    Daftar
                </a>
            </div>

            {{-- Mobile Menu Toggle --}}
            <div class="md:hidden">
                <button id="mobile-menu-toggle" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-sm">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('index') }}" class="block text-gray-700 hover:text-emerald-600">Home</a>
            <a href="{{ route('user.informasi.index') }}" class="block text-gray-700 hover:text-emerald-600">informasi</a>
            <a href="{{ route('user.galeri.index') }}" class="block text-gray-700 hover:text-emerald-600">Galeri</a>
            <a href="#pendaftaran" class="block text-gray-700 hover:text-emerald-600">Pendaftaran</a>
            <a href="#kontak" class="block text-gray-700 hover:text-emerald-600">Kontak</a>
            <a href="#pendaftaran" class="block text-white bg-emerald-600 px-3 py-2 rounded-lg text-center font-semibold hover:bg-emerald-700">
                Daftar
            </a>
        </div>
    </div>
</header>
        {{-- End Navbar --}}



        {{-- Konten utama halaman --}}
        <main class="">
            @yield('navbar-user')
        </main>

        {{-- Footer opsional --}}
        <footer class="bg-emerald-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- 1. Logo & Deskripsi -->
        <div>
            <h2 class="text-2xl font-bold mb-2">TPA Nurul Haq</h2>
            <p class="text-sm leading-relaxed">
                Tempat Pendidikan Anak yang membimbing generasi Qur'ani dengan penuh kasih sayang, ilmu, dan akhlak Islami.
            </p>
        </div>

        <!-- 2. Navigasi -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Navigasi</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('index') }}" class="hover:underline">Beranda</a></li>
                <li><a href="{{ route('user.informasi.index') }}" class="hover:underline">informasi</a></li>
                <li><a href="{{ route('user.galeri.index') }}" class="hover:underline">Galeri</a></li>
                <li><a href="#pendaftaran" class="hover:underline">Pendaftaran</a></li>
                <li><a href="#kontak" class="hover:underline">Kontak</a></li>
            </ul>
        </div>

        <!-- 3. Alamat & Google Maps -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Alamat</h3>
            <p class="text-sm mb-2">Jl. Mawar No. 123, Kembangan, Jakarta Barat</p>
            <div class="rounded overflow-hidden shadow border">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d..."
                    width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- 4. Kontak -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Kontak</h3>
            <ul class="text-sm space-y-2">
                <li><i class="fas fa-phone mr-2"></i> 0812-3456-7890</li>
                <li><i class="fas fa-envelope mr-2"></i> tpa.nurulhaq@gmail.com</li>
                <li><i class="fas fa-clock mr-2"></i> Senin - Minggu: 08.00 - 17.00</li>
            </ul>
        </div>

    </div>

    {{-- NOTIFIKASI POPOVER --}}
    <div x-data="visitTimer()" x-init="startTimer()" x-show="showPopover" x-transition
     class="fixed bottom-5 right-5 bg-white border border-gray-300 shadow-xl rounded-lg w-80 p-4 z-50">
    <p class="text-sm text-gray-800 font-medium mb-3">
        Wah kamu sudah mengunjungi web selama <span x-text="elapsedMinutes"></span> menit!
    </p>
    <div class="flex justify-between space-x-2">
        <a href="#daftar" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">Daftar</a>
        <button @click="dismiss()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-1 rounded text-sm">Nanti deh</button>
        <button @click="dismiss()" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Sudah daftar</button>
    </div>
</div>

    <!-- Copyright -->
    <div class="mt-10 border-t border-white/20 pt-4 text-center text-sm text-white/80">
        &copy; 2025 TPA Nurul Haq. All rights reserved.
    </div>
</footer>
    </div>

    @stack('scripts')

    <script>
    document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

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
                }, 60000); // 1 menit
            },
            dismiss() {
                this.showPopover = false;
            }
        }));
    });
</script>

</body>
</html>
