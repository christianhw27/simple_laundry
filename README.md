# 🧺 Simple Laundry App

Aplikasi manajemen laundry sederhana berbasis web yang menerapkan integrasi **PHP, Python, dan JavaScript** serta fitur lanjutan Database (MySQL/MariaDB).

Dibuat untuk memenuhi tugas Pemrograman Web & Basis Data Lanjut.

## 📸 Screenshots

| Halaman Utama | Fitur Pencarian & Aksi |
|Orang|---|
| ![Halaman Utama](screenshots/home.png) | ![Search & Delete](screenshots/action.png) |

## ✨ Fitur Utama

Aplikasi ini mendemonstrasikan penggunaan *Full Stack Logic* sederhana:

1.  **CRUD Transaksi:** Input, Baca, Update (Selesai), dan Delete data cucian.
2.  **Live Search (AJAX):** Pencarian data pelanggan secara *real-time* tanpa reload halaman menggunakan JavaScript.
3.  **Integrasi Python:** Fitur "Export Laporan" dimana PHP memanggil script Python untuk memproses data database dan menghasilkan file `.txt`.
4.  **Advanced Database (MySQL):**
    * **Stored Procedure:** `tambah_cucian` (Menangani input data).
    * **Function:** `hitung_biaya` (Otomatis hitung total bayar berdasarkan berat).
    * **Trigger:** `update_waktu_selesai` (Otomatis isi *timestamp* saat status berubah jadi 'Selesai').
    * **View:** `list_aktif` (Query khusus untuk laporan).

## 🛠️ Teknologi yang Digunakan

* **Backend:** PHP 8.x (Native)
* **Database:** MySQL / MariaDB
* **Frontend:** HTML5, CSS3 (Modern Clean UI), JavaScript (Vanilla)
* **Scripting:** Python 3.x (Library: `mysql-connector-python`)

## 🚀 Cara Instalasi & Menjalankan

### 1. Persiapan Database
1.  Buka **phpMyAdmin**.
2.  Buat database baru bernama `laundry_db`.
3.  Import file SQL atau jalankan query pembuatan tabel, procedure, function, trigger, dan view yang ada di file `database.sql` (jika ada) atau sesuai dokumentasi tugas.

### 2. Konfigurasi Project
1.  Clone repository ini atau letakkan folder `simple_laundry` di dalam `htdocs` (XAMPP).
2.  Pastikan konfigurasi di `koneksi.php` sudah sesuai:
    ```php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "laundry_db";
    ```

### 3. Persiapan Python (Untuk Fitur Export)
Pastikan Python sudah terinstall di komputer, lalu install library MySQL Connector:
```bash
pip install mysql-connector-python
```
### 4. Jalankan Aplikasi
Buka browser dan akses: http://localhost/simple_laundry

##📝 Struktur Folder
simple_laundry/
├── screenshots/        # Folder gambar untuk README
│   ├── home.png
│   └── action.png
├── style.css           # Styling tampilan
├── script.js           # Logic AJAX Search
├── index.php           # Halaman Utama (CRUD)
├── cari.php            # Helper pencarian
├── koneksi.php         # Koneksi Database
├── export_data.py      # Script Python Export
└── README.md           # Dokumentasi ini
