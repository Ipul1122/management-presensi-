@extends('components.user.navbar')

@section('navbar-user')

    {{-- Import Font Quicksand --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8fafc;
        }
    </style>

    {{-- 1. HEADER / HERO SECTION --}}
    <div class="relative bg-emerald-600 pt-24 pb-20 rounded-b-[3rem] shadow-xl overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-amber-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Para Pengajar Kami</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto leading-relaxed">
                "Guru adalah pelita yang menerangi jalan menuju masa depan gemilang." <br>
                Berkenalan dengan tim pengajar TPA Nurul Haq yang berdedikasi.
            </p>
        </div>
    </div>

    {{-- 2. MAIN CONTENT (Grid Layout) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 mb-20 relative z-20">
        
        @if($pengajars->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white rounded-3xl p-8 shadow-lg text-center max-w-lg mx-auto">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                    👨‍🏫
                </div>
                <h3 class="text-lg font-bold text-gray-800">Belum Ada Data Pengajar</h3>
                <p class="text-gray-500 mt-2">Data pengajar akan segera kami perbarui.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($pengajars as $pengajar)
                    <div class="group bg-white rounded-3xl p-6 shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden">
                        
                        {{-- Hiasan Atas --}}
                        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-emerald-50 to-transparent"></div>

                        {{-- Foto Profil --}}
                        <div class="relative mb-4 mt-2">
                            <div class="absolute inset-0 bg-emerald-200 rounded-full blur-lg opacity-50 group-hover:opacity-80 transition-opacity"></div>
                            
                            @if($pengajar->foto_pengajar)
                                <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                    alt="{{ $pengajar->nama_pengajar }}" 
                                    class="relative w-24 h-24 rounded-full object-cover border-4 border-white shadow-md group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="relative w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-3xl border-4 border-white shadow-md group-hover:scale-105 transition-transform duration-300">
                                    {{ strtoupper(substr($pengajar->nama_pengajar, 0, 1)) }}
                                </div>
                            @endif
                            
                            {{-- Badge Icon --}}
                            <div class="absolute bottom-0 right-0 bg-amber-400 text-white rounded-full p-1.5 border-2 border-white shadow-sm" title="Pengajar TPA">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        </div>

                        {{-- Informasi --}}
                        <div class="relative w-full">
                            <h3 class="font-bold text-gray-900 text-xl mb-1 line-clamp-1" title="{{ $pengajar->nama_pengajar }}">
                                {{ $pengajar->nama_pengajar }}
                            </h3>
                            <p class="text-emerald-600 text-sm font-medium mb-4">Pengajar TPA</p>
                            
                            {{-- Deskripsi Box --}}
                            <div class="bg-slate-50 rounded-2xl p-4 w-full min-h-[100px] flex items-center justify-center">
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-4 italic">
                                    "{{ $pengajar->deskripsi ?? 'Berdedikasi untuk mendidik generasi Qur\'ani.' }}"
                                </p>
                            </div>
                        </div>

                        {{-- Hover Effect Line --}}
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </div>
                @endforeach
            </div>
        @endif

    </section>

@endsection