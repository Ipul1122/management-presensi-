@extends('layouts.app')

@section('content')

<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center max-w-md">
        <h1 class="text-2xl font-bold text-red-600 mb-4">Ups!</h1>
        <p class="text-gray-700 mb-6">Kamu harusnya login dulu dong untuk mengakses halaman ini.</p>
        <a href="{{ url('/admin/login') }}" class="text-blue-500 hover:underline">Login Admin</a> |
        <a href="{{ url('/pengajar/login') }}" class="text-blue-500 hover:underline">Login Pengajar</a>
    </div>
</div>

@endsection