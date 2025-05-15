@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-semibold">Dashboard Admin</h1>
        <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->username }}! Anda login sebagai <strong>Admin</strong>.</p>
    </div>
      <!-- Tombol Logout -->
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Logout
        </button>
    </form>
@endsection

