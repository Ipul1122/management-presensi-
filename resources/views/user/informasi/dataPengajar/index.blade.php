@extends('components.user.navbar')

@section('navbar-user')
    

<!-- Pengajar Section -->
<section id="pengajar" class="py-16 bg-gradient-to-br from-emerald-50 to-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    Para Pengajar Kami
                </span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Bertemu dengan tim pengajar berpengalaman yang mendedikasikan diri untuk pendidikan putra-putri Anda</p>
        </div>

        <div class="relative">
            <div class="overflow-x-auto scrollbar-hide pb-4">
                <div class="flex space-x-6 w-max px-4">
                    @foreach ($pengajars as $pengajar)
                        <div class="min-w-[300px] max-w-[320px] group">
                            <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl p-6 border border-emerald-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                                <!-- Header Card -->
                                <div class="flex items-center space-x-4 mb-6">
                                    @if($pengajar->foto_pengajar)
                                        <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                            alt="foto" class="h-16 w-16 rounded-2xl object-cover border-3 border-emerald-200 shadow-lg group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                                            {{ strtoupper(substr($pengajar->nama_pengajar, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 text-lg mb-1">
                                            {{ $pengajar->nama_pengajar }}
                                        </h3>
                                        <div class="flex items-center text-blue-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            <span class="text-sm font-medium">Pengajar TPA</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Deskripsi -->
                                <div class="bg-gray-50 rounded-2xl p-4">
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $pengajar->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="flex justify-center mt-4 space-x-2">
                <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                <div class="w-8 h-2 bg-emerald-500 rounded-full"></div>
                <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
            </div>
        </div>
    </div>
</section>

<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>


@endsection