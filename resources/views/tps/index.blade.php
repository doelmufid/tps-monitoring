@extends('layouts.app')

@section('content')
    <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Data TPS
                </h2>
                <p class="text-sm text-gray-500">
                    Daftar Tempat Pembuangan Sampah
                </p>
            </div>

            <a href="{{ route('tps.create') }}"
                class="rounded-lg bg-jungle-green-600 px-4 py-2 text-sm font-medium text-white
                  hover:bg-jungle-green-700 transition shadow-sm">
                + Tambah TPS
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- Table Head --}}
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Device ID</th>
                        <th class="px-6 py-3 text-left">Nama TPS</th>
                        <th class="px-6 py-3 text-left">Lokasi</th>
                        <th class="px-6 py-3 text-left">Tinggi (cm)</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse ($tps as $item)
                        <tr class="hover:bg-jungle-green-50 transition">

                            <td class="px-6 py-3 text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-3 font-medium text-gray-800">
                                {{ $item->device_id }}
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                {{ $item->nama_tps }}
                            </td>

                            <td class="px-6 py-3 text-gray-600">
                                {{ $item->lokasi }}
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                {{ $item->tinggi_kontainer }}
                            </td>

                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">

                                    {{-- Detail --}}
                                    <a href="{{ route('tps.show', $item->id) }}"
                                        class="rounded-md bg-gray-100 px-3 py-1.5
                                      text-xs font-medium text-gray-700
                                      hover:bg-gray-200 transition">
                                        Detail
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('tps.edit', $item->id) }}"
                                        class="rounded-md bg-jungle-green-50 px-3 py-1.5
                                      text-xs font-medium text-jungle-green-700
                                      hover:bg-jungle-green-100 transition">
                                        Edit
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('tps.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus TPS ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-md bg-red-50 px-3 py-1.5
                                           text-xs font-medium text-red-600
                                           hover:bg-red-100 transition">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-400">
                                Belum ada data TPS.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

    </div>
@endsection
