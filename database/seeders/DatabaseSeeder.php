<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Ditambahkan untuk enkripsi password

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Memasukkan Data Master Pilihan Ruangan (Venues) sesuai UI Anda
        DB::table('venues')->insert([
            [
                'nama_ruangan' => 'Grand Ballroom',
                'deskripsi' => 'Mewah klasik dengan kapasitas besar, cocok untuk resepsi megah.',
                'kapasitas_tamu' => '300-500 tamu',
                'luas_area' => 1200,
                'harga_per_hari' => 45000000,
                'status_ketersediaan' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ruangan' => 'Crystal Hall',
                'deskripsi' => 'Sentuhan modern dengan pencahayaan kristal dramatis untuk intimate wedding.',
                'kapasitas_tamu' => '100-200 tamu',
                'luas_area' => 600,
                'harga_per_hari' => 28000000,
                'status_ketersediaan' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ruangan' => 'Garden Terrace',
                'deskripsi' => 'Venue semi-outdoor dengan taman tropis, sempurna untuk pernikahan bernuansa alam.',
                'kapasitas_tamu' => '50-150 tamu',
                'luas_area' => 400,
                'harga_per_hari' => 18000000,
                'status_ketersediaan' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Memasukkan Data Contoh Booking untuk Tampilan Admin Dashboard Panel
        DB::table('bookings')->insert([
            [
                'id' => 1,
                'venue_id' => 1, // Mengarah ke Grand Ballroom
                'tanggal_acara' => '2026-06-14',
                'sesi' => 'Malam',
                'estimasi_tamu' => 400,
                'tema_dekorasi' => 'Classic Royal',
                'nama_mempelai_pria' => 'Budi',
                'nama_mempelai_wanita' => 'Sari',
                'email' => 'budi.sari@gmail.com',
                'no_whatsapp' => '081234567890',
                'total_estimasi' => 45000000,
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'venue_id' => 2, // Mengarah ke Crystal Hall
                'tanggal_acara' => '2026-06-21',
                'sesi' => 'Siang',
                'estimasi_tamu' => 150,
                'tema_dekorasi' => 'Modern Intimate',
                'nama_mempelai_pria' => 'Dian',
                'nama_mempelai_wanita' => 'Reza',
                'email' => 'dian.reza@gmail.com',
                'no_whatsapp' => '087765432109',
                'total_estimasi' => 28000000,
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'venue_id' => 3, // Mengarah ke Garden Terrace
                'tanggal_acara' => '2026-06-25',
                'sesi' => 'Pagi',
                'estimasi_tamu' => 100,
                'tema_dekorasi' => 'Rustic Tropical',
                'nama_mempelai_pria' => 'Rino',
                'nama_mempelai_wanita' => 'Hendra',
                'email' => 'rino.hendra@gmail.com',
                'no_whatsapp' => '085211223344',
                'total_estimasi' => 18000000,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 3. Memasukkan Data Akun Admin (Baru ditambahkan di sini)
        DB::table('users')->insert([
            'name' => 'Admin Deandra',
            'email' => 'dedeameliarhmn26@gmail.com',
            'password' => Hash::make('deandra06'), // Password dienkripsi otomatis demi keamanan
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name'     => 'Admin Wedding Organizer',
            'email'    => 'admin@wedding.com',
            'password' => Hash::make('password123'), // Password untuk login
            'role'     => 'admin', // Sesuai dengan opsi enum di migration Anda
        ]);

        // 2. Membuat Data Akun Uji Coba untuk USER BIASA / KLIEN
        User::create([
            'name'     => 'Dede Amelia (User)',
            'email'    => 'user@wedding.com',
            'password' => Hash::make('password123'), // Password untuk login
            'role'     => 'user', // Sesuai dengan opsi enum di migration Anda
        ]);
    }
}