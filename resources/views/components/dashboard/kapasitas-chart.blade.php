@props(['labels' => [], 'series' => []])

<div class="group rounded-xl border border-gray-200 bg-white shadow-theme-sm">

    <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
        <div>
            <h3 class="text-base font-semibold text-gray-800">
                Grafik Kapasitas TPS
            </h3>
            <p class="text-sm text-gray-500">
                Rata-rata kapasitas per TPS
            </p>
        </div>
    </div>

    <div class="px-6 py-4">
        <div id="kapasitasChart" class="h-[320px]"></div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const options = {
        chart: {
            type: 'area',
            height: 300,
            toolbar: { show: false }
        },

        series: @json($series),

        xaxis: {
            categories: @json($labels)
        },

        stroke: {
            curve: 'smooth',
            width: 3
        },

        dataLabels: { enabled: false },

        grid: {
            borderColor: '#e5e7eb',
            strokeDashArray: 4
        },

        tooltip: {
            y: {
                formatter: val => val + '%'
            }
        }
    };

    const chart = new ApexCharts(
        document.querySelector("#kapasitasChart"),
        options
    );

    chart.render();
});
</script>
@endpush