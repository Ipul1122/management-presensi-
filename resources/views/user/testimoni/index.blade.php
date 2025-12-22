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
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Bagikan Cerita Anda</h1>
            <p class="text-emerald-100 text-lg md:text-xl max-w-2xl mx-auto font-medium">
                Pengalaman Anda sangat berarti bagi kami. <br>
                Mari berbagi inspirasi untuk orang tua lainnya.
            </p>
        </div>
    </div>

    {{-- 2. FORM SECTION --}}
    <div class="max-w-3xl mx-auto px-4 -mt-20 relative z-20 mb-20">
        
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            
            {{-- Form Header --}}
            <div class="bg-gradient-to-r from-emerald-50 to-white p-8 border-b border-gray-100 text-center">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl border border-emerald-100">
                    <i class="fas fa-comment-medical"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Formulir Testimoni</h2>
                <p class="text-gray-500 text-sm mt-1">Berikan ulasan jujur Anda tentang TPA Nurul Haq.</p>
            </div>

            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="mx-8 mt-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 animate-fade-in-down">
                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <p class="font-bold">Terima Kasih!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- ⚠️ FORM START ⚠️ --}}
            <form action="{{ route('user.testimoni.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                {{-- Input Nama --}}
                <div>
                    <label for="nama_user" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_user" id="nama_user" required placeholder="Masukkan nama Anda"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
                    </div>
                </div>

                {{-- Input Foto --}}
                <div>
                    <label for="foto_user" class="block text-sm font-bold text-gray-700 mb-2">Foto Profil</label>
                    <div class="relative group">
                        <input type="file" name="foto_user" id="foto_user" required accept="image/*"
                            class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-3 file:px-4
                                   file:rounded-xl file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-emerald-50 file:text-emerald-700
                                   hover:file:bg-emerald-100
                                   border border-gray-200 rounded-xl cursor-pointer bg-slate-50">
                        <p class="text-xs text-gray-400 mt-2 ml-1">
                            <i class="fas fa-info-circle mr-1"></i> Format: JPG, PNG, JPEG. Pastikan foto terlihat jelas.
                        </p>
                    </div>
                </div>

                {{-- Input Testimoni --}}
                <div>
                    <label for="isi_testimoni" class="block text-sm font-bold text-gray-700 mb-2">Mengapa memilih TPA ini?</label>
                    <div class="relative">
                        <div class="absolute top-3 left-4 pointer-events-none">
                            <i class="fas fa-quote-left text-gray-300 text-lg"></i>
                        </div>
                        <textarea name="isi_testimoni" id="isi_testimoni" rows="5" required placeholder="Ceritakan pengalaman positif Anda atau perkembangan anak Anda selama belajar di sini..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all resize-none"></textarea>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-emerald-200 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                        <i class="fas fa-paper-plane group-hover:rotate-12 transition-transform"></i>
                        Kirim Testimoni
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-4">
                        Testimoni Anda akan direview oleh admin sebelum ditampilkan.
                    </p>
                </div>

            </form>
            {{-- ⚠️ FORM END ⚠️ --}}

        </div>
    </div>

@endsection