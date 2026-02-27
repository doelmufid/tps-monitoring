<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SensorReading;
use App\Models\TPS;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
            'jarak' => 'required',
            'persen' => 'required'
        ]);

        $tps = TPS::where('device_id', $request->device_id)->first();

        if (!$tps) {
            return response()->json([
                'message' => 'Device ID tidak terdaftar'
            ], 404);
        }

        SensorReading::create([
            'tps_id' => $tps->id,
            'jarak' => $request->jarak,
            'persen' => $request->persen
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ], 200);
    }
}
