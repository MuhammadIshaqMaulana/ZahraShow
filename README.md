# 🏫 SMP Islam Az-Zahrah 1 Palembang — Academic & E-Learning Portal

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Vercel](https://img.shields.io/badge/Vercel-Serverless%20Ready-000000?style=for-the-badge&logo=vercel&logoColor=white)](https://vercel.com)

> **Sistem Informasi Sekolah & Portal E-Learning** yang dirancang untuk mendigitalisasi proses akademik harian serta profil publik sekolah. Dibangun dengan **Laravel 11**, aplikasi ini menerapkan arsitektur **Unified Dynamic CRUD Engine** yang berhasil memangkas hingga **~70% boilerplate code** dan mereduksi **88% file controller & view**.

---

## 🚀 Engineering Highlight: Refactoring & Architecture Story

Saat mengelola 9 entitas berbeda (*Guru, Siswa, Kelas, Subkelas, Mapel, Materi, Berita, Pengumuman, dan Galeri*), pendekatan konvensional biasanya memerlukan 1 Controller dan 1 Blade View terpisah per modul (18+ file). Pola tersebut menyebabkan redundansi tinggi dan memperlambat alur *maintenance*.

Melalui refactoring menyeluruh, aplikasi ini menerapkan **Unified Dynamic Engine**:
* **Single-Point Dynamic Controller (`EditController.php`)**: Mengabstraksi operasi Create, Read, Update, Delete (CRUD), dan Soft-Delete ke dalam satu controller dinamis berbasis route parameter (`/edit/{nama_tabel}/{id}`).
* **Convention-over-Configuration UI (`edit.blade.php`)**: Menstandardisasi atribut skema database (`id_*`, `nama_*`, `file_*`, `text_*`) sehingga 1 template Blade adaptif terhadap puluhan field input, form upload, dan relasi foreign key dinamis.
* **Dual-Lifecycle Synchronization**: Mengotomatisasi sinkronisasi antara data master (Guru/Siswa) dengan tabel otentikasi (`users`), lengkap dengan fitur *one-click account activation/deactivation*.
* **Automated Storage Management**: Pembersihan berkas lama secara otomatis di disk storage saat file baru (foto, modul materi, galeri) diunggah atau dihapus.

### 📊 Metrik Efisiensi & Dampak Arsitektur

| Metrik | Sebelum Refactoring | Sesudah Refactoring | Dampak |
| :--- | :---: | :---: | :---: |
| **Jumlah File (Controller + View)** | 18 File | **2 File Terpusat** | 📉 **88% Lebih Sedikit File** |
| **Estimasi Baris Kode (LoC)** | ~2.500+ Baris | **~790 Baris** | 📉 **~70% Reduksi Kode** |
| **Waktu Maintenance & Update UI** | 100% (Baseline) | **~35-40%** | ⏱️ **60%+ Lebih Cepat** |
| **Entitas Dinamis Terkelola** | Terpisah-pisah | **9 Modul Terintegrasi** | ⚡ **Single Source of Truth** |

---

## ✨ Fitur Utama Sistem

### 1. 🎓 Manajemen Akademik & E-Learning
* **Hierarki Akademik Bertingkat**: Struktur berjenjang dari `Tingkat Kelas` ➔ `Subkelas (Rombel, Tahun Ajaran, Semester)` ➔ `Siswa & Mata Pelajaran`.
* **Distribusi Materi Pembelajaran**: Guru dapat mengunggah modul materi (PDF / PowerPoint) terorganisir per urutan bab pembelajaran (`urutan_materi`) dengan direct download aman untuk siswa.
* **Penugasan Guru & Mapel**: Penugasan guru pengampu spesifik ke subkelas tertentu.

### 2. 🛡️ Role-Based Access Control (RBAC) & Keamanan
* **Multi-Role Middleware**: Pemisahan hak akses ketat antara `Admin`, `Guru`, `Guru-Admin`, dan `Siswa`.
* **Account Lifecycle**: Fitur nonaktifkan / aktifkan akun siswa dan guru dengan password default ter-hash otomatis berbasis NISN / ID Guru.
* **Client & Server-Side File Validation**: Pembatasan ekstensi berkas, MIME type, serta kuota ukuran berkas (avatar 1MB, galeri 5MB, materi 10MB) dan enforce panjang digit identitas (NISN 10 digit, ID Guru 11 digit).

### 3. 🌐 Portal Informasi Publik & PPDB
* **Beranda Interaktif**: Slider carousel responsif dan etalase kegiatan sekolah.
* **Portal Berita & Pengumuman**: Berita sekolah dan pengumuman resmi lengkap dengan lampiran unduhan.
* **Galeri Sekolah**: Dokumentasi kegiatan dengan viewer interaktif (*Lightbox & Carousel*).
* **Informasi PPDB**: Saluran informasi pendaftaran peserta didik baru.

---

## 🛠️ Tech Stack & Ekosistem

* **Backend Framework**: [Laravel 11](https://laravel.com) (PHP 8.2+)
* **Database & ORM**: Eloquent ORM, SoftDeletes, MySQL / MariaDB (kompatibel dengan TiDB Cloud Serverless)
* **Frontend**: Blade Templating, [Tailwind CSS](https://tailwindcss.com), [Bootstrap 5](https://getbootstrap.com), FontAwesome
* **Interaktivitas & Komponen**: [Livewire 3](https://livewire.laravel.com), FilePond, Lightbox2, Flexslider, Owl Carousel
* **Deployment & Cloud**: Serverless Ready via [Vercel](https://vercel.com) (`vercel-php@0.7.2`) dengan ephemeral `/tmp` storage redirection

---

## 📁 Struktur Direktori Kunci

```text
├── api/
│   └── index.php             # Serverless function entrypoint (storage redirection ke /tmp)
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── EditController.php   # 🔥 Unified dynamic controller untuk seluruh edit modul
│   │   │   ├── UploadController.php # 🔥 Unified dynamic upload controller
│   │   │   └── ...
│   │   └── Middleware/              # RBAC Middleware (Admin, Guru, GuruAdmin)
│   └── Models/                      # Eloquent Models (Guru, Siswa, Kelas, Mapel, Materi, dll)
├── resources/
│   └── views/
│       ├── edit.blade.php           # 🔥 Unified dynamic Blade view
│       ├── upload.blade.php         # 🔥 Unified dynamic upload view
│       └── ...
└── vercel.json                      # Konfigurasi routing serverless Vercel
```

---

## 💻 Panduan Instalasi Lokal

### Prasyarat
* PHP >= 8.2
* Composer >= 2.x
* Node.js >= 18.x & NPM
* MySQL / MariaDB

### Langkah Instalasi
1. **Clone repository ini**:
   ```bash
   git clone https://github.com/MuhammadIshaqMaulana/ZahraShow.git
   cd ZahraShow
   ```

2. **Install dependency backend & frontend**:
   ```bash
   composer install
   npm install
   ```

3. **Setup environment file**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database** di file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_db_kamu
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi & build aset**:
   ```bash
   php artisan migrate
   npm run build
   ```

6. **Jalankan server pengembangan**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui `http://localhost:8000`.

---

## 👨‍💻 Author

**Muhammad Ishaq Maulana**
* LinkedIn: [Muhammad Ishaq Maulana](https://www.linkedin.com/in/muhammad-ishaq-maulana/)
* GitHub: [@MuhammadIshaqMaulana](https://github.com/MuhammadIshaqMaulana)

---

## 📄 License
Proyek ini dibuat untuk keperluan portofolio dan edukasi di bawah lisensi [MIT License](LICENSE).
