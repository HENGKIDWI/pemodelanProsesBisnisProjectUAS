<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggungan extends Model
{
    protected $table = 'tanggungan';
    protected $fillable = [
        'user_id', 'nama_alat', 'nominal_denda', 'is_paid', 'deskripsi_denda', 
        'bukti_pembayaran', 'is_verifying' 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
