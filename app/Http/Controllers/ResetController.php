<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPengangkutan;
use App\Models\TPS;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function store(Request $request)
    {
        $tps = TPS::where('device_id', $request->device_id)->firstOrFail();

        RiwayatPengangkutan::create([
            'tps_id' => $tps->id,
            'waktu_pengangkutan' => now(),
            'keterangan' => 'Reset oleh petugas',
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Riwayat pengangkutan dicatat'
        ]);
    }
}
