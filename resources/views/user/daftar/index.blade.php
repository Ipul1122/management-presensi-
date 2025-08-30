@extends('components.user.navbar')

@section('navbar-user')

<section class="py-20 bg-emerald-50">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Form Pendaftaran Murid TPA</h2>

        @if(session('success'))
            <div id="success-popover" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-xl shadow-lg p-8 text-center max-w-md">
                    <h2 class="text-2xl font-bold text-green-600 mb-4">Terima Kasih!</h2>
                    <p class="text-gray-700">{{ session('success') }}</p>

                    <div role="status" class="mt-4">
                        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin fill-green-600" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.59c0 27.6-22.39 50-50 50s-50-22.4-50-50c0-27.6 22.39-50 50-50s50 22.39 50 50z" fill="currentColor"/>
                            <path d="M93.97 39.04c2.43.64 3.9 3.13 3.04 5.49-1.71 4.73-4.13 9.18-7.19 13.21-3.97 5.23-8.93 9.62-14.6 12.93-5.67 3.31-11.94 5.48-18.44 6.36-6.51.88-13.11.44-19.4-1.29-6.3-1.73-12.18-4.72-17.31-8.79-5.13-4.07-9.45-9.11-12.68-14.96-2.61-4.73-4.62-9.83-5.95-15.14-.58-2.25.8-4.54 3.23-5.18 2.43-.64 4.92.82 5.5 3.07 1.15 4.48 2.93 8.78 5.29 12.73 2.69 4.6 6.14 8.64 10.2 11.92 4.05 3.27 8.65 5.7 13.58 7.16 4.93 1.45 10.05 1.79 15.13 1.01 5.08-.78 9.93-2.63 14.27-5.42 4.34-2.79 8.09-6.34 10.98-10.59 2.24-2.97 4.03-6.36 5.3-9.97.86-2.36 3.35-3.81 5.78-3.17z" fill="currentFill"/>
                        </svg>
                    </div>

                    <p class="text-sm text-gray-500 mt-4">Mengalihkan ke halaman pendaftaran...</p>
                </div>
            </div>

            <script>
                setTimeout(function() {
                    window.location.href = "{{ route('user.pendaftaran.index') }}";
                }, 3000);
            </script>
        @endif


        <form action="{{ route('user.daftar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Nama Anak --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Anak</label>
                <input type="text" name="nama_anak" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- Foto Anak --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Foto Anak</label>
                <input type="file" name="foto_anak" class="w-full border rounded-lg px-4 py-2" accept="image/*" required>
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full border rounded-lg px-4 py-2" required></textarea>
            </div>

            {{-- Kelas --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Kelas</label>
                <select name="kelas" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">-- Pilih Kelas --</option>
                    @for($i = 1; $i <= 9; $i++)
                        <option value="Kelas {{ $i }}">Kelas {{ $i }}</option>
                    @endfor
                </select>
            </div>

            {{-- Jenis Al-Kitab --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jenis Al-Kitab</label>
                <select name="jenis_alkitab" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">-- Pilih Jenis Bacaan --</option>
                    <option value="iqro">Iqra</option>
                    <option value="Al-Quran">Al-Qur'an</option>
                </select>
            </div>

            {{-- Tanggal Daftar --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Daftar</label>
                <input type="date" name="tanggal_daftar" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- Nomor Telepon --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- Ayah --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Ayah</label>
                <input type="text" name="ayah" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- Ibu --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Ibu</label>
                <input type="text" name="ibu" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-full shadow hover:bg-green-700 transition">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</section>

@endsection
