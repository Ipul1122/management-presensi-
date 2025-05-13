@extends('layouts.app')

@section('content')
    <div class="p-6 text-center">
        <h1 class="text-2xl font-bold">Dashboard Pengajar</h1>
        <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->username }}! Anda login sebagai <strong>Pengajar</strong>.</p>
    </div>
@endsection
