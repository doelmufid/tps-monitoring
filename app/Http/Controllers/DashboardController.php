<?php

namespace App\Http\Controllers;

use App\Models\TPS;
use App\Models\SensorReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $listTPS = TPS::orderBy('nama_tps')->get();

        $tps_id = $request->tps_id;
        $start = $request->start_date;
        $end = $request->end_date;

        // BASE QUERY SENSOR
        $sensorQuery = SensorReading::with('tps');

        if ($tps_id) {
            $sensorQuery->where('tps_id', $tps_id);
        }

        if ($start && $end) {
            $sensorQuery->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        // STATISTIK
        $totalTPS = TPS::count();

        $tpsAktif = (clone $sensorQuery)
            ->distinct('tps_id')
            ->count('tps_id');

        $rataRata = (clone $sensorQuery)
            ->avg('persen');

        $tpsTerpadat = (clone $sensorQuery)
            ->orderByDesc('persen')
            ->first();

        // DATA GRAFIK
        $query = SensorReading::query();

        if ($tps_id) {
            $query->where('tps_id', $tps_id);
        }

        if ($start && $end) {
            $query->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        if ($tps_id) {

            // ===== SINGLE TPS =====
            $chartData = $query
                ->select(
                    DB::raw('DATE(created_at) as tanggal'),
                    DB::raw('AVG(persen) as rata_persen')
                )
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            $labels = $chartData->pluck('tanggal')->values();

            $series = [
                [
                    'name' => TPS::find($tps_id)->nama_tps ?? 'TPS',
                    'data' => $chartData->pluck('rata_persen')
                        ->map(fn($v) => (float) $v)
                        ->values()
                ]
            ];
        } else {

            // ===== MULTI TPS =====
            $chartData = $query
                ->select(
                    'tps_id',
                    DB::raw('DATE(created_at) as tanggal'),
                    DB::raw('AVG(persen) as rata_persen')
                )
                ->groupBy('tps_id', 'tanggal')
                ->orderBy('tanggal')
                ->get();

            $labels = $chartData
                ->pluck('tanggal')
                ->unique()
                ->values();

            $series = [];

            $grouped = $chartData->groupBy('tps_id');

            foreach ($grouped as $tpsId => $rows) {

                $tpsName = TPS::find($tpsId)->nama_tps ?? 'TPS';

                $dataPoints = [];

                foreach ($labels as $date) {
                    $row = $rows->firstWhere('tanggal', $date);
                    $dataPoints[] = $row ? (float) $row->rata_persen : null;
                }

                $series[] = [
                    'name' => $tpsName,
                    'data' => $dataPoints
                ];
            }
        }


        // HITUNG TREND RATA-RATA
        $trend = null;

        if ($start && $end) {

            $rangeDays = \Carbon\Carbon::parse($start)
                ->diffInDays(\Carbon\Carbon::parse($end)) + 1;

            $previousStart = \Carbon\Carbon::parse($start)->subDays($rangeDays);
            $previousEnd   = \Carbon\Carbon::parse($start)->subDay();

            $previousAvg = SensorReading::when($tps_id, function ($q) use ($tps_id) {
                $q->where('tps_id', $tps_id);
            })
                ->whereBetween('created_at', [
                    $previousStart . ' 00:00:00',
                    $previousEnd . ' 23:59:59'
                ])
                ->avg('persen');

            if ($previousAvg) {
                $trend = round((($rataRata - $previousAvg) / $previousAvg) * 100, 1);
            }
        }

        $tpsMap = TPS::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('dashboard', compact(
            'listTPS',
            'totalTPS',
            'tpsAktif',
            'rataRata',
            'tpsTerpadat',
            'labels',
            'series',
            'tpsMap',
            'trend'
        ));
    }
}
