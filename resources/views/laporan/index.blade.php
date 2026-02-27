@extends('layouts.app')

@section('content')
    <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Laporan TPS
                </h2>
                <p class="text-sm text-gray-500">
                    Rekap data kapasitas dan pengangkutan
                </p>
            </div>

            {{-- EXPORT --}}
            <a href="{{ route('laporan.export', request()->query()) }}"
                class="rounded-lg bg-jungle-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-jungle-green-700 transition">
                Export Excel
            </a>
        </div>

        {{-- FILTER --}}
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <form method="GET">
                <div class="flex flex-wrap items-end gap-4">

                    {{-- TPS --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            TPS
                        </label>
                        <select name="tps_id"
                            class="h-10 rounded-lg border-gray-300 text-sm
                               focus:border-jungle-green-500
                               focus:ring-jungle-green-500">
                            <option value="">Semua TPS</option>
                            @foreach ($daftarTPS as $tps)
                                <option value="{{ $tps->id }}" {{ request('tps_id') == $tps->id ? 'selected' : '' }}>
                                    {{ $tps->nama_tps }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- START --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Dari Tanggal
                        </label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="h-10 rounded-lg border-gray-300 text-sm
                                  focus:border-jungle-green-500
                                  focus:ring-jungle-green-500">
                    </div>

                    {{-- END --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Sampai Tanggal
                        </label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="h-10 rounded-lg border-gray-300 text-sm
                                  focus:border-jungle-green-500
                                  focus:ring-jungle-green-500">
                    </div>

                    {{-- BUTTON --}}
                    <div class="flex gap-2">
                        <button type="submit"
                            class="h-10 px-5 rounded-lg bg-jungle-green-600
                               text-white text-sm font-medium
                               hover:bg-jungle-green-700 transition">
                            Terapkan
                        </button>

                        <a href="{{ route('laporan.index') }}"
                            class="h-10 px-5 rounded-lg border border-jungle-green-600
                               text-jungle-green-600 text-sm font-medium
                               hover:bg-jungle-green-50 transition flex items-center">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        {{-- KAPASITAS --}}
        <div class="px-6 py-6">

            <h3 class="text-sm font-semibold text-gray-700 mb-4">
                Data Kapasitas
            </h3>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm">

                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                        <tr>
                            <th class="px-6 py-3 text-left">TPS</th>
                            <th class="px-6 py-3 text-left">Kapasitas (%)</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($kapasitas as $item)
                            <tr class="hover:bg-jungle-green-50 transition">
                                <td class="px-6 py-3 font-medium text-gray-800">
                                    {{ $item->tps->nama_tps ?? '-' }}
                                </td>
                                <td class="px-6 py-3 text-gray-700">
                                    {{ $item->persen }}%
                                </td>
                                <td class="px-6 py-3 text-gray-600">
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-gray-400">
                                    Tidak ada data kapasitas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $kapasitas->links() }}
                </div>
            </div>
        </div>

        {{-- PENGANGKUTAN --}}
        <div class="px-6 pb-6">

            <h3 class="text-sm font-semibold text-gray-700 mb-4">
                Data Pengangkutan
            </h3>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm">

                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                        <tr>
                            <th class="px-6 py-3 text-left">TPS</th>
                            <th class="px-6 py-3 text-left">Waktu Pengangkutan</th>
                            <th class="px-6 py-3 text-left">Petugas</th>
                            <th class="px-6 py-3 text-left">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pengangkutan as $item)
                            <tr class="hover:bg-jungle-green-50 transition">
                                <td class="px-6 py-3 font-medium text-gray-800">
                                    {{ $item->tps->nama_tps ?? '-' }}
                                </td>
                                <td class="px-6 py-3 text-gray-700">
                                    {{ $item->waktu_pengangkutan }}
                                </td>
                                <td class="px-6 py-3 text-gray-700">
                                    {{ $item->petugas ?? '-' }}
                                </td>
                                <td class="px-6 py-3 text-gray-600">
                                    {{ $item->keterangan ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-400">
                                    Tidak ada data pengangkutan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $pengangkutan->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
