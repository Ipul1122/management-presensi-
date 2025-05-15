@extends('layouts.app')

@section('content')
    <div class="p-6 text-center">
        <h1 class="text-2xl font-bold">Dashboard Pengajar</h1>
        <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->username }}! Anda login sebagai <strong>Pengajar</strong>.</p>
    </div>

      <!-- Tombol Logout -->
    <form method="POST" action="{{ route('pengajar.logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Logout
        </button>
    </form>
@endsection
