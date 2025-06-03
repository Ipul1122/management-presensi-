@extends('components.layouts.admin') {{-- Sesuaikan dengan layout yang kamu gunakan --}}

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Statistik Data Murid</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        {{-- Jenis Kelamin --}}
        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">Jenis Kelamin</h3>
            <p>Laki-laki: <strong>{{ $totalLaki }}</strong></p>
            <p>Perempuan: <strong>{{ $totalPerempuan }}</strong></p>
        </div>

        {{-- Jenis Al-Kitab --}}
        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">Jenis Bacaan</h3>
            <p>Iqro: <strong>{{ $totalIqro }}</strong></p>
            <p>Al-Qur'an: <strong>{{ $totalQuran }}</strong></p>
        </div>

        {{-- Kelas --}}
        <div class="bg-white shadow rounded-lg p-4 col-span-1 md:col-span-2 lg:col-span-3">
            <h3 class="text-lg font-semibold mb-2">Kelas</h3>
            <ul class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2">
                @foreach($kelasCounts as $kelas)
                    <li class="bg-blue-100 text-blue-900 rounded px-3 py-2">
                        Kelas {{ $kelas->kelas }}: <strong>{{ $kelas->total }}</strong>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
