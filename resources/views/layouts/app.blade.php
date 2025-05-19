<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Presensi TPA') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js') {{-- Pastikan Tailwind terhubung --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col">
        {{-- Konten utama halaman --}}
        <main class="flex-grow container mx-auto px-4 py-8">
            @yield('content')
        </main>

        {{-- Footer opsional --}}
        <footer class="text-center py-4 text-sm text-gray-500">
            &copy; {{ date('Y') }} TPA Masjid Nurul Haq
        </footer>
    </div>

</body>
</html>
