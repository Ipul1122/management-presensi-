@extends('components.layouts.admin.sidebar-and-navbar')
@extends('components.layouts.admin.navbar')

@section('content')
<div class="min-h-screen bg-slate-50 p-4 md:p-8 font-sans">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6 animate-fade-in-down">
        <div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-500 tracking-tight">
                Data Murid
            </h1>
            <p class="text-slate-500 mt-2 text-lg font-medium">Manajemen data siswa TPA Masjid Nurul Haq</p>
        </div>

        <div class="relative group cursor-default">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative flex items-center gap-4 bg-white px-6 py-4 rounded-xl shadow-xl shadow-slate-200/50 ring-1 ring-slate-100">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Murid</p>
                    <p class="text-2xl font-black text-slate-800">{{ $murids->total() }} <span class="text-sm font-medium text-slate-400">Anak</span></p>
                </div>
                <div class="w-px h-10 bg-slate-100 mx-2"></div>
                <a href="{{ route('admin.murid.pdf') }}" target="_blank" class="flex flex-col items-center justify-center text-red-500 hover:text-red-600 transition-colors group/pdf">
                    <svg class="w-6 h-6 mb-1 group-hover/pdf:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <span class="text-[10px] font-bold uppercase">Export</span>
                </a>
            </div>
        </div>
    </div>

    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md pointer-events-none space-y-2">
        @if(session('success'))
            <div id="alert-success" class="pointer-events-auto flex items-center p-4 rounded-2xl bg-emerald-500 text-white shadow-2xl animate-bounce-in">
                <svg class="w-6 h-6 mr-3 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div id="alert-error" class="pointer-events-auto flex items-center p-4 rounded-2xl bg-rose-500 text-white shadow-2xl animate-bounce-in">
                <svg class="w-6 h-6 mr-3 text-rose-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <div class="sticky top-0 z-30 mb-6 bg-slate-50/80 backdrop-blur-md py-4 rounded-xl">
        <div class="flex flex-col xl:flex-row justify-between gap-4">
            
            <div class="flex items-center gap-3 w-full xl:w-auto overflow-x-auto pb-2 xl:pb-0 no-scrollbar">
                <a href="{{ route('admin.dashboard') }}" class="flex-shrink-0 px-5 py-3 bg-white hover:bg-slate-50 text-slate-600 font-bold rounded-xl shadow-sm hover:shadow-md border border-slate-200 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.murid.create') }}" class="flex-shrink-0 px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all flex items-center gap-2 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Murid
                </a>
                
                {{-- FIX: Removed 'flex' class here, it will be added by JS when needed --}}
                <button type="button" id="bulkDeleteBtn" class="hidden flex-shrink-0 px-5 py-3 bg-rose-50 text-rose-600 hover:bg-rose-100 font-bold rounded-xl border border-rose-100 transition-all items-center gap-2 animate-pulse-subtle">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus (<span id="selectedCountText">0</span>)
                </button>
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full xl:w-auto">
                <div class="relative w-full md:w-64 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="searchInput" value="{{ request('search') }}" placeholder="Cari siapa?" 
                        class="w-full pl-10 pr-4 py-3 bg-white border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 rounded-xl text-slate-700 placeholder-slate-400 shadow-sm transition-all">
                </div>

                <select id="genderFilter" class="w-full md:w-auto px-4 py-3 bg-white border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-pink-400 rounded-xl text-slate-600 font-medium shadow-sm cursor-pointer hover:bg-slate-50 transition-colors">
                    <option value="">👫 Semua Gender</option>
                    <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>👦 Laki-laki</option>
                    <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>👧 Perempuan</option>
                </select>

                <select id="kitabFilter" class="w-full md:w-auto px-4 py-3 bg-white border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-amber-400 rounded-xl text-slate-600 font-medium shadow-sm cursor-pointer hover:bg-slate-50 transition-colors">
                    <option value="">📖 Semua Kitab</option>
                    <option value="iqro" {{ request('kitab') == 'iqro' ? 'selected' : '' }}>📘 Iqro</option>
                    <option value="Al-Quran" {{ request('kitab') == 'Al-Quran' ? 'selected' : '' }}>📗 Al-Quran</option>
                </select>

                <select id="kelasFilter" class="w-full md:w-auto px-4 py-3 bg-white border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-emerald-400 rounded-xl text-slate-600 font-medium shadow-sm cursor-pointer hover:bg-slate-50 transition-colors">
                    <option value="">🎓 Kelas</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ request('kelas') == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
                    @endfor
                </select>
                
                <button onclick="window.location.href='{{ route('admin.murid.index') }}'" class="px-3 py-3 text-slate-400 hover:text-indigo-500 hover:bg-indigo-50 rounded-xl transition-colors" title="Reset Filter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <div class="relative min-h-[400px]">
        
        <div id="loadingOverlay" class="absolute inset-0 z-20 hidden items-start justify-center pt-20 bg-slate-50/50 backdrop-blur-sm transition-opacity">
            <div class="bg-white p-4 rounded-full shadow-2xl flex items-center gap-3 animate-bounce">
                <div class="w-3 h-3 bg-indigo-500 rounded-full animate-ping"></div>
                <span class="text-indigo-600 font-bold">Mencari data...</span>
            </div>
        </div>

        <form id="muridListForm" action="{{ route('admin.murid.bulkDelete') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                <div class="col-span-1 flex items-center">
                    <input type="checkbox" id="selectAll" class="w-4 h-4 text-indigo-600 bg-white border-slate-300 rounded focus:ring-indigo-500 focus:ring-offset-0 cursor-pointer">
                </div>
                <div class="col-span-4">Murid</div>
                <div class="col-span-2">Kontak</div>
                <div class="col-span-1 text-center">Kelas</div>
                <div class="col-span-1 text-center">Kitab</div>
                <div class="col-span-2">Orang Tua</div>
                <div class="col-span-1 text-right">Aksi</div>
            </div>

            <div id="muridTableBody" class="space-y-3">
                @forelse($murids as $murid)
                <div class="group relative bg-white rounded-2xl p-4 md:px-6 md:py-4 shadow-sm hover:shadow-lg hover:shadow-indigo-100 border border-slate-100 hover:border-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        
                        <div class="col-span-1 flex items-center">
                            <input type="checkbox" name="ids[]" value="{{ $murid->id_pendaftaran }}" class="murid-checkbox w-5 h-5 text-indigo-600 bg-slate-50 border-slate-300 rounded-lg focus:ring-indigo-500 cursor-pointer transition-transform hover:scale-110">
                        </div>

                        <div class="col-span-11 md:col-span-4 flex items-center gap-4">
                            <div class="relative flex-shrink-0">
                                @if ($murid->foto_anak)
                                    <img class="w-14 h-14 rounded-2xl object-cover shadow-sm ring-2 ring-white group-hover:ring-indigo-100 transition-all" src="{{ asset('storage/' . $murid->foto_anak) }}" alt="{{ $murid->nama_anak }}">
                                @else
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $murid->jenis_kelamin == 'Laki-laki' ? 'from-blue-400 to-indigo-500' : 'from-pink-400 to-rose-500' }} flex items-center justify-center text-white text-xl font-bold shadow-sm ring-2 ring-white">
                                        {{ strtoupper(substr($murid->nama_anak, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-2 border-white bg-white flex items-center justify-center shadow-sm">
                                    <span class="text-base" title="{{ $murid->jenis_kelamin }}">{{ $murid->jenis_kelamin == 'Laki-laki' ? '👦' : '👧' }}</span>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-base leading-tight group-hover:text-indigo-600 transition-colors">{{ $murid->nama_anak }}</h3>
                                <div class="flex items-center gap-1 mt-1 text-xs text-slate-500 font-medium">
                                    <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-mono">{{ $murid->id_pendaftaran }}</span>
                                    <span class="truncate max-w-[120px]" title="{{ $murid->alamat }}">• {{ Str::limit($murid->alamat, 20) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:hidden h-px bg-slate-50 my-1"></div>

                        <div class="col-span-6 md:col-span-2">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1 md:hidden">Kontak</p>
                            <div class="flex items-center gap-2 text-slate-600">
                                <span class="p-1.5 bg-green-50 text-green-600 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </span>
                                <span class="text-sm font-semibold font-mono">{{ $murid->nomor_telepon }}</span>
                            </div>
                        </div>

                        <div class="col-span-3 md:col-span-1 text-left md:text-center">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1 md:hidden">Kelas</p>
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                {{ $murid->kelas }}
                            </span>
                        </div>

                        <div class="col-span-3 md:col-span-1 text-left md:text-center">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1 md:hidden">Kitab</p>
                            @php $isIqro = strtolower($murid->jenis_alkitab) === 'iqro'; @endphp
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold {{ $isIqro ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-100' }}">
                                {{ $murid->jenis_alkitab }}
                            </span>
                        </div>

                        <div class="col-span-6 md:col-span-2">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1 md:hidden">Orang Tua</p>
                            <div class="flex flex-col text-xs">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                    <span class="text-slate-600 font-medium truncate max-w-[100px]">{{ $murid->ayah }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-400"></span>
                                    <span class="text-slate-600 font-medium truncate max-w-[100px]">{{ $murid->ibu }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 md:col-span-1 flex justify-end items-center gap-2">
                            <button type="button" class="view-btn w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-200" 
                                data-id="{{ $murid->id_pendaftaran }}" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <a href="{{ route('admin.murid.edit', $murid->id_pendaftaran) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-amber-500 hover:shadow-lg hover:shadow-amber-200 transition-all duration-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" class="delete-btn w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-rose-500 hover:shadow-lg hover:shadow-rose-200 transition-all duration-200" 
                                data-id="{{ $murid->id_pendaftaran }}" data-name="{{ $murid->nama_anak }}" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Tidak ada murid ditemukan</h3>
                    <p class="text-slate-500 mt-2 mb-6">Coba ubah kata kunci atau filter pencarian Anda.</p>
                    <a href="{{ route('admin.murid.index') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all">
                        Reset Filter
                    </a>
                </div>
                @endforelse
            </div>
        </form>
    </div>

    <div id="paginationContainer" class="mt-8 flex justify-center">
        {{ $murids->appends(request()->query())->links('pagination::simple-tailwind') }}
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-50 items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="deleteBackdrop"></div>
    
    <div class="relative bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="deletePanel">
        <div class="w-20 h-20 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-5 text-rose-500 ring-8 ring-rose-50/50">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <h3 class="text-2xl font-black text-center text-slate-800 mb-2">Hapus Data?</h3>
        <p class="text-center text-slate-500 mb-8 leading-relaxed">Anda yakin ingin menghapus data <span id="deleteModalName" class="font-bold text-slate-800"></span>? Data yang dihapus tidak dapat dikembalikan.</p>
        
        <div class="flex gap-3">
            <button id="cancelDelete" class="flex-1 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</button>
            <form id="deleteSingleItemForm" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-3 px-4 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl shadow-lg shadow-rose-200 transition-colors">Hapus</button>
            </form>
        </div>
    </div>
</div>

<div id="bulkDeleteModal" class="fixed inset-0 z-50 items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="bulkBackdrop"></div>
    <div class="relative bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="bulkPanel">
        <div class="w-20 h-20 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-5 text-rose-500 ring-8 ring-rose-50/50">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <h3 class="text-2xl font-black text-center text-slate-800 mb-2">Hapus <span id="bulkDeleteCount">0</span> Item?</h3>
        <p class="text-center text-slate-500 mb-8">Data yang dipilih akan dihapus secara permanen.</p>
        <div class="flex gap-3">
            <button id="cancelBulkDelete" class="flex-1 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</button>
            <button id="confirmBulkDelete" class="flex-1 py-3 px-4 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl shadow-lg shadow-rose-200 transition-colors">Hapus Semua</button>
        </div>
    </div>
</div>

<div id="viewModal" class="fixed inset-0 z-50 items-center justify-center hidden px-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity opacity-0" id="viewBackdrop"></div>
    <div class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="viewPanel">
        
        <div class="h-32 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 relative">
            <button id="closeViewModal" class="absolute top-4 right-4 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="px-8 pb-8 -mt-16 relative" id="viewModalContent">
            <div class="flex flex-col items-center justify-center pt-20 pb-10">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // === Logic Variables ===
    const searchInput = document.getElementById('searchInput');
    const genderFilter = document.getElementById('genderFilter');
    const kitabFilter = document.getElementById('kitabFilter');
    const kelasFilter = document.getElementById('kelasFilter');
    const loadingOverlay = document.getElementById('loadingOverlay');
    let debounceTimer;

    // === 1. Live Search Logic ===
    function toggleLoading(show) {
        if (loadingOverlay) {
            loadingOverlay.classList.toggle('hidden', !show);
            loadingOverlay.classList.toggle('flex', show);
        }
    }

    function fetchResults() {
        toggleLoading(true);
        clearTimeout(debounceTimer);
        
        debounceTimer = setTimeout(() => {
            const params = new URLSearchParams({
                search: searchInput.value,
                gender: genderFilter.value,
                kitab: kitabFilter.value,
                kelas: kelasFilter.value
            });

            const url = `{{ route('admin.murid.index') }}?${params.toString()}`;
            window.history.pushState({}, '', url);

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                const newTableBody = doc.querySelector('#muridTableBody');
                const newPagination = doc.querySelector('#paginationContainer');
                
                if (newTableBody) document.querySelector('#muridTableBody').innerHTML = newTableBody.innerHTML;
                if (newPagination) document.querySelector('#paginationContainer').innerHTML = newPagination.innerHTML;
                
                updateSelectedCount(); 
                toggleLoading(false);
            })
            .catch(error => { console.error(error); toggleLoading(false); });
        }, 400);
    }

    if(searchInput) searchInput.addEventListener('input', fetchResults);
    if(genderFilter) genderFilter.addEventListener('change', fetchResults);
    if(kitabFilter) kitabFilter.addEventListener('change', fetchResults);
    if(kelasFilter) kelasFilter.addEventListener('change', fetchResults);

    // === 2. Checkbox & Bulk Logic ===
    const selectAll = document.getElementById("selectAll");
    const bulkDeleteBtn = document.getElementById("bulkDeleteBtn");
    const selectedCountText = document.getElementById("selectedCountText");
    const muridTableBody = document.getElementById("muridTableBody");

    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll(".murid-checkbox:checked");
        const count = checkedBoxes.length;
        if (selectedCountText) selectedCountText.textContent = count;
        
        if (bulkDeleteBtn) {
            if (count > 0) {
                bulkDeleteBtn.classList.remove("hidden");
                bulkDeleteBtn.classList.add("flex"); // FIX: Clean toggle
            } else {
                bulkDeleteBtn.classList.add("hidden");
                bulkDeleteBtn.classList.remove("flex"); // FIX: Clean toggle
            }
        }
        
        const allCheckboxes = document.querySelectorAll(".murid-checkbox");
        if(selectAll && allCheckboxes.length > 0) {
            selectAll.checked = checkedBoxes.length === allCheckboxes.length;
        }
    }

    if(muridTableBody) {
        muridTableBody.addEventListener('change', (e) => {
            if (e.target.classList.contains('murid-checkbox')) updateSelectedCount();
        });
    }

    if(selectAll) {
        selectAll.addEventListener("change", function () {
            const checkboxes = document.querySelectorAll(".murid-checkbox");
            checkboxes.forEach((checkbox) => checkbox.checked = this.checked);
            updateSelectedCount();
        });
    }

    // === 3. Animated Modal Logic (FIX: Explicit Flex Toggle) ===
    const animateModal = (modalId, show) => {
        const modal = document.getElementById(modalId);
        if(!modal) return;
        const backdrop = modal.querySelector('div[id$="Backdrop"]');
        const panel = modal.querySelector('div[id$="Panel"]');

        if(show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Add flex only when showing
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            backdrop.classList.add('opacity-0');
            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex'); // Remove flex when hiding
            }, 300);
        }
    };

    // Event Delegation for Actions
    document.addEventListener('click', function(e) {
        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) {
            const id = deleteBtn.getAttribute("data-id");
            const name = deleteBtn.getAttribute("data-name");
            document.getElementById("deleteModalName").textContent = name;
            document.getElementById("deleteSingleItemForm").action = `/admin/murid/${id}`;
            animateModal('deleteModal', true);
        }

        const viewBtn = e.target.closest('.view-btn');
        if (viewBtn) {
            const id = viewBtn.getAttribute("data-id");
            animateModal('viewModal', true);
            loadViewContent(id, viewBtn);
        }
        
        // Delete inside View Modal
        const modalDeleteBtn = e.target.closest('.delete-btn-modal');
        if (modalDeleteBtn) {
            const id = modalDeleteBtn.getAttribute("data-id");
            const name = modalDeleteBtn.getAttribute("data-name");
            animateModal('viewModal', false);
            setTimeout(() => {
                document.getElementById("deleteModalName").textContent = name;
                document.getElementById("deleteSingleItemForm").action = `/admin/murid/${id}`;
                animateModal('deleteModal', true);
            }, 300);
        }
    });

    // Close Modals
    document.getElementById("cancelDelete")?.addEventListener("click", () => animateModal('deleteModal', false));
    document.getElementById("deleteBackdrop")?.addEventListener("click", () => animateModal('deleteModal', false));
    
    document.getElementById("cancelBulkDelete")?.addEventListener("click", () => animateModal('bulkDeleteModal', false));
    document.getElementById("bulkBackdrop")?.addEventListener("click", () => animateModal('bulkDeleteModal', false));
    
    document.getElementById("closeViewModal")?.addEventListener("click", () => animateModal('viewModal', false));
    document.getElementById("viewBackdrop")?.addEventListener("click", () => animateModal('viewModal', false));

    // Bulk Delete
    bulkDeleteBtn?.addEventListener("click", () => {
        const count = document.querySelectorAll(".murid-checkbox:checked").length;
        document.getElementById("bulkDeleteCount").textContent = count;
        animateModal('bulkDeleteModal', true);
    });

    document.getElementById("confirmBulkDelete")?.addEventListener("click", () => {
        document.getElementById("muridListForm").submit();
    });

    // === 4. View Modal Content Builder ===
    function loadViewContent(id, trigger) {
        const container = document.getElementById("viewModalContent");
        container.innerHTML = `<div class="flex flex-col items-center justify-center pt-20 pb-10"><div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div></div>`;
        
        setTimeout(() => {
            const row = trigger.closest(".group");
            const getVal = (sel) => row.querySelector(sel)?.textContent.trim() || '-';
            const imgEl = row.querySelector("img");
            
            const data = {
                name: getVal("h3"),
                id: getVal(".font-mono"),
                address: row.querySelector(".truncate")?.getAttribute('title') || '-',
                phone: row.querySelector(".font-mono")?.textContent.trim() || '-',
                class: row.querySelector(".inline-flex.bg-indigo-50")?.textContent.trim() || '-',
                kitab: row.querySelector(".inline-flex.bg-amber-50, .inline-flex.bg-emerald-50")?.textContent.trim() || '-',
                ayah: getVal(".bg-blue-400 + span"),
                ibu: getVal(".bg-pink-400 + span"),
                foto: imgEl ? imgEl.src : null,
                initial: data => data.name.charAt(0).toUpperCase()
            };

            const profileHtml = data.foto 
                ? `<img src="${data.foto}" class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-xl mx-auto bg-white">`
                : `<div class="w-32 h-32 rounded-3xl bg-white border-4 border-white shadow-xl mx-auto flex items-center justify-center text-5xl font-bold text-indigo-500">${data.initial(data)}</div>`;

            container.innerHTML = `
                <div class="text-center">
                    ${profileHtml}
                    <h2 class="text-3xl font-black text-slate-800 mt-4">${data.name}</h2>
                    <div class="flex justify-center gap-2 mt-2">
                        <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 font-bold text-sm border border-indigo-100">Kelas ${data.class}</span>
                        <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 font-bold text-sm border border-emerald-100">${data.kitab}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">ID Pendaftaran</p>
                        <p class="font-mono font-bold text-slate-700 text-lg">${data.id}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Telepon</p>
                        <p class="font-bold text-slate-700 text-lg">${data.phone}</p>
                    </div>
                    <div class="col-span-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat</p>
                        <p class="font-medium text-slate-700">${data.address}</p>
                    </div>
                    <div class="bg-blue-50/50 p-4 rounded-2xl border border-blue-50">
                        <p class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-1">Nama Ayah</p>
                        <p class="font-bold text-slate-700 text-lg">${data.ayah}</p>
                    </div>
                    <div class="bg-pink-50/50 p-4 rounded-2xl border border-pink-50">
                        <p class="text-xs font-bold text-pink-400 uppercase tracking-wider mb-1">Nama Ibu</p>
                        <p class="font-bold text-slate-700 text-lg">${data.ibu}</p>
                    </div>
                </div>

                <div class="flex gap-3 mt-8 pt-6 border-t border-slate-100">
                    <a href="/admin/murid/${id}/edit" class="flex-1 py-3 bg-amber-400 hover:bg-amber-500 text-white font-bold rounded-xl text-center shadow-lg shadow-amber-200 transition-colors">
                        Edit Profil
                    </a>
                    <button class="delete-btn-modal flex-1 py-3 bg-white border-2 border-rose-100 text-rose-500 hover:bg-rose-50 font-bold rounded-xl transition-colors" data-id="${id}" data-name="${data.name}">
                        Hapus Data
                    </button>
                </div>
            `;
        }, 300);
    }
    
    // Auto hide alerts
    setTimeout(() => {
        document.querySelectorAll("#alert-success, #alert-error").forEach(el => el.classList.add('opacity-0', 'translate-y-[-20px]'));
        setTimeout(() => document.querySelectorAll("#alert-success, #alert-error").forEach(el => el.remove()), 500);
    }, 4000);
});
</script>
@endsection