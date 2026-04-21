<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin Portal',
            'email' => 'admin@portalrsiaibi.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::factory()->create([
            'name' => 'User Demo',
            'email' => 'user@portalrsiaibi.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);

        // Create Sample Categories
        Category::create([
            'name' => 'Aplikasi Internal',
            'slug' => 'aplikasi-internal',
            'description' => 'Link aplikasi internal perusahaan yang sering digunakan',
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Email & Komunikasi',
            'slug' => 'email-komunikasi',
            'description' => 'Layanan email dan komunikasi perusahaan',
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Resources & Dokumentasi',
            'slug' => 'resources-dokumentasi',
            'description' => 'Dokumentasi dan resource yang berguna',
            'order' => 3,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Panduan Operasional',
            'slug' => 'panduan-operasional',
            'description' => 'Tutorial dan panduan penggunaan sistem',
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Training & Development',
            'slug' => 'training-development',
            'description' => 'Video pelatihan dan pengembangan karyawan',
            'order' => 2,
            'is_active' => true,
        ]);
    }
}

