<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Monitoring TPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-majalengka.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-xl border border-gray-200 shadow-theme-sm px-6 py-8">

        {{-- HEADER --}}
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo-majalengka.png') }}" alt="Logo Kabupaten Majalengka"
                class="mx-auto mb-3 h-16 w-auto" />

            <h1 class="text-lg font-semibold text-gray-800">
                Monitoring TPS
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Login Sistem
            </p>
        </div>

        {{-- SESSION STATUS --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-jungle-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-md border-gray-300 text-sm
                           focus:border-jungle-green-500 focus:ring-jungle-green-500">

                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>

                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full rounded-md border-gray-300 pr-10 text-sm
                               focus:border-jungle-green-500 focus:ring-jungle-green-500">

                    <button type="button" onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 px-3
                               text-gray-400 hover:text-jungle-green-600 focus:outline-none">

                        {{-- Eye --}}
                        <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        {{-- Eye Off --}}
                        <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3l18 18M10.58 10.58a3 3 0 004.24 4.24" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.88 5.1A9.77 9.77 0 0112 4.5c6 0 9.75 7.5 9.75 7.5a18.6 18.6 0 01-4.32 5.06" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.18 6.18C3.6 8.18 2.25 12 2.25 12s3.75 7.5 9.75 7.5a9.6 9.6 0 004.32-1.06" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- REMEMBER ME --}}
            <div class="flex items-center mb-6">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300
                           text-jungle-green-600
                           focus:ring-jungle-green-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">
                    Remember me
                </label>
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                class="w-full rounded-md
                       bg-jungle-green-600 py-2.5 text-sm font-medium text-white
                       hover:bg-jungle-green-700 transition">
                Log in
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eye = document.getElementById('icon-eye');
            const eyeOff = document.getElementById('icon-eye-off');

            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>

</body>

</html>
