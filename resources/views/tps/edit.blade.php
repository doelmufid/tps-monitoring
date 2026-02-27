@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-3xl">

        <div class="rounded-xl border border-jungle-green-100 bg-white shadow-theme-sm px-8 py-8">

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800">
                    Edit Data TPS
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi Tempat Pembuangan Sampah
                </p>
            </div>

            <form action="{{ route('tps.update', $tps->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Device ID --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Device ID
                    </label>
                    <input type="text" name="device_id" value="{{ old('device_id', $tps->device_id) }}"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Nama TPS --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama TPS
                    </label>
                    <input type="text" name="nama_tps" value="{{ old('nama_tps', $tps->nama_tps) }}"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Lokasi --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lokasi
                    </label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $tps->lokasi) }}"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- MAP --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pindahkan Titik Lokasi di Peta
                    </label>
                    <div id="map" class="h-80 rounded-lg border border-gray-300"></div>
                </div>

                {{-- Latitude --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Latitude
                    </label>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $tps->latitude) }}"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Longitude --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Longitude
                    </label>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $tps->longitude) }}"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                {{-- Tinggi --}}
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tinggi Kontainer (cm)
                    </label>
                    <input type="number" name="tinggi_kontainer"
                        value="{{ old('tinggi_kontainer', $tps->tinggi_kontainer) }}"
                        class="w-full h-11 rounded-lg border border-gray-300 text-sm
                    focus:border-jungle-green-500 focus:ring-jungle-green-500">
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="h-10 px-6 rounded-lg bg-jungle-green-600
                    text-white text-sm font-medium
                    hover:bg-jungle-green-700 transition shadow-sm">
                        Update
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const lat = {{ $tps->latitude ?? -6.836 }};
            const lng = {{ $tps->longitude ?? 108.227 }};

            const map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([lat, lng]).addTo(map);

            map.on('click', function(e) {

                const newLat = e.latlng.lat.toFixed(7);
                const newLng = e.latlng.lng.toFixed(7);

                document.getElementById('latitude').value = newLat;
                document.getElementById('longitude').value = newLng;

                marker.setLatLng(e.latlng);
            });
        });
    </script>
@endsection
