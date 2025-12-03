<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Mahasiswa)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relasi ke Template (Jenis Dokumen apa yang diupload)
            $table->foreignId('document_template_id')->constrained()->onDelete('cascade');
            
            // File yang diupload mahasiswa (yang sudah diisi & ditandatangani)
            $table->string('submitted_file_path'); 
            $table->string('submitted_file_2')->nullable();
            
            // Status pengajuan (Penting untuk dashboard admin nanti)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // Catatan dari admin (jika ditolak/revisi)
            $table->text('admin_note')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};