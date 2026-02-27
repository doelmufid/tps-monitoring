@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl">

        <div class="rounded-xl border border-jungle-green-100 bg-white shadow-theme-sm px-8 py-8">

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800">
                    Tambah User
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan akun pengguna baru ke sistem
                </p>
            </div>

            {{-- Form --}}
            <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full h-10 rounded-lg border-gray-300 text-sm
                              focus:border-jungle-green-500
                              focus:ring-jungle-green-500">

                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full h-10 rounded-lg border-gray-300 text-sm
                              focus:border-jungle-green-500
                              focus:ring-jungle-green-500">

                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input type="password" name="password" required
                        class="w-full h-10 rounded-lg border-gray-300 text-sm
                              focus:border-jungle-green-500
                              focus:ring-jungle-green-500">

                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Role
                    </label>
                    <select name="role" required
                        class="w-full h-10 rounded-lg border-gray-300 text-sm
                               focus:border-jungle-green-500
                               focus:ring-jungle-green-500">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="pimpinan" {{ old('role') == 'pimpinan' ? 'selected' : '' }}>
                            Pimpinan
                        </option>
                    </select>

                    @error('role')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action --}}
                <div class="flex gap-3 pt-6">

                    <button type="submit"
                        class="h-10 px-6 rounded-lg
                               bg-jungle-green-600
                               text-white text-sm font-medium
                               hover:bg-jungle-green-700
                               transition shadow-sm">
                        Simpan
                    </button>

                    <a href="{{ route('user.index') }}"
                        class="h-10 px-6 rounded-lg
                          border border-jungle-green-600
                          text-jungle-green-600 text-sm font-medium
                          hover:bg-jungle-green-50
                          transition flex items-center">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
