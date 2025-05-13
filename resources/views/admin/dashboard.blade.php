@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-semibold">Dashboard Admin</h1>
        <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->username }}! Anda login sebagai <strong>Admin</strong>.</p>
    </div>
@endsection
