<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Contoh: "Formulir Cuti Akademik"
            $table->text('description')->nullable(); // Penjelasan singkat
            $table->string('file_path'); // Lokasi file master (PDF/Docx) di storage
            $table->boolean('is_active')->default(true); // Untuk menyembunyikan form jika sudah tidak berlaku
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};