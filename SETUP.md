# Company Portal - Setup & Getting Started

## Overview
Website Company Portal ini adalah aplikasi Laravel yang memungkinkan penyimpanan dan pengelolaan link internal perusahaan serta tutorial video.

### Fitur Utama
- **2 Role**: Admin dan User
- **Manajemen Link**: Admin dapat mengunggah link dengan cover image dan keterangan
- **Tutorial Video**: Admin dapat mengunggah video dan mengelompokkannya berdasarkan kategori
- **Kategori**: Admin dapat membuat kategori untuk mengorganisir link dan video

## Requirements
- PHP >= 8.3
- Composer
- Database (MySQL/PostgreSQL)
- Laravel 11

## Setup Instructions

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` dengan database credentials Anda:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_rsiaibi
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed database dengan sample data
php artisan db:seed
```

### 4. Storage Link (untuk file uploads)
```bash
php artisan storage:link
```

### 5. Run Development Server
```bash
php artisan serve
# Or with specific port
php artisan serve --port=8000
```

Visit: `http://localhost:8000`

## Default Credentials

### Admin Account
- Email: `admin@portalrsiaibi.com`
- Password: `admin123`

### Demo User Account
- Email: `user@portalrsiaibi.com`
- Password: `user123`

## Project Structure

### Controllers
- `Admin/` - Controllers untuk admin functionality
  - `DashboardController` - Admin dashboard
  - `CategoryController` - Manajemen kategori
  - `LinkController` - Manajemen link internal
  - `VideoController` - Manajemen video tutorial
  
- `User/` - Controllers untuk user functionality
  - `DashboardController` - User dashboard
  - `LinkController` - View link internal
  - `VideoController` - View video tutorial

### Models
- `User` - Model user dengan role field
- `Category` - Kategori untuk link dan video
- `Link` - Link internal dengan relationship ke kategori
- `Video` - Video tutorial dengan relationship ke kategori

### Views
- `layouts/app.blade.php` - Main layout dengan sidebar
- `admin/` - Admin views
  - `dashboard.blade.php` - Admin dashboard
  - `categories/` - Kategori management views
  - `links/` - Link management views
  - `videos/` - Video management views
  
- `user/` - User views
  - `dashboard.blade.php` - User dashboard
  - `links/` - Link viewing
  - `videos/` - Video viewing

### Database Tables
- `users` - User accounts dengan role field
- `categories` - Kategori link dan video
- `links` - Link internal dengan cover image
- `videos` - Video tutorial dengan file dan thumbnail
- `password_reset_tokens` - Password reset tokens
- `sessions` - User sessions

## Admin Features

### Kategori Management
- Buat, edit, hapus kategori
- Atur urutan tampilan
- Aktifkan/nonaktifkan kategori

### Link Management
- Tambah link dengan cover image
- Edit link dan cover image
- Hapus link
- Atur urutan tampilan
- Aktifkan/nonaktifkan link

### Video Management
- Upload video (format: MP4, AVI, MOV, MKV)
- Upload thumbnail
- Edit metadata video (durasi, kategori, dll)
- Hapus video
- Atur urutan tampilan
- Aktifkan/nonaktifkan video

## User Features

### Link Internal
- Lihat kategori link
- Lihat semua link dalam kategori
- Buka link langsung

### Tutorial Video
- Lihat kategori tutorial
- Lihat video dalam kategori
- Menonton video dengan player built-in
- Melihat video lainnya dalam kategori yang sama

## Security
- Authentication menggunakan Laravel's built-in auth
- Role-based authorization dengan middleware
- Input validation untuk semua forms
- CSRF protection
- File upload validation

## File Upload Limits
- Cover Image (Link): Max 2MB (JPG, PNG, GIF)
- Thumbnail (Video): Max 2MB (JPG, PNG, GIF)
- Video File: Max 100MB (MP4, AVI, MOV, MKV)

## Storage
Files disimpan di:
- `storage/app/public/links` - Link cover images
- `storage/app/public/thumbnails` - Video thumbnails
- `storage/app/public/videos` - Video files

Public akses tersedia di: `storage/` folder

## Troubleshooting

### Video tidak bisa diupload
- Pastikan storage folder writable: `chmod -R 775 storage/`
- Check max upload size di php.ini: `upload_max_filesize` dan `post_max_size`

### File tidak visible
- Run: `php artisan storage:link`
- Check public/storage symlink exists

### Migration errors
- Drop semua tables: `php artisan migrate:refresh`
- Atau: `php artisan db:wipe` kemudian `php artisan migrate --seed`

## Development Tips

### Database Refresh dengan Seeding
```bash
php artisan migrate:fresh --seed
```

### Create New Admin
```bash
php artisan tinker
User::create(['name' => 'New Admin', 'email' => 'admin2@example.com', 'password' => bcrypt('password'), 'role' => 'admin'])
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Next Steps / Roadmap
- [ ] User profile management
- [ ] Search functionality
- [ ] Export/Import categories
- [ ] Video analytics/views tracking
- [ ] Comments on videos
- [ ] Favorites/bookmarks
- [ ] Email notifications
- [ ] API endpoints
- [ ] Mobile app support

## Support
Untuk pertanyaan atau issues, hubungi tim IT.

---
**Last Updated**: April 2026
**Version**: 1.0
