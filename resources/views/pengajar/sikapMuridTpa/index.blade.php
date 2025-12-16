@extends('components.layouts.pengajar')
@extends('components.layouts.pengajar.navbar')
@extends('components.layouts.pengajar.sidebar')


@section('content')
<div class="p-6 space-y-8">
    
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
        <h1 class="text-2xl font-bold flex items-center gap-3">
            <i class="fas fa-heart"></i> Input Nilai Sikap
        </h1>
        <p class="mt-2 text-purple-100">Berikan apresiasi kepada murid yang bersikap baik hari ini.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('pengajar.sikapMurid.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Murid</label>
                        <select name="nama_murid" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition" required>
                            <option value="" disabled selected>-- Pilih Nama Murid --</option>
                            @foreach($murids as $m)
                                <option value="{{ $m->nama_anak }}">{{ $m->nama_anak }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Kriteria (Bisa pilih lebih dari satu)</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            @php
                                $kriteria = [
                                    ['icon' => 'fa-hand-holding-heart', 'color' => 'text-pink-500', 'label' => 'Jujur'],
                                    ['icon' => 'fa-hands-helping', 'color' => 'text-blue-500', 'label' => 'Tidak Bercanda/Berantem'],
                                    ['icon' => 'fa-user-clock', 'color' => 'text-green-500', 'label' => 'Disiplin'],
                                    ['icon' => 'fa-users', 'color' => 'text-purple-500', 'label' => 'Tidak mengejek orang tua'],
                                    ['icon' => 'fa-volume-mute', 'color' => 'text-red-500', 'label' => 'Tidak teriak-teriak'],
                                ];
                            @endphp

                            @foreach($kriteria as $k)
                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-purple-50 transition-colors group">
                                <input type="checkbox" name="sikap[]" value="{{ $k['label'] }}" class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500 border-gray-300">
                                <div class="ml-3 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-white transition">
                                        <i class="fas {{ $k['icon'] }} {{ $k['color'] }}"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ $k['label'] }}</span>
                                </div>
                            </label>
                            @endforeach

                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] transition-all">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Nilai Sikap
                    </button>
                </form>
            </div>
        </div>

       <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-full flex flex-col">
                
                <div class="mb-4 border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-history text-purple-500"></i> Riwayat Hari Ini
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">
                        Log aktivitas penilaian sikap hari ini.
                    </p>
                </div>
                
                <div class="space-y-4 flex-1 overflow-y-auto custom-scrollbar pr-2 max-h-[500px]">
                    @forelse($riwayatHariIni as $log)
                    <div class="group bg-gray-50 hover:bg-purple-50 transition-colors rounded-xl p-4 border border-gray-100 relative">
                        
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">{{ $log->nama_murid }}</h4>
                                <div class="flex items-center gap-1 mt-1">
                                    <i class="fas fa-user-tie text-[10px] text-gray-400"></i>
                                    <span class="text-[11px] text-gray-500 font-medium">
                                        Oleh: {{ $log->nama_pengajar }}
                                    </span>
                                </div>
                            </div>
                            
                            <span class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-xs font-bold px-2 py-1 rounded-lg shadow-sm">
                                +{{ $log->jumlah_poin }}
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-1.5 mt-2">
                            @if(is_array($log->detail_sikap))
                                @foreach($log->detail_sikap as $sikap)
                                    <span class="text-[10px] bg-white border border-gray-200 text-gray-500 px-2 py-0.5 rounded shadow-sm">
                                        {{ $sikap }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-[10px] bg-white border border-gray-200 text-gray-500 px-2 py-0.5 rounded shadow-sm">
                                    Data Tersimpan
                                </span>
                            @endif
                        </div>

                       <div class="flex justify-between items-center mt-3 pt-2 border-t border-gray-100/50">
                            <div class="text-[10px] text-gray-400 flex items-center gap-1">
                                <i class="far fa-clock"></i> {{ $log->created_at->format('H:i') }} WIB
                            </div>

                            @php
                                // UPDATE DISINI: Tambahkan pengecekan username
                                $currentUser = auth()->guard('pengajar')->user();
                                $currentName = $currentUser->nama_pengajar ?? $currentUser->nama ?? $currentUser->username ?? 'Pengajar';
                            @endphp

                            @if($log->nama_pengajar == $currentName)
                            <form action="{{ route('pengajar.sikapMurid.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Batalkan penilaian ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="opacity-0 group-hover:opacity-100 transition-opacity text-red-400 hover:text-red-600 p-1" title="Hapus">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                            @endif
                    </div>

                    </div>
                    @empty
                    <div class="flex flex-col items-center justify-center h-40 text-center text-gray-400">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-clipboard-check text-xl text-gray-300"></i>
                        </div>
                        <p class="text-sm">Belum ada penilaian hari ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection