@extends('components.layouts.admin')

@section('content')
<h1>Daftar Jadwal</h1>
<a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nama Jadwal</th>
            <th>Tanggal</th>
            <th>Pukul</th>
            <th>Pengajar</th>
            <th>Kegiatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jadwals as $jadwal)
        <tr>
            <td>{{ $jadwal->nama_jadwal }}</td>
            <td>{{ $jadwal->tanggal_jadwal }}</td>
            <td>{{ $jadwal->pukul_jadwal }}</td>
            <td>{{ $jadwal->nama_pengajar_jadwal }}</td>
            <td>{{ $jadwal->kegiatan_jadwal }}</td>
            <td>
                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}">Edit</a>
                <form method="POST" action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
