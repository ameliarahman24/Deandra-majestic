<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. ISI DATA MASTER BALLROOMS
        DB::table('ballrooms')->insert([
            [
                'ballroom_id' => 1,
                'nama_ruangan' => 'Grand Palace Ballroom',
                'kapasitas' => 1000,
                'harga_sewa_dasar' => 50000000.00,
                'lokasi_lantai' => 'Lantai 1',
                'deskripsi' => 'Ballroom pilar-less dengan langit-langit tinggi kristal mewah, cocok untuk pesta megah.'
            ],
            [
                'ballroom_id' => 2,
                'nama_ruangan' => 'Emerald Sky Hall',
                'kapasitas' => 500,
                'harga_sewa_dasar' => 25000000.00,
                'lokasi_lantai' => 'Lantai 5 (Rooftop)',
                'deskripsi' => 'Ruangan semi-outdoor dengan pemandangan lanskap kota, atmosfer romantis modern.'
            ],
            [
                'ballroom_id' => 3,
                'nama_ruangan' => 'Sapphire Grand Room',
                'kapasitas' => 300,
                'harga_sewa_dasar' => 15000000.00,
                'lokasi_lantai' => 'Lantai 2',
                'deskripsi' => 'Nuance klasik elegan dengan pencahayaan warm-white, cocok untuk intimate wedding.'
            ],
            [
                'ballroom_id' => 4,
                'nama_ruangan' => 'Ruby Garden Pavilion',
                'kapasitas' => 200,
                'harga_sewa_dasar' => 10000000.00,
                'lokasi_lantai' => 'Lantai Dasar (Area Taman)',
                'deskripsi' => 'Konsep taman terbuka (outdoor) yang menyatu dengan paviliun kaca eksklusif.'
            ],
        ]);

        // 2. ISI DATA MASTER WEDDING PACKAGES
        DB::table('wedding_packages')->insert([
            [
                'nama_paket' => 'Silver Luxury',
                'harga_per_pax' => 150000.00,
                'fasilitas_utama' => 'Standard Sound System, Kursi Banquet, 1 Kamar Suite Pengantin, Pilihan 5 Menu Prasmanan',
                'pilihan_menu' => 'Indonesian Buffet'
            ],
            [
                'nama_paket' => 'Gold Elegance',
                'harga_per_pax' => 250000.00,
                'fasilitas_utama' => 'Premium Sound System, Panggung Dekorasi Standar, 1 Kamar Suite + 2 Kamar Deluxe, Pilihan 7 Menu Prasmanan & 2 Food Stall',
                'pilihan_menu' => 'Asian & Indonesian Fusion'
            ],
            [
                'platinum_id' => null, // Biarkan auto increment bekerja otomatis
                'nama_paket' => 'Platinum Royal',
                'harga_per_pax' => 400000.00,
                'fasilitas_utama' => 'Grand Sound System, Lighting Megah, Full Karpet Red Carpet, Kamar Penthouse Pengantin + 4 Kamar Deluxe, Pilihan 9 Menu Internasional & 4 Food Stall, Free Flow Softdrink',
                'pilihan_menu' => 'International Fine Dining'
            ],
        ]);
    }
}