@extends('components.user.navbar')

@section('navbar-user')

    {{-- Import Font Quicksand & FontAwesome --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8fafc;
        }
    </style>

    {{-- 1. HERO SECTION --}}
    <div class="relative bg-emerald-600 pt-28 pb-40 rounded-b-[3rem] shadow-xl overflow-hidden">
        {{-- Decorations --}}
        <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s"></div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Penerimaan Santri Baru</h1>
            <p class="text-emerald-100 text-lg md:text-xl max-w-2xl mx-auto font-medium leading-relaxed">
                "Barangsiapa yang menempuh jalan untuk mencari ilmu, maka Allah akan mudahkan baginya jalan menuju surga."
            </p>
        </div>
    </div>

    {{-- 2. STATISTIK (Floating Cards) --}}
    <div class="max-w-5xl mx-auto px-6 -mt-24 relative z-20 mb-16">
        <div class="grid md:grid-cols-2 gap-6">
            
            {{-- Card 1: Murid --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-emerald-50 flex items-center gap-6 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-20 h-20 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-3xl shadow-sm">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h3 class="text-gray-500 font-bold uppercase text-sm tracking-wider mb-1">Total Santri</h3>
                    <div class="text-4xl font-extrabold text-gray-800 flex items-baseline">
                        <span id="murid-count">0</span>
                        <span class="text-emerald-500 text-2xl ml-1">+</span>
                    </div>
                    <p class="text-gray-400 text-sm mt-1">Santri aktif belajar</p>
                </div>
            </div>

            {{-- Card 2: Pengajar --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-emerald-50 flex items-center gap-6 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-20 h-20 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600 text-3xl shadow-sm">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div>
                    <h3 class="text-gray-500 font-bold uppercase text-sm tracking-wider mb-1">Total Pengajar</h3>
                    <div class="text-4xl font-extrabold text-gray-800 flex items-baseline">
                        <span id="pengajar-count">0</span>
                        <span class="text-emerald-500 text-2xl ml-1">+</span>
                    </div>
                    <p class="text-gray-400 text-sm mt-1">Guru berpengalaman</p>
                </div>
            </div>

        </div>
    </div>

    {{-- 3. PILIHAN PENDAFTARAN --}}
    <section id="pendaftaran" class="py-10 pb-24">
        <div class="max-w-4xl mx-auto px-6 text-center">
            
            <div class="mb-12">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm">Gabung Sekarang</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Tertarik Bergabung di TPA Nurul Haq?</h2>
                <p class="text-gray-600 mt-4 text-lg">Silakan pilih metode pendaftaran yang paling mudah bagi Anda.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                
                {{-- Option 1: Google Form --}}
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl hover:border-blue-200 transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                    
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-6 mx-auto relative z-10">
                        <i class="fab fa-google"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Via Google Form</h3>
                    <p class="text-gray-500 mb-8 text-sm leading-relaxed">
                        Isi formulir pendaftaran melalui layanan Google Form. Cocok jika Anda memiliki akun Google.
                    </p>
                    
                    <a href="https://forms.gle/xwMYkaf2YXzuKiE99" target="_blank" 
                       class="inline-flex items-center justify-center w-full px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                        <i class="fas fa-external-link-alt mr-2"></i> Buka G-Form
                    </a>
                </div>

                {{-- Option 2: Website --}}
                <div class="bg-white rounded-3xl p-8 shadow-lg border-2 border-emerald-100 hover:shadow-2xl hover:border-emerald-300 transition-all duration-300 group relative overflow-hidden ring-4 ring-emerald-50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-100 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                    
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl mb-6 mx-auto relative z-10">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Via Website</h3>
                    <p class="text-gray-500 mb-8 text-sm leading-relaxed">
                        Daftar langsung melalui sistem website TPA. Lebih cepat, terintegrasi, dan data langsung tersimpan.
                    </p>
                    
                    <a href="{{ route('user.daftar.index') }}" 
                       class="inline-flex items-center justify-center w-full px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 hover:-translate-y-1 transition-all duration-200">
                        <i class="fas fa-pen-nib mr-2"></i> Daftar Sekarang
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- SCRIPT COUNTER (Original Logic) --}}
    <script>
        function countUp(id, target) {
            let el = document.getElementById(id);
            if (!el) return; // Safety check
            
            let count = 0;
            // Adjust speed: semakin besar pembagi, semakin kecil increment, semakin lambat
            let increment = target > 0 ? Math.ceil(target / 100) : 0; 
            
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
                el.textContent = count;
            }, 20); // Speed in ms
        }

        // Panggil saat DOM ready
        document.addEventListener("DOMContentLoaded", () => {
            // Mengambil data dari controller blade variable
            countUp('murid-count', {{ $murids ?? 0 }});
            countUp('pengajar-count', {{ $pengajars ?? 0 }});
        });
    </script>

@endsection