@extends('layouts.app')

@section('content')
    <x-dashboard.stat-cards :totalTPS="$totalTPS" :tpsAktif="$tpsAktif" :rataRata="$rataRata" :tpsTerpadat="$tpsTerpadat" :trend="$trend"/>

    <form method="GET" class="mt-6 mb-6">
        <div class="flex flex-wrap items-end gap-4">

            {{-- TPS --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    TPS
                </label>
                <select name="tps_id"
                    class="h-10 rounded-lg border-gray-300 text-sm
                       focus:border-jungle-green-500
                       focus:ring-jungle-green-500">
                    <option value="">Semua TPS</option>
                    @foreach ($listTPS as $tps)
                        <option value="{{ $tps->id }}" {{ request('tps_id') == $tps->id ? 'selected' : '' }}>
                            {{ $tps->nama_tps }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Mulai --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Dari Tanggal
                </label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="h-10 rounded-lg border-gray-300 text-sm
                       focus:border-jungle-green-500
                       focus:ring-jungle-green-500">
            </div>

            {{-- Tanggal Akhir --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Sampai Tanggal
                </label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="h-10 rounded-lg border-gray-300 text-sm
                       focus:border-jungle-green-500
                       focus:ring-jungle-green-500">
            </div>

            {{-- Tombol --}}
            <div class="flex gap-2">

                <button type="submit"
                    class="h-10 px-5 rounded-lg bg-jungle-green-600
                       text-white text-sm font-medium
                       hover:bg-jungle-green-700
                       transition shadow-sm">
                    Terapkan
                </button>

                <a href="{{ route('dashboard') }}"
                    class="h-10 px-5 rounded-lg border border-jungle-green-600
                      text-jungle-green-600 text-sm font-medium
                      hover:bg-jungle-green-50
                      transition flex items-center">
                    Reset
                </a>

            </div>

        </div>
    </form>



    <div class="mt-6">
        <x-dashboard.kapasitas-chart :labels="$labels" :series="$series" />
    </div>

    {{-- MAP TPS --}}
    <div class="mt-6">
        <div class="rounded-xl border border-gray-200 bg-white shadow-theme-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-6 py-4">
                <h3 class="text-base font-semibold text-gray-800">
                    Peta Lokasi TPS
                </h3>
                <p class="text-sm text-gray-500">
                    Lokasi TPS berdasarkan koordinat yang tersimpan
                </p>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div id="map" class="h-[450px] rounded-lg"></div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const map = L.map('map').setView([-6.8361, 108.2272], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                const tpsData = @json($tpsMap);

                if (!tpsData.length) return;

                const markers = [];

                tpsData.forEach(tps => {

                    if (tps.latitude && tps.longitude) {

                        const lat = parseFloat(tps.latitude);
                        const lng = parseFloat(tps.longitude);

                        const marker = L.marker([lat, lng])
                            .addTo(map)
                            .bindPopup(`
    <strong>${tps.nama_tps}</strong><br>
    ${tps.lokasi}<br>
    <span style="color:#16a34a;font-weight:600;">
        Kapasitas: ${tps.last_persen ?? '-'}%
    </span>
                `);

                        markers.push(marker);
                    }
                });

                if (markers.length) {
                    const group = L.featureGroup(markers);
                    map.fitBounds(group.getBounds().pad(0.2));
                }

            });
        </script>
    @endpush
@endsection
