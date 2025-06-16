@extends('components.layouts.pengajar.sidebar')
@extends('components.layouts.pengajar.navbar')

@section('sidebar-pengajar')
@section('navbar-pengajar')

    <!-- Main Content -->
    <main class="flex-1 overflow-hidden">
        <div class="p-6 space-y-8">
            <!-- Welcome Section -->
            <div class="animate-fade-in">
                <div class="gradient-bg rounded-2xl p-6 text-white">
                    <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
                    <p class="text-white/90">Kelola aktivitas pembelajaran dengan mudah dan efisien</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="animate-fade-in">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clipboard-list text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Absensi Murid</h4>
                                    <p class="text-sm text-gray-600">Kelola kehadiran murid</p>
                                </div>
                            </div>
                            <a href="{{ route('pengajar.muridAbsensi.index') }}" 
                                    class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors font-medium">
                                Lihat
                            </a>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Info Data Murid</h4>
                                    <p class="text-sm text-gray-600">Lihat informasi murid</p>
                                </div>
                            </div>
                            <a href="{{ route('pengajar.infoDataMurid.index') }}" 
                                class="px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors font-medium">
                                Lihat
                            </a>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:col-span-2 xl:col-span-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Jadwal Hari Ini</h4>
                                    <p class="text-sm text-gray-600">Lihat agenda hari ini</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition-colors font-medium">
                                Lihat
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Slider Section -->
            <div class="animate-fade-in">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Pengajar</h3>
                    <div class="flex space-x-2">
                        <button onclick="prevCard()" id="prevBtn" 
                                class="p-2 rounded-lg bg-white shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button onclick="nextCard()" id="nextBtn" 
                                class="p-2 rounded-lg bg-white shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <div class="relative overflow-hidden">
                    <div id="pengajarContainer" class="flex transition-transform duration-500 ease-in-out space-x-4">
                        @forelse ($dataPengajar as $index => $pengajar)
                            <div class="teacher-card w-64 flex-shrink-0 rounded-xl shadow-sm p-6 text-center">
                                <div class="mb-4">
                                    @if($pengajar->foto_pengajar)
                                        <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" 
                                            alt="Foto {{ $pengajar->nama_pengajar }}" 
                                            class="w-16 h-16 mx-auto rounded-full object-cover border-4 border-green-200">
                                    @else
                                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-bold text-xl">
                                            {{ substr($pengajar->nama_pengajar, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-semibold text-gray-800 mb-2">{{ $pengajar->nama_pengajar }}</h4>
                                <p class="text-sm text-gray-600">{{ $pengajar->deskripsi ?? 'Pengajar berpengalaman' }}</p>
                            </div>
                        @empty
                            <div class="teacher-card w-64 flex-shrink-0 rounded-xl shadow-sm p-6 text-center">
                                <div class="mb-4">
                                    <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center text-white font-bold text-xl">
                                        ?
                                    </div>
                                </div>
                                <h4 class="font-semibold text-gray-800 mb-2">Belum Ada Data</h4>
                                <p class="text-sm text-gray-600">Data pengajar belum tersedia</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Indicators -->
                <div class="flex justify-center mt-6 space-x-2" id="indicators">
                    <!-- Dots will be created by JavaScript -->
                </div>
            </div>

            <!-- Monthly Schedule -->
            <div class="animate-fade-in">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                            Kalender Kegiatan - {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        @if($jadwalBulanIni->isEmpty())
                            <div class="p-8 text-center">
                                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-600 mb-2">Tidak Ada Jadwal</h4>
                                <p class="text-gray-500">Belum ada jadwal kegiatan untuk bulan ini</p>
                            </div>
                        @else
                            <table class="table-modern w-full">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Nama Jadwal</th>
                                        <th>Pengajar</th>
                                        <th>Kegiatan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalBulanIni as $jadwal)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d M Y') }}
                                            </td>
                                            <td class="text-gray-700">{{ $jadwal->pukul_jadwal }}</td>
                                            <td class="font-medium text-gray-900">{{ $jadwal->nama_jadwal }}</td>
                                            <td class="text-gray-700">{{ $jadwal->nama_pengajar_jadwal }}</td>
                                            <td class="text-gray-700">{{ $jadwal->kegiatan_jadwal }}</td>
                                            <td>
                                                @if($jadwal->status === 'Hari Ini')
                                                    <span class="status-badge bg-blue-100 text-blue-800">{{ $jadwal->status }}</span>
                                                @elseif($jadwal->status === 'Selesai')
                                                    <span class="status-badge bg-green-100 text-green-800">{{ $jadwal->status }}</span>
                                                @else
                                                    <span class="status-badge bg-yellow-100 text-yellow-800">{{ $jadwal->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


@endsection