@extends('components.user.navbar')

@section('navbar-user')

    {{-- Menyakinkan orang daftar tpa --}}
    <section id="statistik-tpa" class="bg-white py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Card 1: Murid --}}
            <div class="bg-emerald-100 p-6 rounded-xl shadow text-center">
                <h3 class="text-2xl font-bold text-blue-700 mb-2">
                    Total Murid TPA Kami
                </h3>
                <div class="text-5xl font-extrabold text-blue-800">
                    <span id="murid-count">0</span>+
                </div>
                <p class="mt-2 text-gray-600">Murid yang aktif terdaftar</p>
            </div>

            {{-- Card 2: Pengajar --}}
            <div class="bg-emerald-100 p-6 rounded-xl shadow text-center">
                <h3 class="text-2xl font-bold text-blue-700 mb-2">
                    Total Pengajar kami terdaftar
                </h3>
                <div class="text-5xl font-extrabold text-blue-800">
                    <span id="pengajar-count">0</span>+
                </div>
                <p class="mt-2 text-gray-600">Dibimbing Oleh Pengajar Berbagai Keahlian</p>
            </div>
        </div>
    </div>
</section>


    {{-- form pendaftaran --}}
    <section id="pendaftaran" class="py-20 bg-emerald-50">
    <div class="max-w-3xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold text-blue-700 mb-4">Tertarik untuk bergabung di TPA Nurul Haq?</h2>
        <p class="text-gray-700 text-lg mb-8">
            Yuk! Langsung aja klik tombol di bawah ini
        </p>

        <a href="https://forms.gle/xwMYkaf2YXzuKiE99" 
            target="_blank"
            class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full text-lg shadow hover:bg-indigo-700 transition mr-4">
            Daftar melalui G-Form
        </a>

        <a href="{{ route('user.daftar.index') }}" 
            class="inline-block bg-green-600 text-white my-5 px-10 py-3 rounded-full text-lg shadow hover:bg-green-700 transition">
            Daftar melalui Web
        </a>


    </div>
</section>


<script>
    function countUp(id, target) {
        let el = document.getElementById(id);
        let count = 0;
        let increment = Math.ceil(target / 50); // speed adjustable
        let interval = setInterval(() => {
            count += increment;
            if (count >= target) {
                count = target;
                clearInterval(interval);
            }
            el.textContent = count;
        }, 30);
    }

    // Panggil saat DOM ready
    document.addEventListener("DOMContentLoaded", () => {
        countUp('murid-count', {{ $murids }});
        countUp('pengajar-count', {{ $pengajars }});
    });
</script>


@endsection