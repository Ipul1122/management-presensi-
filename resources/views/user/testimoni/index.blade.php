@extends('components.user.navbar')

@section('navbar-user')
<div class="max-w-xl mx-auto mt-12 px-4">
    <h2 class="text-2xl font-bold text-center text-emerald-700 mb-6">Berikan Testimoni Kamu</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.testimoni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="nama_user" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama_user" id="nama_user" required class="w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label for="foto_user" class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto_user" id="foto_user" required class="w-full">
        </div>

        <div>
            <label for="isi_testimoni" class="block text-sm font-medium text-gray-700">Mengapa memilih TPA ini?</label>
            <textarea name="isi_testimoni" id="isi_testimoni" rows="4" required class="w-full border border-gray-300 rounded px-4 py-2"></textarea>
        </div>

        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded shadow">
            Kirim Testimoni
        </button>
    </form>
</div>



@endsection