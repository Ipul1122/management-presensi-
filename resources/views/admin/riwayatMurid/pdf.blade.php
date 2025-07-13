<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi Bulan {{ $bulan }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }
        .title {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 30px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #0077e6;
        }
        .no-data {
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>
    <h1 class="title">Rekapitulasi Absensi Murid TPA<br>Bulan {{ $bulan }}</h1>

    @forelse ($groupedAbsensi as $tanggal => $items)
        <h2>{{ $tanggal }}</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Murid</th>
                    <th>Status Kehadiran</th>
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
        <p class="no-data">Tidak ada data absensi untuk bulan ini.</p>
    @endforelse

    <br><br>
    <div style="text-align: right; font-size: 12px;">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </div>
</body>
</html>
