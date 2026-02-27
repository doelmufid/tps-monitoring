<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TPS;

class TPSController extends Controller
{
    public function config($device_id)
    {
        $tps = TPS::where('device_id', $device_id)->first();

        if (!$tps) {
            return response()->json([
                'message' => 'Device tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'tinggi_kontainer' => $tps->tinggi_kontainer
        ]);
    }
}
