<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan'); // Contoh: Crystal Hall, Grand Ballroom
            $table->text('deskripsi')->nullable();
            $table->string('kapasitas_tamu'); // Contoh: "100-200 tamu"
            $table->integer('luas_area'); // Contoh: 600 (dalam m²)
            $table->decimal('harga_per_hari', 12, 2); // Contoh: 28000000.00
            $table->string('status_ketersediaan')->default('Tersedia'); // Tersedia / Penuh
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};