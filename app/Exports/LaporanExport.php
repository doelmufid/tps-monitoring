<?php

namespace App\Exports;

use App\Models\SensorReading;
use App\Models\RiwayatPengangkutan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromArray, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function array(): array
    {
        $data = [];

        $tps_id = $this->request->tps_id;
        $start = $this->request->start_date;
        $end = $this->request->end_date;

        // =====================
        // RIWAYAT KAPASITAS
        // =====================
        $kapasitas = SensorReading::with('tps');

        if ($tps_id) {
            $kapasitas->where('tps_id', $tps_id);
        }

        if ($start && $end) {
            $kapasitas->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        foreach ($kapasitas->get() as $item) {
            $data[] = [
                $item->tps->nama_tps,
                'Kapasitas',
                $item->persen . '%',
                $item->created_at,
            ];
        }

        // =====================
        // RIWAYAT PENGANGKUTAN
        // =====================
        $pengangkutan = RiwayatPengangkutan::with('tps');

        if ($tps_id) {
            $pengangkutan->where('tps_id', $tps_id);
        }

        if ($start && $end) {
            $pengangkutan->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        foreach ($pengangkutan->get() as $item) {
            $data[] = [
                $item->tps->nama_tps,
                'Pengangkutan',
                'Sampah diangkut',
                $item->created_at,
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama TPS',
            'Jenis Data',
            'Keterangan',
            'Waktu',
        ];
    }
}
