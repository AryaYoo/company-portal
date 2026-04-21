# Deployment Guide: Debian Server + MariaDB

Panduan ini ditujukan untuk memindahkan Portal RSIA IBI ke server produksi berbasis **Debian** menggunakan **MariaDB** sebagai database utama.

## 1. Persiapan Server (Debian)

Update sistem dan install komponen yang diperlukan:
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y apache2 mariadb-server php php-mysql php-xml php-curl php-mbstring php-zip unzip git
```

## 2. Konfigurasi MariaDB

Masuk ke console MariaDB:
```bash
sudo mariadb
```

Jalankan perintah SQL berikut untuk membuat database dan user:
```sql
CREATE DATABASE company_portal;
CREATE USER 'portal_user'@'localhost' IDENTIFIED BY 'password_anda_disini';
GRANT ALL PRIVILEGES ON company_portal.* TO 'portal_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

## 3. Instalasi Proyek

Masuk ke direktori web root:
```bash
cd /var/www/html
```

Clone proyek dari GitHub:
```bash
git clone https://github.com/AryaYoo/company-portal.git portalrsiaibi
cd portalrsiaibi
```

## 4. Konfigurasi Environment (`.env`)

Salin file default env:
```bash
cp .env.example .env
```

Edit file `.env` (gunakan `nano .env`) dan sesuaikan bagian database:
```env
APP_URL=http://192.168.100.2/portalrsiaibi

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=company_portal
DB_USERNAME=portal_user
DB_PASSWORD=password_anda_disini
```

## 5. Instalasi Dependensi & Migrasi

Install library PHP (pastikan Composer sudah terinstall):
```bash
composer install --no-dev --ignore-platform-reqs
php artisan key:generate
php artisan migrate --force
php artisan storage:link
```

## 6. Hak Akses Folder (Penting)

Berikan izin tulis kepada web server (untuk Debian/Apache):
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## 7. Konfigurasi Apache (Subdirectory)

Pastikan `mod_rewrite` aktif:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Pastikan file `.htaccess` yang berada di root proyek sudah terbaca (di file konfigurasi `/etc/apache2/apache2.conf`, pastikan `AllowOverride All` aktif untuk direktori `/var/www/html`).

---

### Cara Akses
Portal dapat diakses melalui:
`http://192.168.100.2/portalrsiaibi`
