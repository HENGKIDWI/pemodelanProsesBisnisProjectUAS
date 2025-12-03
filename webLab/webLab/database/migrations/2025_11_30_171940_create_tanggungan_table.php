<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tanggungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_alat');
            $table->text('deskripsi_denda');
            $table->decimal('nominal_denda', 10, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->boolean('is_paid')->default(false); // false = belum lunas
            $table->boolean('is_verifying')->default(false); // false = belum diverifikasi  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggungan');
    }
};
