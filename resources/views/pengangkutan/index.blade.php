@extends('layouts.app')

@section('content')
    <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">
                Riwayat Pengangkutan
            </h2>
            <p class="text-sm text-gray-500">
                Data histori pengangkutan sampah TPS
            </p>
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
                            @foreach ($tpsList as $tps)
                                <option value="{{ $tps->id }}" {{ request('tps_id') == $tps->id ? 'selected' : '' }}>
                                    {{ $tps->nama_tps }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dari --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Dari Tanggal
                        </label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="h-10 rounded-lg border-gray-300 text-sm
                                  focus:border-jungle-green-500
                                  focus:ring-jungle-green-500">
                    </div>

                    {{-- Sampai --}}
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

                        <a href="{{ route('pengangkutan.index') }}"
                            class="h-10 px-5 rounded-lg border border-jungle-green-600
                               text-jungle-green-600 text-sm font-medium
                               hover:bg-jungle-green-50 transition flex items-center">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                {{-- HEAD --}}
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">TPS</th>
                        <th class="px-6 py-3 text-left">Waktu Pengangkutan</th>
                        <th class="px-6 py-3 text-left">Petugas</th>
                        <th class="px-6 py-3 text-left">Keterangan</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse ($data as $item)
                        <tr class="hover:bg-jungle-green-50 transition">

                            <td class="px-6 py-3 text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-3 font-medium text-gray-800">
                                {{ $item->tps->nama_tps ?? '-' }}
                            </td>

                            <td class="px-6 py-3 text-gray-600">
                                {{ \Carbon\Carbon::parse($item->waktu_pengangkutan)->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                {{ $item->petugas ?? '-' }}
                            </td>

                            <td class="px-6 py-3 text-gray-600">
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td class="px-6 py-3 text-center">
                                <form action="{{ route('pengangkutan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-md bg-red-50 px-3 py-1.5
                   text-xs font-medium text-red-600
                   hover:bg-red-100 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-400">
                                Tidak ada data pengangkutan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if (method_exists($data, 'links'))
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $data->withQueryString()->links() }}
            </div>
        @endif

    </div>
@endsection
