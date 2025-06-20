{{-- resources/views/pengajar/login.blade.php --}}
@extends('components.layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Login Pengajar</h2>
        @if ($errors->has('login'))
            <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first('login') }}</span>
            </div>
        @endif
        <form action="{{ route('pengajar.login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
@endsection
