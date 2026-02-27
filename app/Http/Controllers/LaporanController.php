<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorReading;
use App\Models\RiwayatPengangkutan;
use App\Exports\LaporanExport;
use App\Models\TPS;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tps_id = $request->tps_id;
        $start = $request->start_date;
        $end = $request->end_date;

        // Ambil daftar TPS untuk dropdown
        $daftarTPS = TPS::all();

        // ===================== 
        // =====================
        $kapasitas = SensorReading::with('tps');

        if ($tps_id) {
            $kapasitas->where('tps_id', $tps_id);
        }

        if ($start && $end) {
            $kapasitas->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        $kapasitas = $kapasitas->latest()->paginate(10)->withQueryString();

        // =====================
        // FILTER PENGANGKUTAN
        // =====================
        $pengangkutan = RiwayatPengangkutan::with('tps');

        if ($tps_id) {
            $pengangkutan->where('tps_id', $tps_id);
        }

        if ($start && $end) {
            $pengangkutan->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        $pengangkutan = $pengangkutan->latest()->paginate(10, ['*'], 'pengangkutan_page')->withQueryString();

        return view('laporan.index', compact(
            'kapasitas',
            'pengangkutan',
            'daftarTPS'
        ));
    }

    public function export(Request $request)
    {
        return Excel::download(
            new LaporanExport($request),
            'laporan_tps_' . now()->format('Ymd_His') . '.xlsx'
        );
    }
}
