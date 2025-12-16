<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            // NOTE: renameColumn requires doctrine/dbal on some drivers.
            // If you get an error, run: composer require doctrine/dbal
            if (Schema::hasColumn('tanggungan', 'nama_alat') && ! Schema::hasColumn('tanggungan', 'judul_buku')) {
                $table->renameColumn('nama_alat', 'judul_buku');
            }
        });
    }

    public function down()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            if (Schema::hasColumn('tanggungan', 'judul_buku') && ! Schema::hasColumn('tanggungan', 'nama_alat')) {
                $table->renameColumn('judul_buku', 'nama_alat');
            }
        });
    }
};
