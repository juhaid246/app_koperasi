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
        Schema::create('angsuran', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pinjaman_id')->constrained('pinjaman')->cascadeOnDelete();
    $table->integer('angsuran_ke');
    $table->date('jatuh_tempo')->nullable();
    $table->decimal('jumlah_tagihan', 15, 2); // Presisi nominal rupiah sesuai modul
    $table->decimal('jumlah_bayar', 15, 2);   // Presisi nominal rupiah sesuai modul
    $table->date('tanggal_bayar');
    $table->string('status', 30)->default('lunas');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
