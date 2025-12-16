<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggungan extends Model
{
    protected $table = 'tanggungan';
    protected $fillable = [
        'user_id', 'judul_buku', 'nominal_denda', 'is_paid', 'tanggal_peminjaman', 
        'durasi_peminjaman', 'bukti_pembayaran', 'is_verifying' 
    ];
    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'durasi_peminjaman' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
