<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    protected $guarded = ['id'];

    // Relasi: Satu template bisa memiliki banyak pengajuan dari mahasiswa
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}