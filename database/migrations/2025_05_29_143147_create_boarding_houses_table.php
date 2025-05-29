<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 'name',
     * 'location_map',
     * 'address',
     * 'owner_id',
     * 'thumbnail',
     * 'category_id',
     */
    public function up(): void
    {
        Schema::create('boarding_houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location_map');
            $table->string('address');
            $table->string('thumbnail');
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
};
