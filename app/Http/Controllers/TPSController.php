<?php

namespace App\Http\Controllers;

use App\Models\SensorReading;
use App\Models\TPS;
use Illuminate\Http\Request;

class TPSController extends Controller
{
    // INDEX
    public function index()
    {
        $tps = TPS::all();
        return view('tps.index', compact('tps'));
    }

    // CREATE
    public function create()
    {
        return view('tps.create');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|string|max:255',
            'nama_tps' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tinggi_kontainer' => 'required|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        TPS::create($validated);

        return redirect()->route('tps.index')
            ->with('success', 'TPS berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $tps = TPS::findOrFail($id);
        return view('tps.edit', compact('tps'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $tps = TPS::findOrFail($id);

        $validated = $request->validate([
            'device_id' => 'required|string|max:255',
            'nama_tps' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tinggi_kontainer' => 'required|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $tps->update($validated);

        return redirect()->route('tps.index')
            ->with('success', 'TPS berhasil diperbarui');
    }

    // DESTROY
    public function destroy($id)
    {
        TPS::findOrFail($id)->delete();

        return redirect()->route('tps.index')
            ->with('success', 'TPS berhasil dihapus');
    }

    // SHOW (DETAIL + GRAFIK)
    public function show($id)
    {
        $tps = TPS::findOrFail($id);

        $lastReading = SensorReading::where('tps_id', $id)
            ->latest()
            ->first();

        $history = SensorReading::where('tps_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        $labels = $history->map(function ($item) {
            return $item->created_at->format('d M H:i');
        });

        $data = $history->pluck('persen');

        return view('tps.show', compact(
            'tps',
            'lastReading',
            'history',
            'labels',
            'data'
        ));
    }
}
