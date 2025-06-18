@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-emerald-700 mb-6">Kelola Testimoni User</h2>

    {{-- alert --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($testimonis->isEmpty())
        <p class="text-gray-600">Belum ada testimoni dari user.</p>
    @else
        {{-- ⬇️ Toolbar aksi --}}
        <div class="flex items-center mb-4 space-x-3">
            <input id="selectAll" type="checkbox" class="w-4 h-4 border-gray-300 rounded">
            <label for="selectAll" class="text-sm text-gray-700">Pilih semua</label>

            {{-- hapus terpilih --}}
            <button form="bulkDeleteForm"
                    onclick="return confirm('Hapus testimoni terpilih?')"
                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                Hapus pilihan
            </button>

            {{-- hapus semua --}}
            <form action="{{ route('admin.testimoniUser.deleteAll') }}"
                method="POST"
                onsubmit="return confirm('Hapus semua testimoni?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-700 hover:bg-red-800 text-white text-sm px-3 py-1 rounded">
                    Hapus semua
                </button>
            </form>
        </div>

        {{-- ⬇️ bungkus grid dengan satu form --}}
        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.testimoniUser.bulkDelete') }}">
            @csrf
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonis as $testimoni)
                    <div class="relative bg-white shadow rounded-lg p-4">
                        {{-- checkbox --}}
                        <input type="checkbox"
                            name="ids[]"
                            value="{{ $testimoni->id }}"
                            class="check-testimoni absolute top-2 left-2 w-4 h-4 text-emerald-600 border-gray-300 rounded">

                        <div class="flex items-center space-x-4 ml-6">
                            @if($testimoni->foto_user)
                                <img src="{{ asset('storage/' . $testimoni->foto_user) }}"
                                    class="w-12 h-12 rounded-full object-cover" alt="">
                            @else
                                <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($testimoni->nama_user, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-semibold">{{ $testimoni->nama_user }}</h4>
                                <p class="text-sm text-gray-500">{{ $testimoni->status }}</p>
                            </div>
                        </div>

                        <p class="text-sm text-gray-700 mt-4">{{ $testimoni->isi_testimoni }}</p>

                        {{-- tombol approve / reject --}}
                        @if($testimoni->status === 'pending')
                            <div class="flex space-x-2 mt-4">
                                <form method="POST" action="{{ route('admin.testimoniUser.approve', $testimoni->id) }}">
                                    @csrf
                                    <button class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Yes</button>
                                </form>
                                <form method="POST" action="{{ route('admin.testimoniUser.reject', $testimoni->id) }}">
                                    @csrf
                                    <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">No</button>
                                </form>
                            </div>
                        @else
                            <p class="text-sm text-gray-500 mt-3">
                                Status: <span class="font-semibold">{{ ucfirst($testimoni->status) }}</span>
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </form>
    @endif
</div>

{{-- JS: centang semua --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkAll = document.getElementById('selectAll');
    if (!checkAll) return;

    checkAll.addEventListener('change', (e) => {
        document.querySelectorAll('.check-testimoni').forEach(cb => {
            cb.checked = e.target.checked;
        });
    });
});
</script>
@endsection
