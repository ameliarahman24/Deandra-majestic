<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_addons', function (Blueprint $table) {
            $table->id();
            
            // PERBAIKAN: Menggunakan metode standard yang lebih aman untuk foreign key di Laravel
            // baris ini otomatis membuat kolom 'booking_id' tipe BigInteger & menyambungkannya ke tabel 'bookings'
            $table->foreignId('booking_id')
                  ->constrained()
                  ->cascadeOnDelete();
            
            $table->string('nama_layanan'); // Catering Prasmanan / Foto & Video / MC / Live Band
            $table->decimal('harga_layanan', 12, 2); // Menyimpan harga add-on saat dipilih
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_addons');
    }
};