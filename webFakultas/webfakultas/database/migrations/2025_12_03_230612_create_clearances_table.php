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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 3 File Syarat dari Mahasiswa
            $table->string('file_lab');
            $table->string('file_library');
            $table->string('file_finance');

            // 1 File Output dari Admin (Surat FY-04)
            $table->string('official_letter')->nullable();


            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('expired_at')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
