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
    Schema::create('pinjaman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anggota_id')
              ->constrained('anggotas')
              ->cascadeOnDelete();
        $table->decimal('jumlah_pengajuan', 15, 2);
        $table->decimal('jumlah_disetujui', 15, 2)->nullable();
        $table->decimal('bunga_persen', 5, 2)->default(0);
        $table->integer('tenor_bulan');
        $table->string('status', 30)->default('pengajuan');
        $table->foreignId('approved_by')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
