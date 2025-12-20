@extends('components.user.navbar')

@section('navbar-user')
    
<!-- Hero Section dengan Visi & Misi -->
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
@endsection