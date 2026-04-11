# Atomize Planner Backend

Ini adalah layanan backend untuk aplikasi Atomize Planner, yang dibuat dengan Laravel.

## Fitur

- Otentikasi dan manajemen pengguna
- Manajemen tugas (Tasks)
- Memecah tugas menjadi langkah-langkah kecil (Atomize)
- Sesi fokus (Focus Sessions)
- Riwayat dan ringkasan produktivitas

## Prasyarat

- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (SQLite, MySQL, PostgreSQL, dll.)

## Cara Instalasi

1.  **Clone repository ini:**
    ```bash
    git clone https://github.com/username/atomize-planner-backend.git
    cd atomize-planner-backend
    ```

2.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Install dependensi JavaScript:**
    ```bash
    npm install
    ```

4.  **Buat file environment:**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Generate kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi database:**
    Buka file `.env` dan sesuaikan pengaturan database Anda (misalnya, `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, dll.). Secara default, aplikasi ini dikonfigurasi untuk menggunakan SQLite.

7.  **Jalankan migrasi dan seeder database:**
    Perintah ini akan membuat struktur tabel dan mengisi data awal yang diperlukan.
    ```bash
    php artisan migrate --seed
    ```

8.  **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.

## Cara Penggunaan

Aplikasi ini menyediakan RESTful API. Cara termudah untuk berinteraksi dengan API adalah dengan menggunakan koleksi Postman yang sudah disediakan.

1.  Impor `Atomize Planner.postman_collection.json` ke dalam Postman.
2.  Impor `Atomize Planner.postman_environment.json` untuk mengatur variabel environment di Postman.
3.  Pastikan untuk mengatur variabel `base_url` di environment Postman Anda ke `http://127.0.0.1:8000/api/v1`.

### Daftar Endpoint API

Semua endpoint diawali dengan `/api/v1`.

**Otentikasi**
- `POST /auth/register` - Registrasi pengguna baru.
- `POST /auth/login` - Login pengguna.
- `POST /auth/logout` - Logout pengguna (memerlukan otentikasi).

**Profil Pengguna**
- `GET /profile` - Menampilkan profil pengguna.
- `PATCH /profile` - Memperbarui profil pengguna.
- `DELETE /profile` - Menghapus akun pengguna.
- `POST /profile/avatar` - Mengunggah avatar.
- `DELETE /profile/avatar` - Menghapus avatar.
- `POST /profile/change-password` - Mengubah kata sandi.

**Tugas (Tasks)**
- `GET /tasks` - Mendapatkan semua tugas.
- `POST /tasks` - Membuat tugas baru.
- `POST /tasks/atomize` - Memecah tugas menjadi langkah-langkah menggunakan AI.
- `GET /tasks/{id}` - Mendapatkan detail tugas.
- `PATCH /tasks/{id}` - Memperbarui tugas.
- `DELETE /tasks/{id}` - Menghapus tugas.

**Langkah Tugas (Task Steps)**
- `POST /tasks/{taskId}/steps` - Menambah langkah pada tugas.
- `PATCH /tasks/{taskId}/steps/{stepId}/toggle` - Mengubah status selesai/belum selesai sebuah langkah.
- `PATCH /tasks/{task}/steps/{step}` - Memperbarui detail langkah.
- `DELETE /tasks/{task}/steps/{step}` - Menghapus langkah.
- `POST /tasks/{taskId}/steps/{stepId}/mark-working` - Menandai langkah yang sedang dikerjakan.

**Sesi Fokus**
- `POST /focus/sessions` - Memulai sesi fokus baru.
- `GET /focus/sessions/active` - Mendapatkan sesi fokus yang aktif.
- `POST /focus/sessions/{session}/complete` - Menyelesaikan sesi fokus.
- `POST /focus/sessions/{session}/cancel` - Membatalkan sesi fokus.
- `PATCH /focus/sessions/{session}/settings` - Memperbarui pengaturan sesi fokus.

**Riwayat**
- `GET /history/summary` - Mendapatkan ringkasan mingguan.
- `GET /history/completed-tasks` - Mendapatkan daftar tugas yang telah selesai.