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
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users sebagai pasien
            $table->foreignId('id_pasien')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Relasi ke tabel users sebagai dokter
            $table->foreignId('id_dokter')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Tanggal & waktu pemeriksaan
            $table->timestamp('tgl_periksa')->nullable(false); // tidak boleh null

            // Optional data
            $table->string('catatan')->nullable();
            $table->integer('biaya_periksa')->nullable();

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksas');
    }
};
