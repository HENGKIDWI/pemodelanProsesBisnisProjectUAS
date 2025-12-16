<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            if (! Schema::hasColumn('tanggungan', 'durasi_peminjaman')) {
                $table->integer('durasi_peminjaman')->nullable()->after('tanggal_peminjaman');
            }
        });
    }

    public function down()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            if (Schema::hasColumn('tanggungan', 'durasi_peminjaman')) {
                $table->dropColumn('durasi_peminjaman');
            }
        });
    }
};
