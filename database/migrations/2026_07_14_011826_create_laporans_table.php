<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('laporans', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->foreignId('lokasi_id')->constrained('lokasis')->cascadeOnDelete();

        $table->foreignId('kategori_kerusakan_id')
              ->constrained('kategori_kerusakans')
              ->cascadeOnDelete();

        $table->string('judul');

        $table->text('deskripsi');

        $table->string('foto')->nullable();

        $table->enum('status', [
            'Menunggu',
            'Diproses',
            'Selesai'
        ])->default('Menunggu');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
