<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorReading;
use App\Models\TPS;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $tpsList = TPS::all();

        $query = SensorReading::with('tps')
            ->orderBy('created_at', 'desc');

        // FILTER TPS JIKA DIPILIH
        if ($request->tps_id) {
            $query->where('tps_id', $request->tps_id);
        }

        $riwayat = $query->paginate(10)->withQueryString();

        return view('riwayat.index', compact('riwayat', 'tpsList'));
    }

    public function destroy($id)
    {
        $data = \App\Models\SensorReading::findOrFail($id);
        $data->delete();

        return redirect()->route('riwayat.index')
            ->with('success', 'Data riwayat berhasil dihapus');
    }
}
