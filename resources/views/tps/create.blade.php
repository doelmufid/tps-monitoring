@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-3xl">

        <div class="rounded-xl border border-jungle-green-100 bg-white shadow-theme-sm px-8 py-8">

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800">
                    Tambah Data TPS
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan lokasi Tempat Pembuangan Sampah
                </p>
            </div>

            <form action="{{ route('tps.store') }}" method="POST">
                @csrf

                {{-- Device ID --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Device ID
                    </label>
                    <input type="text" name="device_id" required
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Nama TPS --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama TPS
                    </label>
                    <input type="text" name="nama_tps" required
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Lokasi --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lokasi
                    </label>
                    <input type="text" name="lokasi" required
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- MAP --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Titik Lokasi di Peta
                    </label>
                    <div id="map" class="h-80 rounded-lg border border-gray-300"></div>
                </div>

                {{-- Latitude --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Latitude
                    </label>
                    <input type="text" id="latitude" name="latitude"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Longitude --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Longitude
                    </label>
                    <input type="text" id="longitude" name="longitude"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Tinggi Kontainer --}}
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tinggi Kontainer (cm)
                    </label>
                    <input type="number" name="tinggi_kontainer" required
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="h-10 px-6 rounded-lg bg-jungle-green-600
                    text-white text-sm font-medium
                    hover:bg-jungle-green-700 transition shadow-sm">
                        Simpan
                    </button>

                    <a href="{{ route('tps.index') }}"
                        class="h-10 px-6 rounded-lg border border-gray-300
                    text-gray-700 text-sm font-medium
                    hover:bg-gray-100 transition flex items-center">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Default: Majalengka
            const map = L.map('map').setView([-6.836, 108.227], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker;

            map.on('click', function(e) {

                const lat = e.latlng.lat.toFixed(7);
                const lng = e.latlng.lng.toFixed(7);

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
            });
        });
    </script>
@endsection
