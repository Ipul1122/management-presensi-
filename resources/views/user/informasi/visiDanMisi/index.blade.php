@extends('components.user.navbar')

@section('navbar-user')
    
<!-- Hero Section dengan Visi & Misi -->
<section class="relative py-20 bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 overflow-hidden" id="visi-misi">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 bg-emerald-200 rounded-full"></div>
        <div class="absolute bottom-20 right-20 w-24 h-24 bg-green-200 rounded-full"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-teal-200 rounded-full"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Selamat Datang di 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    TPA Nurul Haq
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tempat terbaik untuk pendidikan dan pembentukan karakter islami anak-anak Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Visi Card -->
            <div x-data="{ open: true }" class="group">
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl overflow-hidden border border-emerald-100 hover:shadow-2xl transition-all duration-300">
                    <button @click="open = !open" 
                            class="w-full px-8 py-6 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold text-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 flex items-center justify-between">
                        <span class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            VISI KAMI
                        </span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="px-8 py-6">
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Menjadikan TPA rumah kedua sebagai pusat pembelajaran yang inspiratif, tempat anak-anak tumbuh cerdas, berakhlak mulia, dan berani berinovasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Misi Card -->
            <div x-data="{ open: true }" class="group">
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl overflow-hidden border border-emerald-100 hover:shadow-2xl transition-all duration-300">
                    <button @click="open = !open" 
                            class="w-full px-8 py-6 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold text-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 flex items-center justify-between">
                        <span class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            MISI KAMI
                        </span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="px-8 py-6">
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Memberikan edukasi ilmu pengetahuan seperti matematika, IPA, IPS dll</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Membangun kreatifitas, berpikir kritis, berlogika</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Mempelajari adab, etika dan moral</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-gray-700">Membaca alkitab iqro atau Al-Qur'an</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection