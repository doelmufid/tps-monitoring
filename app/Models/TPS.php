<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPS extends Model
{
    use HasFactory;

    protected $table = 't_p_s';

    protected $fillable = [
        'device_id',
        'nama_tps',
        'lokasi',
        'tinggi_kontainer',
        'latitude',
        'longitude'
        
    ];

    public function sensorReadings()
    {
        return $this->hasMany(SensorReading::class, 'tps_id');
    }

    public function riwayatPengangkutans()
    {
        return $this->hasMany(RiwayatPengangkutan::class, 'tps_id');
    }
}
