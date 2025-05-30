@extends('components.layouts.admin')

@section('content')
<h1>Edit Jadwal</h1>

<form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="nama_jadwal" value="{{ $jadwal->nama_jadwal }}" required>
    <input type="date" name="tanggal_jadwal" value="{{ $jadwal->tanggal_jadwal }}" required>
    <input type="text" name="pukul_jadwal" value="{{ $jadwal->pukul_jadwal }}" required>
    <input type="text" name="nama_pengajar_jadwal" value="{{ $jadwal->nama_pengajar_jadwal }}" required>
    <textarea name="kegiatan_jadwal" required>{{ $jadwal->kegiatan_jadwal }}</textarea>
    <button type="submit">Update</button>
</form>
@endsection
