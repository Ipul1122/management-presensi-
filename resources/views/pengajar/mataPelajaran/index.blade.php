@extends('components.layouts.pengajar')
@extends('components.layouts.pengajar.navbar')
@extends('components.layouts.pengajar.sidebar')

@section('content')
<div class="p-6 space-y-8">
    
    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl p-6 text-white shadow-lg">
        <h1 class="text-2xl font-bold flex items-center gap-3">
            <i class="fas fa-book-open"></i> Penilaian Mata Pelajaran
        </h1>
        <p class="mt-2 text-blue-100">Input nilai harian atau materi hafalan murid.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('pengajar.mataPelajaran.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6 relative" id="muridSearchContainer">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Murid</label>
                        <input type="hidden" name="nama_murid" id="realNamaMurid" required>
                        
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="searchMurid" placeholder="Ketik nama murid..." 
                                class="w-full pl-10 pr-10 py-3 rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition cursor-pointer"
                                autocomplete="off">
                        </div>

                        <div id="dropdownList" class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-60 overflow-y-auto hidden custom-scrollbar">
                            @foreach($murids as $m)
                                <div class="option-item px-4 py-3 hover:bg-blue-50 cursor-pointer text-gray-700 transition border-b border-gray-50 last:border-0"
                                    onclick="selectMurid('{{ $m->nama_anak }}')">
                                    {{ $m->nama_anak }}
                                </div>
                            @endforeach
                            <div id="noResult" class="px-4 py-3 text-gray-400 hidden">Nama tidak ditemukan</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi / Materi</label>
                        <textarea name="deskripsi" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Contoh: Hafalan Surat Al-Mulk ayat 1-5..."></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Berikan Nilai</label>
                        <input type="hidden" name="nilai" id="inputNilai" required>
                        
                        <div class="grid grid-cols-5 sm:grid-cols-10 gap-2">
                            @for ($i = 1; $i <= 10; $i++)
                                <button type="button" 
                                    class="nilai-btn w-full aspect-square rounded-xl border-2 border-gray-200 text-gray-600 font-bold hover:border-blue-500 hover:text-blue-600 transition-all text-lg"
                                    onclick="pilihNilai(this, {{ $i }})">
                                    {{ $i }}
                                </button>
                            @endfor
                        </div>
                        <p class="text-xs text-red-500 mt-2 hidden" id="errorNilai">Silakan pilih nilai terlebih dahulu.</p>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] transition-all">
                        <i class="fas fa-check-circle mr-2"></i> Konfirmasi Nilai
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-full">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-history text-blue-500"></i> Input Hari Ini
                </h3>
                <div class="space-y-3 overflow-y-auto max-h-[500px] custom-scrollbar pr-2">
                    @forelse($riwayat as $item)
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 group relative hover:bg-red-50/20 transition-colors">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">{{ $item->nama_murid }}</h4>
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $item->deskripsi ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <div class="bg-blue-100 text-blue-700 font-bold px-2 py-1 rounded-lg text-xs">
                                        Nilai: {{ $item->nilai }}
                                    </div>
                                    
                                    <form action="{{ route('pengajar.mataPelajaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus penilaian ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100" title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-4">Belum ada data.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. Script Searchable Dropdown
    const searchInput = document.getElementById('searchMurid');
    const hiddenInput = document.getElementById('realNamaMurid');
    const dropdown = document.getElementById('dropdownList');
    const options = document.querySelectorAll('.option-item');
    const noResult = document.getElementById('noResult');
    const container = document.getElementById('muridSearchContainer');

    searchInput.addEventListener('focus', () => dropdown.classList.remove('hidden'));
    
    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        let hasResult = false;
        hiddenInput.value = ''; // Reset ID jika user ketik ulang
        
        options.forEach(opt => {
            if(opt.innerText.toLowerCase().includes(filter)){
                opt.classList.remove('hidden');
                hasResult = true;
            } else {
                opt.classList.add('hidden');
            }
        });
        
        hasResult ? noResult.classList.add('hidden') : noResult.classList.remove('hidden');
        dropdown.classList.remove('hidden');
    });

    function selectMurid(nama) {
        searchInput.value = nama;
        hiddenInput.value = nama;
        dropdown.classList.add('hidden');
    }

    document.addEventListener('click', (e) => {
        if(!container.contains(e.target)) dropdown.classList.add('hidden');
    });

    // 2. Script Tombol Nilai
    function pilihNilai(btn, nilai) {
        // Reset semua tombol
        document.querySelectorAll('.nilai-btn').forEach(b => {
            b.classList.remove('bg-blue-600', 'text-white', 'border-blue-600', 'shadow-md');
            b.classList.add('border-gray-200', 'text-gray-600');
        });

        // Highlight tombol yang dipilih
        btn.classList.remove('border-gray-200', 'text-gray-600');
        btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600', 'shadow-md');

        // Isi input hidden
        document.getElementById('inputNilai').value = nilai;
    }
</script>
@endsection