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
        Schema::create('alat', function (Blueprint $table) {
$table->id('idalat');
            $table->foreignId('idkategori')->constrained('kategori', 'idkategori')->onDelete('cascade');
            $table->string('namaalat');
            $table->text('spesifikasi')->nullable();
            $table->string('gambaralat')->nullable();
            $table->integer('qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
