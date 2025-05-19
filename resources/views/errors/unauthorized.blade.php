@extends('components.layouts.app') {{-- ganti dengan layout utama kamu --}}

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold text-red-600">Ups!</h1>
    <p class="mt-4 text-lg">Kamu harus login dulu untuk mengakses halaman ini.</p>
    <div class="mt-6 space-x-4">
        <a href="{{ route('admin.login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Login Admin</a>
        <a href="{{ route('pengajar.login') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Login Pengajar</a>
    </div>
</div>
@endsection
