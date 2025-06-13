<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boarding_house_id')->constrained()->cascadeOnDelete();
            $table->string('room_number');
            $table->string('price');
            $table->string('size');
            $table->enum('status', [
                'available',    // Tersedia untuk disewa
                'booked',       // Sedang dipesan (tapi belum ditempati)
                'occupied',     // Sudah ditempati
                'unavailable',  // Tidak bisa disewa (perawatan, rusak, dll)
            ])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
