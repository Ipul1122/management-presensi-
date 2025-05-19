@extends('components.layouts.admin')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Data Murid</h2>
    <a href="{{ route('admin.murid.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Murid</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th>ID</th>
                <th>Nama Anak</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($murids as $murid)
            <tr class="border-t">
                <td>{{ $murid->id_pendaftaran }}</td>
                <td>{{ $murid->anak->nama }}</td>
                <td>{{ $murid->jenis_kelamin }}</td>
                <td>{{ $murid->kelas }}</td>
                <td>
                    <a href="{{ route('admin.murid.show', $murid->id_pendaftaran) }}" class="text-blue-500">Lihat</a> |
                    <a href="{{ route('admin.murid.edit', $murid->id_pendaftaran) }}" class="text-yellow-500">Edit</a> |
                    <form action="{{ route('admin.murid.destroy', $murid->id_pendaftaran) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
