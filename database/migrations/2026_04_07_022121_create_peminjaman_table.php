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
        Schema::create('peminjaman', function (Blueprint $table) {
$table->id('idpinjam');
            $table->date('tglpinjam');
            $table->date('tglkembali')->nullable();
            $table->foreignId('idalat')->constrained('alat', 'idalat')->onDelete('cascade');
            $table->integer('qty');
            $table->foreignId('iduser')->constrained('users', 'id')->onDelete('cascade');
            $table->text('kondisiakhir')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'dipinjam', 'dikembalikan'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
