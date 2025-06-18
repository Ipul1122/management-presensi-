@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-emerald-700 mb-6">Kelola Testimoni User</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($testimonis->isEmpty())
        <p class="text-gray-600">Belum ada testimoni dari user.</p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonis as $testimoni)
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex items-center space-x-4">
                        @if($testimoni->foto_user)
                            <img src="{{ asset('storage/' . $testimoni->foto_user) }}" class="w-12 h-12 rounded-full object-cover" alt="">
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
                        <p class="text-sm text-gray-500 mt-3">Status: <span class="font-semibold">{{ ucfirst($testimoni->status) }}</span></p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
