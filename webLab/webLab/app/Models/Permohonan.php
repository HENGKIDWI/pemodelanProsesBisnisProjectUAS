<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $table = 'permohonan';
    protected $fillable = ['user_id', 'status', 'bukti_pembayaran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
