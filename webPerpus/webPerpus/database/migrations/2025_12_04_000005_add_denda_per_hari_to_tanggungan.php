<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            if (! Schema::hasColumn('tanggungan', 'hari_keterlambatan')) {
                $table->integer('hari_keterlambatan')->default(0)->after('durasi_peminjaman');
            }
        });
    }

    public function down()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            if (Schema::hasColumn('tanggungan', 'hari_keterlambatan')) {
                $table->dropColumn('hari_keterlambatan');
            }
        });
    }
};
