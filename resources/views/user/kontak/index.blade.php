@extends('components.user.navbar')

@section('navbar-user')

    <section id="kontak" class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row gap-8">
        
        {{-- LEFT: Google Maps --}}
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl font-bold mb-4 text-blue-700">Alamat TPA Nurul Haq</h2>
            <div class="rounded-lg overflow-hidden shadow">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.738454302736!2d106.79538937413047!3d-6.1657695604241525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f642d88d5841%3A0x6c31ab35f182053a!2sMasjid%20Nurul%20Haq!5e0!3m2!1sid!2sid!4v1750152768250!5m2!1sid!2sid" 
                width="600" height="450" style="border:0;" 
                allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        {{-- RIGHT: Form Kontak --}}
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl font-bold mb-4 text-blue-700">Hubungi Kami</h2>
            <form id="kontakForm" class="bg-white p-6 rounded-lg shadow space-y-4">
                <input type="text" id="nama" name="nama" placeholder="Nama Anda" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">

                <input type="tel" id="telp" name="telp" placeholder="Nomor Telepon / WhatsApp" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">

                <textarea id="pesan" name="pesan" rows="4" placeholder="Tulis pesan Anda di sini..." required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>

                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all duration-200">
                    Kirim Pesan via WhatsApp
                </button>
            </form>
        </div>
    </div>
</section>


<script>
document.getElementById('kontakForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const telp = document.getElementById('telp').value;
    const pesan = document.getElementById('pesan').value;

    const noAdmin = '+6287746391601'; // Ganti dengan nomor WhatsApp admin (gunakan kode negara, tanpa +)
    const message = `Halo Admin TPA Nurul Haq! %0ASaya ${nama} %0A No. Telp: ${telp}%0A%0A Pesan: %0A${pesan}`;

    const url = `https://wa.me/${noAdmin}?text=${message}`;

    window.open(url, '_blank');
});
</script>


@endsection