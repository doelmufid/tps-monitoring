@extends('layouts.app')

@section('content')
    <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Data User
                </h2>
                <p class="text-sm text-gray-500">
                    Manajemen akun pengguna sistem
                </p>
            </div>

            <a href="{{ route('user.create') }}"
                class="rounded-lg bg-jungle-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-jungle-green-700 transition">
                + Tambah User
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-jungle-green-50 transition">
                            <td class="px-6 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-3 font-medium text-gray-800">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-3 text-gray-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-3">
                                <span
                                    class="px-2 py-1 text-xs rounded-full
                            {{ $user->role === 'admin' ? 'bg-jungle-green-100 text-jungle-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="rounded-md bg-jungle-green-50 px-3 py-1.5 text-xs font-medium text-jungle-green-700 hover:bg-jungle-green-100 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-md bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-100 transition">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
@endsection
