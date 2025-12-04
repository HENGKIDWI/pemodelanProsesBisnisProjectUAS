<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            // Tambahkan kolom tanggal_peminjaman setelah nominal_denda
            if (! Schema::hasColumn('tanggungan', 'tanggal_peminjaman')) {
                $table->date('tanggal_peminjaman')->nullable()->after('nominal_denda');
            }

            // Hapus kolom deskripsi_denda bila ada
            if (Schema::hasColumn('tanggungan', 'deskripsi_denda')) {
                $table->dropColumn('deskripsi_denda');
            }
        });
    }

    public function down()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            if (Schema::hasColumn('tanggungan', 'tanggal_peminjaman')) {
                $table->dropColumn('tanggal_peminjaman');
            }
            if (! Schema::hasColumn('tanggungan', 'deskripsi_denda')) {
                $table->text('deskripsi_denda')->nullable()->after('nominal_denda');
            }
        });
    }
};
