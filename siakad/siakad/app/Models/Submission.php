<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = ['id'];

    // Relasi: Pengajuan milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Pengajuan merujuk pada satu Template dokumen
    public function documentTemplate()
    {
        return $this->belongsTo(DocumentTemplate::class);
    }
}