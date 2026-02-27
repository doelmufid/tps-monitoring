<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'tps_id',
        'jarak',
        'persen'
    ];

    // RELASI KE TPS
    public function tps()
    {
        return $this->belongsTo(TPS::class, 'tps_id');
    }
}
