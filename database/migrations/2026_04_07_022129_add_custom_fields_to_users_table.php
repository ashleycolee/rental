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
        Schema::table('users', function (Blueprint $table) {
            // $table->string('name')->nullable()->after('id');
            $table->string('username')->unique()->after('name');
            $table->string('namalengkap')->after('username');
            $table->string('identitas')->nullable()->after('namalengkap');
            $table->string('nohp')->nullable()->after('identitas');
            $table->enum('role', ['admin', 'user', 'petugas'])->default('user')->after('nohp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
