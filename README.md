# FreshWash Laundry Management System

FreshWash adalah aplikasi berbasis web untuk manajemen sistem usaha laundry. Aplikasi ini dikembangkan menggunakan kerangka kerja (framework) **CodeIgniter 4** (PHP) dan didesain secara dinamis menggunakan **Bootstrap 5**.

Aplikasi ini mencakup seluruh siklus operasional bisnis laundry mulai dari manajemen data pelanggan, penentuan jenis layanan (tarif), pencatatan transaksi masuk hingga pengambilan cucian, serta penyajian laporan pendapatan.

---

## Teknologi yang Digunakan

- Bahasa Pemrograman:\*\* PHP 8.x
- **Framework Web:** CodeIgniter 4 (CI4)
- **Database:** MySQL
- **Frontend / UI:** HTML5, CSS3 (Vanilla), Bootstrap 5, Bootstrap Icons
- **Fonts:** Google Fonts (Inter)

---

## Fitur Utama

Aplikasi FreshWash memiliki 6 modul utama:

### 1. Autentikasi (Login)

- Akses aplikasi dilindungi oleh sistem Login.
- _Middleware (AuthFilter)_ mencegah akses tamu ke halaman dalam (dashboard, transaksi, dll).
- Autentikasi berbasis _Session_ CI4 dan menggunakan enkripsi kata sandi (Bcrypt).

### 2. Dashboard

- Dasbor interaktif yang memberikan pandangan makro terhadap bisnis.
- **Kartu Statistik (Stat Cards):** Menampilkan total pelanggan, total layanan aktif, jumlah transaksi harian, dan total pendapatan bulanan.
- **Ringkasan Status Transaksi:** Menginformasikan jumlah pesanan yang berada dalam status _Antrian_, _Proses_, dan _Selesai_.
- Menampilkan 5 transaksi terakhir secara langsung (real-time).

### 3. Jenis Layanan (Master Data)

- Pengaturan tarif dasar operasional laundry.
- Fitur CRUD (Create, Read, Update, Delete) untuk menambahkan layanan.
- Mendukung field: _Nama Layanan_, _Harga_, _Satuan_ (Kg, Pcs, dll), _Estimasi Waktu_, dan _Status Layanan_ (Aktif/Nonaktif).

### 4. Pelanggan (Master Data)

- Pengelolaan data pelanggan yang mendaftar.
- Fitur CRUD untuk detail pelanggan termasuk: _Nama_, _No. Telepon_, dan _Alamat Lengkap_.

### 5. Transaksi (Fitur Inti)

- Pencatatan pesanan (struk) masuk dari pelanggan.
- **Pembuatan Transaksi Dinamis:** Dapat memasukkan lebih dari satu jenis layanan dalam 1 transaksi menggunakan _dynamic form_ (Subtotal dan Total dihitung otomatis oleh Javascript).
- **Penomoran Otomatis:** Nomor struk (Kode Transaksi) di-generate secara otomatis setiap harinya (Contoh: `TRX-20231024-001`).
- **Alur Status:** Pengguna bisa mengubah status pengerjaan pesanan:
  1. `Antrian`: Menunggu proses.
  2. `Proses`: Sedang dicuci/disetrika.
  3. `Selesai`: Barang siap diambil (Otomatis mengisi tanggal selesai).
  4. `Diambil`: Barang telah diserahkan kembali kepada pelanggan.

### 6. Laporan

- Merekapitulasi semua data transaksi yang ada.
- Mendukung sistem **Filter berdasarkan Rentang Tanggal** (_Dari Tanggal_ - _Sampai Tanggal_).
- Menyajikan ringkasan: Total Transaksi, Total Pendapatan, Rata-rata per Transaksi.
- Menampilkan papan peringkat (Leaderboard) _Layanan Terpopuler_ yang paling sering dipesan oleh pelanggan.

### 7. Pengaturan

- **Pengaturan Toko:** Mengelola nama toko, alamat, kontak, dan jam buka.
- **Profil Saya:** Memungkinkan pengguna (Kasir/Admin) yang masuk untuk mengubah profil dan memperbarui kata sandi.

---

## Persyaratan Sistem (System Requirements)

- PHP >= 8.1 dengan ekstensi intl, mbstring, json.
- MySQL / MariaDB (Port standar 3306).
- Composer (Opsional, untuk manajemen dependensi).

---

## Panduan Instalasi & Menjalankan Aplikasi

1. **Persiapan Database**
   Pastikan layanan MySQL Anda berjalan di localhost (`127.0.0.1`) pada port `3306`.
   - Buat database baru bernama: `db_laundry` (Atau sesuaikan nama dan kredensialnya pada file `.env` sistem Anda).

2. **Pengaturan `.env` (Environment)**
   Buka file `.env` di folder _root_ dan sesuaikan koneksi database Anda.

   ```env
   database.default.hostname = 127.0.0.1
   database.default.database = db_laundry
   database.default.username = root
   database.default.password = root@123
   database.default.DBDriver = MySQLi
   database.default.port     = 3306
   ```

3. **Migrasi Tabel (Migrations)**
   Aplikasi ini menggunakan fitur Migrations CodeIgniter 4 untuk membangun tabel struktur _database_.
   Buka terminal di folder root (_CRUD_) dan jalankan:

   ```bash
   php spark migrate
   ```

4. **Isi Data Bawaan (Seeders)**
   Agar aplikasi bisa diuji dengan baik (termasuk akses login dan data _dummy_ awal), jalankan _seeders_ berikut secara berurutan:

   ```bash
   php spark db:seed UsersSeeder
   php spark db:seed PelangganSeeder
   php spark db:seed PengaturanSeeder
   ```

5. Jalankan Aplikasi\*\*
   Setelah semua langkah di atas berhasil, jalankan server bawaan PHP CodeIgniter 4 menggunakan perintah spark:
   ```bash
   php spark serve
   ```
   Secara _default_, aplikasi bisa diakses di _browser_ Anda melalui: `http://localhost:8080/`

---

## Akun Akses Default (Demo)

Setelah perintah `UsersSeeder` dijalankan, akun _admin_ berikut bisa digunakan untuk mengakses sistem pertama kali:

| Peran (Role) | Alamat Email          | Kata Sandi (Password) |
| ------------ | --------------------- | --------------------- |
| Admin        | `admin@freshwash.com` | `admin123`            |

_(Silakan ubah kata sandi ini dari menu **Pengaturan > Profil Saya** demi keamanan produksi)._

---

## Struktur Direktori Penting

- `app/Controllers/`: Logika sistem MVC dan respon aplikasi (_Auth_, _Dashboard_, _Transaksi_, dll).
- `app/Models/`: Interaksi basis data (_TransaksiModel_, _UserModel_, dll).
- `app/Views/`: Antarmuka Pengguna/UI (_login_, _dashboard_, _layout template_).
- `app/Database/Migrations/`: Instruksi perancangan _schema database_.
- `app/Database/Seeds/`: Data-data tiruan / data awal sistem.

---

_Aplikasi CRUD FreshWash dikembangkan untuk memfasilitasi kegiatan operasional Laundry skala mikro dan UMKM._
