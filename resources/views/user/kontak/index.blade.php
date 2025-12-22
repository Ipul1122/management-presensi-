@extends('components.user.navbar')

@section('navbar-user')

    {{-- Import Font Quicksand & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8fafc;
        }
    </style>

    {{-- 1. HERO SECTION --}}
    <div class="relative bg-emerald-600 pt-28 pb-32 rounded-b-[3rem] shadow-xl overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s"></div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Hubungi Kami</h1>
            <p class="text-emerald-100 text-lg md:text-xl max-w-2xl mx-auto font-medium">
                Punya pertanyaan seputar pendaftaran atau kegiatan TPA? <br>
                Kami siap membantu Anda.
            </p>
        </div>
    </div>

    {{-- 2. MAIN CONTENT (Contact & Map) --}}
    <section id="kontak" class="max-w-7xl mx-auto px-6 -mt-20 relative z-20 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- LEFT: Info & Map --}}
            <div class="space-y-8">
                {{-- Contact Info Card --}}
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-lg">
                            <i class="fas fa-map-marked-alt"></i>
                        </span>
                        Lokasi & Kontak
                    </h3>
                    
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-emerald-500 flex-shrink-0 mt-1">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-700">Alamat TPA Nurul Haq</p>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    Jl. Rawa Bahagia I No.8, Grogol, Jakarta Barat 11450
                                </p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-emerald-500 flex-shrink-0 mt-1">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-700">Telepon / WhatsApp</p>
                                <p class="text-gray-500 text-sm">0856-9367-2730 (Admin)</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-emerald-500 flex-shrink-0 mt-1">
                                {{-- <i class="fas fa-envelope"></i> --}}
                            </div>
                            {{-- <div>
                                <p class="font-bold text-gray-700">Email</p>
                                <p class="text-gray-500 text-sm">tpa.nurulhaq@gmail.com</p>
                            </div> --}}
                        </li>
                    </ul>
                </div>

                {{-- Map Container --}}
                <div class="bg-white rounded-3xl p-3 shadow-xl border border-gray-100 overflow-hidden h-80 relative group">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.738454302736!2d106.79538937413047!3d-6.1657695604241525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f642d88d5841%3A0x6c31ab35f182053a!2sMasjid%20Nurul%20Haq!5e0!3m2!1sid!2sid!4v1750152768250!5m2!1sid!2sid" 
                        width="100%" height="100%" style="border:0;" 
                        allowfullscreen="" loading="lazy" 
                        class="rounded-2xl w-full h-full grayscale group-hover:grayscale-0 transition-all duration-500"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur px-4 py-2 rounded-lg shadow-sm text-xs font-bold text-emerald-700 pointer-events-none">
                        <i class="fas fa-map-pin mr-1"></i> Lokasi Kami
                    </div>
                </div>
            </div>

            {{-- RIGHT: Form Kontak --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-emerald-100 overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-emerald-50 to-white p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800">Kirim Pesan</h2>
                    <p class="text-gray-500 text-sm mt-1">Isi formulir di bawah ini, admin akan membalas via WhatsApp.</p>
                </div>

                <form id="kontakForm" class="p-8 space-y-6 flex-grow">
                    
                    {{-- Nama Input --}}
                    <div>
                        <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required 
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    {{-- Telepon Input --}}
                    <div>
                        <label for="telp" class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fab fa-whatsapp text-gray-400"></i>
                            </div>
                            <input type="tel" id="telp" name="telp" placeholder="08xxxxxxxxxx" required 
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    {{-- Pesan Input --}}
                    <div>
                        <label for="pesan" class="block text-sm font-bold text-gray-700 mb-2">Pesan / Pertanyaan</label>
                        <div class="relative">
                            <div class="absolute top-3 left-4 pointer-events-none">
                                <i class="fas fa-comment-dots text-gray-400"></i>
                            </div>
                            <textarea id="pesan" name="pesan" rows="4" placeholder="Tuliskan pesan Anda di sini..." required 
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all resize-none"></textarea>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-emerald-200 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                        <span>Kirim via WhatsApp</span>
                        <i class="fab fa-whatsapp text-xl group-hover:scale-110 transition-transform"></i>
                    </button>

                </form>
            </div>

        </div>
    </section>

    {{-- SCRIPT (Logic Dipertahankan) --}}
    <script>
    document.getElementById('kontakForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const nama = document.getElementById('nama').value;
        const telp = document.getElementById('telp').value;
        const pesan = document.getElementById('pesan').value;

        // Nomor sesuai kode asli user
        const noAdmin = '+6287746391601'; 
        
        const message = `Halo Admin TPA Nurul Haq! %0ASaya ${nama} %0A No. Telp: ${telp}%0A%0A Pesan: %0A${pesan}`;

        const url = `https://wa.me/${noAdmin}?text=${message}`;

        window.open(url, '_blank');
    });
    </script>

@endsection