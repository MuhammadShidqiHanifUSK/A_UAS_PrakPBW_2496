<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('manzil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setoran_id')->constrained('setoran')->onDelete('cascade');
            $table->foreignId('surah_id')->constrained('surahs')->onDelete('cascade');
            $table->integer('ayat_mulai');
            $table->integer('ayat_selesai');
            $table->integer('jumlah_halaman');
            $table->enum('nilai', ['L', 'KL', 'U']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manzil');
    }
};
