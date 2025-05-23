@extends('components.layouts.pengajar')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detail Pengajar</h1>
    <div class="flex items-center space-x-6 mb-4">
        @if($pengajar->foto_pengajar)
            <img src="{{ asset('storage/' . $pengajar->foto_pengajar) }}" alt="Foto Pengajar" class="w-32 h-32 rounded-full object-cover">
        @else
            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">No Image</div>
        @endif
        <div>
            <h2 class="text-xl font-semibold">{{ $pengajar->nama_pengajar }}</h2>
            <p class="text-gray-600">{{ $pengajar->jenis_kelamin }}</p>
            <p class="text-gray-600">{{ $pengajar->alamat }}</p>
        </div>
    </div>
    <h3 class="text-lg font-bold mb-2">Deskripsi</h3>
    <p class="text-gray-700">{{ $pengajar->deskripsi }}</p>
</div>
@endsection
