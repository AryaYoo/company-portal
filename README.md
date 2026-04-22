# Portal RSIA IBI (Company Portal)

Portal RSIA IBI adalah sistem portal intranet perusahaan berbasis Laravel 11. Portal ini menyediakan akses tersentralisasi untuk tautan layanan internal/eksternal dan perpustakaan video tutorial operasional bagi karyawan rumah sakit (seperti tutorial Rawat Inap, Farmasi E-Resep, dll).

## 🚀 Fitur Utama
- **Akses Pengguna & Akses Publik:** 
  Dukungan login pengguna dan akses publik (*Public Access*). Tautan dan video dapat diatur informasinya untuk bisa diakses oleh tamu langsung dari halaman depan tanpa login.
- **Dukungan Penyimpanan Network Drive:**
  Portal ini telah dikonfigurasi secara khusus menggunakan aturan `.htaccess` untuk berjalan dengan baik di atas penyimpanan jaringan (*Network Drive* / `Z:` root). Sistem mem-bypass kebutuhan *symlink* yang biasanya dibatasi pada network drive.
- **Upload File Besar:**
  Didukung penanganan khusus untuk batasan ukuran file. Dapat menampung unggahan file hingga ratusan Megabyte. Validasi berlapis ada pada sisi klien (*Client-side JavaScript*) dan sisi server.
- **Integrasi Penuh SweetAlert2:**
  Pengalaman UI yang mulus dengan konfirmasi aksi, notifikasi sukses (toast), dan penanganan pesan error yang rapi menggunakan komponen SweetAlert.
- **Pemutar Video Hybrid:**
  Mendukung pemutaran file video MP4 yang diunggah secara lokal atau penyematan tautan video YouTube secara langsung. Ekstraksi ID YouTube bekerja secara otomatis untuk berbagai variasi URL.

---

## 🛠 Instalasi & Deployment

### Persyaratan Server
- PHP 8.2 atau lebih baru
- Ekstensi PHP: SQLite3, PDO_SQLite, Ctype, cURL, DOM, Fileinfo, Filter, Hash, Mbstring, OpenSSL, PCRE, PDO, Session, Tokenizer, XML.
- Apache/Nginx Web Server

### 1. Instalasi Standar (Windows/Linux/Debian)
Jika Anda memiliki akses terminal server dan versi PHP CLI sesuai dengan kebutuhan:

1. Klon repositori ini atau salin folder project ke direktori server Anda (misal `C:\xampp\htdocs\` atau `/var/www/html/`).
2. Masuk ke direktori project:
   ```bash
   cd portalrsiaibi
   ```
3. Install dependensi composer (lewati jika vendor/ sudah ada):
   ```bash
   composer install
   ```
4. Mengkonfigurasi file Environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Migrasi Database dan jalankan Seeder:
   ```bash
   php artisan migrate --seed
   ```
6. Sambungkan folder penyimpanan lokal (jika tidak menggunakan Network Drive bypass):
   ```bash
   php artisan storage:link
   ```

### 2. Instalasi Darurat / Konflik Versi PHP (Metode Web)
Dalam beberapa kasus lingkungan Windows (seperti XAMPP yang sudah lama), seringkali PHP di command line (CLI) berada di versi lama (misal PHP 5.6), sementara web server (Apache) telah diperbarui ke PHP 8.2+. Perintah `php artisan` akan gagal di terminal.

**Solusi Instalasi Database via Browser:**
1. Pastikan folder aplikasi sudah diletakkan dalam direktori root server (`htdocs`).
2. Jangan menggunakan `php artisan migrate` di terminal jika PHP Anda usang.
3. Buka browser dan pergi ke URL Migrasi Darurat yang telah disediakan:
   ```text
   http://localhost/portalrsiaibi/migrate.php
   ```
   *(Catatan: Sesuaikan `localhost` dengan IP atau domain server Anda, contoh: `http://192.168.100.177/portalrsiaibi/migrate.php`).*
4. Anda akan melihat layar bertuliskan **✅ Migration successful!**

## 🔧 Panduan Konfigurasi .htaccess & Upload Sizes
Batas unggahan video (default php.ini biasanya hanya 2MB) dan konfigurasi Symlink untuk direktori *storage* telah diterapkan secara paksa di `./.htaccess` dan `./public/.htaccess`.

Jika sewaktu-waktu server tidak mematuhi konfigurasi `.htaccess`, Anda wajib mengupdate `php.ini` server secara manual:
1. Buka file `php.ini` server Anda.
2. Temukan dan ubah:
   - `upload_max_filesize = 128M`
   - `post_max_size = 128M`
3. Restart Apache.

---

*Dikembangkan untuk lingkungan internal RSIA IBI.*
