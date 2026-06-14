<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel venues
            $table->foreignId('venue_id')->constrained('venues')->onDelete('cascade');
            
            $table->date('tanggal_acara');
            $table->string('sesi'); // Pagi / Siang / Malam
            $table->integer('estimasi_tamu');
            $table->string('tema_dekorasi');
            $table->string('nama_mempelai_pria');
            $table->string('nama_mempelai_wanita');
            $table->string('email');
            $table->string('no_whatsapp');
            $table->decimal('total_estimasi', 12, 2);
            $table->string('status')->default('Pending'); // Pending / Confirmed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};