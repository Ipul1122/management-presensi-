<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.



## About Project

Project ini dibangun untuk membuat sistem presensi kegiatan, seperti membuat menambah murid atau pengajar, mengedit data murid dan pengajar dll. Yang telah dibangun dalam project ini yaitu

- Login page Admin & Pengajar. Memiliki username dan password yang berbeda
- Admin. username = admin, password = admin123
- Pengajar. username = pengajar1, password = pengajar123 || username = pengajar2, password = pengajar123
- Dashboard Admin, Pengajar
- Perlindungan Dashboard Admin dan pengajar apa bila masuk tanpa login
- Dapat membuat, mengedit, menghapus data murid dan pengajar
- Notifikasi, memberi tahu apa saja yang baru saja melakukan perubahan

## Usage

Untuk menggunakan project tersebut, kamu memerlukan beberapa hal yang perlu dilakukan

Cek di terminal seperti CMD, Window Poweshell, bash dll. Lalu ketikkan, apabila tidak muncul versinya, berarti belum install
- `php -v` Minimal php 8+
- `composer` Minimal 2.8+
- `node -v` Minimal 20+
- `npm -v` Minimal 10+

Jika kalian sudah cek dan ternyata ada semua, jalankan perintah selanjutnya di terminal
- Pastikan memiliki server-side seperti xampp || laragon. Kemudian jalankan Apache && Mysql
- `git clone https://github.com/Ipul1122/management-presensi-.git` untuk mendapatkan project tersebut
- `npm run dev` menjalankan Vite
- `php artisan migrate` menjalankan perintah migrasi database
- `php artisan db::seed` menjalankan kode akses login form admin || pengajar
- `php artisan serve` menjalankan perintah artisan untuk mendapatkan localhost:8000

## Requirement

Hal apa saja yang saya pakai untuk membangun website presensi tersebut, yaitu 

- Framework: Laravel 12 -> latest update
- CSS: Tailwind CSS 3.4.17
- Animasi: AOS.js
- Autentikasi: Laravel Sanctum (tanpa Breeze/Jetstream)
- Desain Responsif
- Login Multi-Auth:
- Admin
- Pengajar1 (Iqro)
- Pengajar2 (Al-Qur’an)
<<<<<<< HEAD
- ( Tambah baru )
=======
>>>>>>> 6b22bb6118955ef8cbb6bf63ddbf0250094bdd62

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
