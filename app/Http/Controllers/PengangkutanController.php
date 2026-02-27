<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengangkutan;
use App\Models\TPS;
use Illuminate\Http\Request;

class PengangkutanController extends Controller
{
    public function index(Request $request)
    {
        $tpsList = TPS::all();

        $query = RiwayatPengangkutan::with('tps')
            ->orderBy('waktu_pengangkutan', 'desc');

        if ($request->tps_id) {
            $query->where('tps_id', $request->tps_id);
        }

        $data = $query->paginate(10)->withQueryString();

        return view('pengangkutan.index', compact('data', 'tpsList'));
    }

    public function destroy($id)
    {
        $data = \App\Models\RiwayatPengangkutan::findOrFail($id);
        $data->delete();

        return redirect()->route('pengangkutan.index')
            ->with('success', 'Data pengangkutan berhasil dihapus');
    }
}
