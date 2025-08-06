<!DOCTYPE html>
<html>
<head>
    <title>Data Murid</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Murid TPA</h2>

    <table>
        <thead>
            <tr>
                <th>ID Pendaftaran</th>
                <th>Nama Anak</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Kelas</th>
                <th>Al-Kitab</th>
                <th>No. Telepon</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($murid as $m)
            <tr>
                <td>{{ $m->id_pendaftaran }}</td>
                <td>{{ $m->nama_anak }}</td>
                <td>{{ $m->jenis_kelamin }}</td>
                <td>{{ $m->alamat }}</td>
                <td>{{ $m->kelas }}</td>
                <td>{{ $m->jenis_alkitab }}</td>
                <td>{{ $m->nomor_telepon }}</td>
                <td>{{ $m->ayah }}</td>
                <td>{{ $m->ibu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
