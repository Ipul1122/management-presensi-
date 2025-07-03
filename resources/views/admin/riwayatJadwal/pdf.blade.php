<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title class="text-blue-600">{{ $judul }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .item {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h1 class="text-blue-600">{{ $judul }}</h1>

    @php
        $totalGaji = 0;
    @endphp

    @foreach ($jadwals as $jadwal)
        <div class="item">
            <strong>Nama:</strong> {{ $jadwal->nama_pengajar_jadwal }}<br>
            <strong>Tanggal Mengajar:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->translatedFormat('d F Y') }}<br>
            <strong>Kegiatan:</strong> {{ $jadwal->kegiatan_jadwal }}<br>
            <strong>Gaji:</strong> Rp {{ number_format($jadwal->gaji, 0, ',', '.') }}
        </div>
        @php
            $totalGaji += $jadwal->gaji;
        @endphp
    @endforeach

    <div class="total">
        Total Gaji: Rp {{ number_format($totalGaji, 0, ',', '.') }}
    </div>
</body>
</html>
