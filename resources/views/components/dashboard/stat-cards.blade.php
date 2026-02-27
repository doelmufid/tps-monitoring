@props(['totalTPS', 'tpsAktif', 'rataRata', 'tpsTerpadat', 'trend' => null])

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

    {{-- Total TPS --}}
    <div
        class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div
            class="absolute -top-10 -right-10 h-32 w-32 rounded-full bg-jungle-green-100 opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-60">
        </div>

        <div class="relative flex items-start justify-between">
            <div>
                <p class="text-sm text-gray-500">Total TPS</p>
                <h4 class="mt-3 text-3xl font-semibold text-gray-800 tracking-tight">
                    {{ $totalTPS }}
                </h4>
            </div>

            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-jungle-green-50 transition-all duration-300 group-hover:scale-110">
                <svg class="h-6 w-6 text-jungle-green-600" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 01.553-.894L9 2m0 18l6-3m-6 3V2m6 15l5.447-2.724A1 1 0 0021 13.382V2.618a1 1 0 00-.553-.894L15 0m0 18V3" />
                </svg>
            </div>
        </div>
    </div>

    {{-- TPS Aktif --}}
    <div
        class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div
            class="absolute -top-10 -right-10 h-32 w-32 rounded-full bg-sky-100 opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-60">
        </div>

        <div class="relative flex items-start justify-between">
            <div>
                <p class="text-sm text-gray-500">TPS Aktif</p>
                <h4 class="mt-3 text-3xl font-semibold text-gray-800 tracking-tight">
                    {{ $tpsAktif }}
                </h4>
            </div>

            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 transition-all duration-300 group-hover:scale-110">
                <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Rata-rata Kapasitas --}}
    <div
        class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div
            class="absolute -top-10 -right-10 h-32 w-32 rounded-full bg-amber-100 opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-60">
        </div>

        <div class="relative flex items-start justify-between">
            <div>
                <p class="text-sm text-gray-500">Rata-rata Kapasitas</p>
                <h4 class="mt-3 text-3xl font-semibold text-gray-800 tracking-tight">
                    {{ round($rataRata ?? 0) }}%
                </h4>

                @if (!is_null($trend))
                    <div
                        class="mt-2 flex items-center gap-1 text-xs font-medium opacity-90
        {{ $trend > 0 ? 'text-rose-600' : ($trend < 0 ? 'text-emerald-600' : 'text-gray-500') }}">

                        @if ($trend > 0)
                            {{-- Naik --}}
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                            </svg>
                        @elseif ($trend < 0)
                            {{-- Turun --}}
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif

                        <span>{{ abs($trend) }}%</span>
                        <span class="text-gray-400 font-normal">dibanding periode sebelumnya</span>
                    </div>
                @endif

            </div>

            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 transition-all duration-300 group-hover:scale-110">
                <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15v-4m4 4V7m4 8v-6" />
                </svg>
            </div>
        </div>
    </div>

    {{-- TPS Terpadat --}}
    <div
        class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div
            class="absolute -top-10 -right-10 h-32 w-32 rounded-full bg-rose-100 opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-60">
        </div>

        <div class="relative flex items-start justify-between">
            <div>
                <p class="text-sm text-gray-500">TPS Terpadat</p>

                @if ($tpsTerpadat)
                    <p class="mt-2 text-sm text-gray-500">
                        {{ $tpsTerpadat->tps->nama_tps }}
                    </p>
                    <h4 class="mt-1 text-3xl font-semibold text-gray-800 tracking-tight">
                        {{ $tpsTerpadat->persen }}%
                    </h4>
                @else
                    <h4 class="mt-3 text-3xl font-semibold text-gray-400">-</h4>
                @endif
            </div>

            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 transition-all duration-300 group-hover:scale-110">
                <svg class="h-6 w-6 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3c2 3-1 5-1 7a3 3 0 006 0c0-2-2-4-5-7zM12 21a6 6 0 006-6c0-3-2-5-4-7" />
                </svg>
            </div>
        </div>
    </div>

</div>
