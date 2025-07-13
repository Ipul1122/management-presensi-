<!DOCTYPE html>
<html>
<head>
    <title>Rekap Absensi Bulan {{ $bulan }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { margin-top: 30px; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; border: 1px solid #000; font-size: 12px; text-align: left; }
        .title { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <h1 class="title">Rekap Absensi Murid - Bulan {{ $bulan }}</h1>

    @forelse ($groupedAbsensi as $tanggal => $items)
        <h2>{{ $tanggal }}</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Murid</th>
                    <th>Status</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $i => $absen)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $absen->nama_murid }}</td>
                        <td>{{ $absen->jenis_status }}</td>
                        <td>{{ $absen->catatan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <p>Tidak ada data absensi pada bulan ini.</p>
    @endforelse
</body>
</html>
