<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengangkutan extends Model
{
    protected $fillable = [
        'tps_id',
        'waktu_pengangkutan',
        'keterangan',
    ];

    public function tps()
    {
        return $this->belongsTo(TPS::class, 'tps_id');
    }
}
