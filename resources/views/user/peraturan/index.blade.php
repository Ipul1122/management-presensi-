@extends('components.user.navbar')

@section('navbar-user')
    
<section class="py-20 bg-white" id="peraturan">
        <div class="max-w-6xl mx-auto px-6">
            {{-- Header Section --}}
            <div class="text-center mb-16">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm">Tata Tertib</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Ketentuan & Peraturan TPA Nurul Haq</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Demi terciptanya lingkungan belajar yang kondusif, nyaman, dan berkah bagi seluruh santri.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-10">
                
                {{-- Card 1: Waktu & Kehadiran --}}
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-emerald-200 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-100 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6 text-2xl relative z-10">
                        ⏰
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Waktu & Kehadiran</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Hadir Sebelum ashar dan melaksanakan sholat mendapatkan nilai +.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>izin kepada pengajar jika berhalangan hadir.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Diperbolehkan membawa snack sebelum TPA Mulai.</span>
                        </li>
                    </ul>
                </div>

                {{-- Card 2: Pakaian & Adab --}}
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-amber-200 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6 text-2xl relative z-10">
                        👕
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Pakaian & Adab</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Berpakaian muslim/muslimah yang rapi, bersih, dan menutup aurat.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Menerapkan 5S (Senyum, Salam, Sapa, Sopan, Santun).</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Menghormati pengajar dan menyayangi teman.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Menjaga kebersihan dan kerapian pada Masjid Nurul Haq.</span>
                        </li>
                    </ul>
                </div>

                {{-- Card 3: Perlengkapan Belajar --}}
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-blue-200 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6 text-2xl relative z-10">
                        📚
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Perlengkapan Belajar</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Membawa Al-Qur'an/Iqro dan buku materi TPA sendiri.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Membawa alat tulis lengkap (Buku tulis, pensil, dll).</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Menjaga kebersihan dan kerapian peralatan milik TPA.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Menjaga barang berharga dan jangan sampai tertinggal.</span>
                        </li>
                    </ul>
                </div>

                {{-- Card 4: Larangan --}}
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-rose-200 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-100 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6 text-2xl relative z-10">
                        🚫
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Larangan</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Dilarang membawa mainan, HP, atau barang yang mengganggu.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Dilarang membuat gaduh atau berkelahi di area masjid.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Dilarang mencoret-coret fasilitas TPA/Masjid.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Pengajar tidak bertanggug jawab atas kehilangan barang.</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Pengajar tidak bertanggug jawab atas insiden murid berkelahi.</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
</section>
@endsection