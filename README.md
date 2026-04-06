# Panduan Penggunaan dan Instalasi Aplikasi (Atomize Planner Backend)

Dokumen ini berisi panduan teknis langkah demi langkah mengenai cara menginstal dan menjalankan aplikasi **Atomize Planner Backend** di komputer lokal Anda menggunakan lingkungan standar (Native PHP & MySQL / Composer / Artisan).

---

## 🛠 Prasyarat Sistem (Prerequisites)
Sebelum memulai instalasi, pastikan sistem Anda telah terpasang software berikut:
1. **[Git](https://git-scm.com/downloads)** - Untuk melakukan clone repositori.
2. **[PHP >= 8.2](https://www.php.net/downloads)** - Bahasa pemrograman backend. Disarankan menggunakan tools seperti XAMPP atau Laragon jika di Windows.
3. **[Composer](https://getcomposer.org/)** - Package manager untuk PHP.
4. **[MySQL / MariaDB](https://www.mysql.com/downloads/)** - Engine database.
5. **[Node.js](https://nodejs.org/) & [PNPM](https://pnpm.io/)** - PNPM digunakan sebagai package manager utama untuk Node.js pada project ini.
6. **[Postman](https://www.postman.com/)** - Untuk melakukan uji coba endpoint REST API.

---

## 🚀 Langkah Instalasi & Setup

### 1. Clone Repositori
Lakukan clone poyek ini ke direktori kerja Anda dan masuk ke folder proyek:
```bash
git clone <URL_REPOSITORY_ANDA>
cd atomize-planner-backend
```

### 2. Persiapan Environment (.env)
Salin (copy) file konfigurasi environment dari sampel yang ada:
```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan kredensial koneksi database Anda (biasanya bawaan XAMPP/Laragon seperti berikut):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=atomize_planner
DB_USERNAME=root
DB_PASSWORD=
```
*(Catatan: Pastikan Anda telah membuat database kosong bernama `atomize_planner` di MySQL Anda sebelum lanjut).*

### 3. Instalasi Dependensi PHP (Laravel)
Instal paket dan pustaka sistem Laravel via Composer:
```bash
composer install
```

### 4. Generate Application Key (Laravel)
Buat kunci unik untuk keamanan sesi dan enkripsi aplikasi Laravel:
```bash
php artisan key:generate
```

### 6. Pengaturan Database
Aplikasi saat ini telah menyertakan rekap database pada file `database.sql`. Anda dapat:
- Melakukan import manual file `database.sql` ke dalam database `atomize_planner` menggunakan fitur *Import* phpMyAdmin, DBeaver, atau sejenisnya.
- **Atau**, apabila Anda ingin mengulang struktur database menggunakan fitur migrasi bawaan Laravel (beserta seeder default):
  ```bash
  php artisan migrate:fresh --seed
  ```

### 7. Menjalankan Aplikasi
Anda perlu menjalankan backend server dan frontend asset bundler secara bersamaan (dengan membuka dua tab terminal):

**Terminal 1 (Backend - Laravel):**
```bash
php artisan serve
```
---

## 🌐 Mengakses Aplikasi
Setelah server menyala, aplikasi backend ini dapat diakses secara lokal melalui browser pada alamat default:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🧪 Testing REST API Menggunakan Postman

Proyek ini telah disertakan dengan bundel lengkap untuk pengujian API melalui Postman di dalam _root directory_:
1. File Koleksi: `Atomize Planner.postman_collection.json`
2. File Environment: `Atomize Planner.postman_environment.json`

**Cara Import ke Postman:**
1. Buka aplikasi **Postman**.
2. Klik tombol **Import** (biasanya di kiri atas).
3. Seret *(drag & drop)* atau pilih langsung kedua file JSON di atas.
4. Setelah berhasil diimport, lihat bagian kanan atas Postman pada dropdown **Environments**, lalu pilih environment bernama **`Atomize Planner`**.
5. Pastikan properti "base_url" (jika ada di dalam environment) merujuk pada `http://127.0.0.1:8000` (atau sesuaikan dengan port `artisan serve` Anda).
6. Anda sekarang bisa mulai mengeksekusi semua request yang telah tersedia di dalam _Collection_.
