@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-4xl">

        <div class="rounded-xl border border-jungle-green-100 bg-white shadow-theme-sm px-8 py-8">

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800">
                    Detail TPS
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi dan histori kapasitas TPS
                </p>
            </div>

            {{-- Informasi TPS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-5 text-sm">

                <div>
                    <p class="text-gray-500">Nama TPS</p>
                    <p class="font-medium text-gray-800 mt-1">
                        {{ $tps->nama_tps }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Lokasi</p>
                    <p class="font-medium text-gray-800 mt-1">
                        {{ $tps->lokasi }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Device ID</p>
                    <p class="font-medium text-gray-800 mt-1">
                        {{ $tps->device_id }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tinggi Kontainer</p>
                    <p class="font-medium text-gray-800 mt-1">
                        {{ $tps->tinggi_kontainer }} cm
                    </p>
                </div>

            </div>

            {{-- Status Terakhir --}}
            <div class="mt-8 rounded-lg bg-jungle-green-50 border border-jungle-green-100 p-5">

                <h3 class="text-sm font-semibold text-jungle-green-700 mb-3">
                    Status Terakhir
                </h3>

                @if ($lastReading)
                    <div class="flex flex-wrap items-center gap-6 text-sm">

                        <div>
                            <p class="text-gray-500">Kapasitas</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $lastReading->persen }}%
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Update Terakhir</p>
                            <p class="font-medium text-gray-800">
                                {{ $lastReading->created_at->format('d M Y H:i') }}
                            </p>
                        </div>

                    </div>
                @else
                    <p class="text-gray-500 text-sm">
                        Belum ada data sensor.
                    </p>
                @endif

            </div>

            {{-- Grafik --}}
            <div class="mt-10">

                <h3 class="text-sm font-semibold text-gray-800 mb-4">
                    Grafik Histori Kapasitas
                </h3>

                <div class="rounded-xl border border-gray-200 p-6">
                    <div id="historyChart" class="h-[320px]"></div>
                </div>

            </div>

            {{-- Action --}}
            <div class="mt-10 flex">
                <a href="{{ route('tps.index') }}"
                    class="h-10 px-6 rounded-lg border border-gray-300
                      text-gray-700 text-sm font-medium
                      hover:bg-gray-100
                      transition flex items-center">
                    Kembali
                </a>
            </div>

        </div>

    </div>

    {{-- Script --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const labels = @json($labels ?? []);
                const data = @json($data ?? []);

                if (!labels.length || !data.length) return;

                const options = {
                    chart: {
                        type: 'area',
                        height: 320,
                        toolbar: {
                            show: false
                        }
                    },

                    series: [{
                        name: 'Kapasitas',
                        data: data
                    }],

                    xaxis: {
                        categories: labels,
                        labels: {
                            style: {
                                colors: '#667085',
                                fontSize: '12px'
                            }
                        }
                    },

                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },

                    colors: ['#34a885'], // jungle 500

                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.35,
                            opacityTo: 0.05
                        }
                    },

                    dataLabels: {
                        enabled: false
                    },

                    grid: {
                        borderColor: '#E5E7EB',
                        strokeDashArray: 4
                    },

                    tooltip: {
                        y: {
                            formatter: val => val + '%'
                        }
                    }
                };

                const chart = new ApexCharts(
                    document.querySelector('#historyChart'),
                    options
                );

                chart.render();

            });
        </script>
    @endpush
@endsection
