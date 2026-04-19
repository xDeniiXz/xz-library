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
        Schema::table('buku', function (Blueprint $table) {
            $table->index('judul');
            $table->index('isbn');
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->index('status');
            $table->index('tanggal_pinjam');
            $table->index('tanggal_kembali');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropIndex(['judul']);
            $table->dropIndex(['isbn']);
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['tanggal_pinjam']);
            $table->dropIndex(['tanggal_kembali']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });
    }
};
