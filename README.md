<h1 align="center">📦 Larakos - Sistem Penitipan Barang</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine JS">
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

## ✨ Tentang Proyek Ini

**Larakos (atau PenitipanApp)** adalah sebuah aplikasi manajemen penitipan barang berbasis web yang dibangun menggunakan **Laravel 10**, **Tailwind CSS**, dan **Alpine.js**. Aplikasi ini mengusung desain antarmuka *(UI/UX)* tema **Liquid Glass** yang sangat elegan, modern, dan estetik, terinspirasi dari SaaS Dashboard premium.

Aplikasi ini dirancang untuk memudahkan proses pencatatan barang yang dititipkan, pengelolaan status barang, fitur dokumentasi foto barang, hingga fitur **Live Chat** terintegrasi antara admin dan penitip.

## 🚀 Fitur Utama

- 🎨 **Liquid Glass UI/UX**: Desain antarmuka premium dengan efek *glassmorphism*, bayangan lembut, dan animasi *smooth*.
- 👥 **Role-based Access Control (RBAC)**: Tersedia peran **Admin** dan **User (Penitip)** dengan hak akses yang berbeda.
- 📸 **Manajemen Foto Barang (CRUD)**: Mendukung unggah banyak *(multiple)* foto barang sebagai bukti kondisi fisik.
- 💬 **Live Chat Real-time**: Diskusi langsung antara Admin dan Penitip layaknya WhatsApp (dilengkapi efek *auto-scroll* ke pesan terbaru).
- 👤 **Manajemen Profil & Avatar**: User dapat mengelola profil dan mengubah foto profil (avatar).
- 📱 **Responsif**: Tampilan sempurna untuk desktop maupun *mobile*.

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

1. **Clone repository ini**
   ```bash
   git clone https://github.com/nugra21/larakos-penitipan-barang.git
   cd larakos-penitipan-barang
   ```

2. **Install dependency PHP & Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Duplikat file konfigurasi lingkungan (.env)**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database**
   Buka file `.env` dan sesuaikan pengaturan koneksi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

6. **Jalankan Migrasi Database**
   ```bash
   php artisan migrate --seed
   ```

7. **Tautkan Storage (Berfungsi untuk menyimpan Avatar & Foto Barang)**
   ```bash
   php artisan storage:link
   ```

8. **Build Aset Frontend & Jalankan Server Lokal**
   ```bash
   npm run build
   php artisan serve
   ```

   Aplikasi dapat diakses melalui `http://localhost:8000`.

## 📸 Screenshot

*(Tambahkan gambar screenshot dari Dashboard, Halaman Chat, dan Halaman Edit Profil Anda di GitHub nanti)*

## 📄 Lisensi

Proyek ini berlisensi open-source dan didistribusikan di bawah lisensi [MIT](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Dikembangkan oleh **[Nugra21](https://github.com/nugra21)** / Ludang Prasetyo Nugroho.
