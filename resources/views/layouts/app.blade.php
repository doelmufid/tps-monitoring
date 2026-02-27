<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring TPS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-majalengka.png?v=2') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

</head>

<body x-data="{ sidebarOpen: true, sidebarHover: false }" class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside @mouseenter="sidebarHover = true" @mouseleave="sidebarHover = false"
            :class="(sidebarOpen || sidebarHover) ? 'w-64' : 'w-[90px]'"
            class="fixed left-0 top-0 z-0 h-screen bg-white border-r border-gray-200 px-4 py-6 transition-all duration-50">

            <div class="mb-8 flex justify-center">
                <!-- Logo BESAR -->
                <img x-show="sidebarOpen" src="{{ asset('images/logo-majalengka.png') }}"
                    class="h-20 w-auto transition">

                <!-- Logo KECIL -->
                <img x-show="!sidebarOpen" src="{{ asset('images/logo-majalengka.png') }}"
                    class="h-auto w-10 transition">
            </div>


            <nav class="space-y-1 text-sm">
                <p class="px-2 mb-2 text-xs font-semibold text-gray-400 uppercase">Menu</p>

                <a href="/dashboard"
                    class="relative group flex items-center gap-3 px-3 py-2 rounded-md font-medium
   {{ request()->is('dashboard') ? 'bg-jungle-green-50 text-jungle-green-700' : 'text-gray-700 hover:bg-gray-100' }}">

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mx-1.5" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
                    </svg>

                    <!-- TEXT -->
                    <span x-show="sidebarOpen || sidebarHover">Dashboard</span>

                </a>


                @if (auth()->user()->role === 'admin')
                    <a href="/tps"
                        class="relative group flex items-center gap-3 px-3 py-2 rounded-md font-medium
   {{ request()->is('tps*') ? 'bg-jungle-green-50 text-jungle-green-700' : 'text-gray-700 hover:bg-gray-100' }}">

                        <!-- ICON: Clipboard -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mx-1.5" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6M9 9h6M5 5h14v14H5z" />
                        </svg>

                        <span x-show="sidebarOpen || sidebarHover">Data TPS</span>

                    </a>


                    <a href="/user"
                        class="relative group flex items-center gap-3 px-3 py-2 rounded-md font-medium
   {{ request()->is('user*') ? 'bg-jungle-green-50 text-jungle-green-700' : 'text-gray-700 hover:bg-gray-100' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mx-1.5" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>

                        <span x-show="sidebarOpen || sidebarHover">User</span>

                    </a>
                @endif

                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'pimpinan')
                    <a href="/riwayat"
                        class="relative group flex items-center gap-3 px-3 py-2 rounded-md font-medium
   {{ request()->is('riwayat*') ? 'bg-jungle-green-50 text-jungle-green-700' : 'text-gray-700 hover:bg-gray-100' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mx-1.5" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15v-4m4 4V7m4 8v-6" />
                        </svg>

                        <span x-show="sidebarOpen || sidebarHover">Riwayat Kapasitas</span>

                    </a>


                    <a href="/pengangkutan"
                        class="relative group flex items-center gap-3 px-3 py-2 rounded-md font-medium
   {{ request()->is('pengangkutan*')
       ? 'bg-jungle-green-50 text-jungle-green-700'
       : 'text-gray-700 hover:bg-gray-100' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mx-1.5" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17a2 2 0 104 0m6 0a2 2 0 11-4 0M3 5h13v12H3zM16 8h4l2 3v6h-6" />
                        </svg>

                        <span x-show="sidebarOpen || sidebarHover">Riwayat Pengangkutan</span>

                    </a>


                    <a href="/laporan"
                        class="relative group flex items-center gap-3 px-3 py-2 rounded-md font-medium
   {{ request()->is('laporan*') ? 'bg-jungle-green-50 text-jungle-green-700' : 'text-gray-700 hover:bg-gray-100' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mx-1.5" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13H7z" />
                        </svg>

                        <span x-show="sidebarOpen || sidebarHover">Laporan</span>


                    </a>
                @endif
            </nav>
        </aside>

        {{-- Main --}}
        <main :class="(sidebarOpen || sidebarHover) ? 'ml-64' : 'ml-[90px]'"
            class="flex-1 min-h-screen flex flex-col transition-all duration-50">

            {{-- Header --}}
            <header :class="(sidebarOpen || sidebarHover) ? 'ml-64' : 'ml-[90px]'"
                class="fixed top-0 right-0 z-30
           bg-white border-b border-gray-200
           transition-all duration-50"
                style="left: 0;">
                <div class="flex items-center justify-between px-6 h-[72px]">

                    {{-- TITLE --}}
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="rounded-lg p-2 hover:bg-jungle-green-50 transition" title="Toggle Sidebar">
                            <!-- Icon hamburger -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-jungle-green-700"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                            </svg>
                        </button>

                        <h1 class="text-lg font-semibold text-gray-800">
                            Monitoring TPS
                        </h1>
                        <p class="text-sm text-gray-500">
                            Kab. Majalengka
                        </p>
                    </div>

                    {{-- User Dropdown --}}
                    <div class="relative">
                        <button onclick="document.getElementById('userMenu').classList.toggle('hidden')"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-jungle-green-50 transition">

                            <div class="text-right leading-tight">
                                <p class="text-sm font-medium text-gray-800">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ auth()->user()->role === 'admin' ? 'Admin' : 'Pimpinan' }}
                                </p>
                            </div>

                            <div
                                class="w-9 h-9 rounded-full bg-jungle-green-100
                   flex items-center justify-center
                   font-semibold text-jungle-green-700">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </button>

                        {{-- Dropdown --}}
                        <div id="userMenu"
                            class="hidden absolute right-0 mt-3 w-48
               rounded-xl border border-gray-200 bg-white
               shadow-theme-sm z-50 overflow-hidden">

                            {{-- Profil --}}
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm
                  text-gray-700 hover:bg-jungle-green-50 transition">

                                {{-- Heroicon: User --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-jungle-green-600"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 20.25a7.5 7.5 0 0115 0" />
                                </svg>

                                Profil
                            </a>

                            <div class="h-px bg-gray-100"></div>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm
                       text-red-600 hover:bg-red-50 transition">

                                    {{-- Heroicon: Arrow Right on Rectangle --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 12h-9m0 0l3-3m-3 3l3 3" />
                                    </svg>

                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>


                </div>
            </header>


            {{-- Content --}}
            <section class="flex-1 overflow-y-auto p-6 pt-[90px]">
                <div class="max-w-7xl mx-auto space-y-6">
                    @yield('content')
                </div>
            </section>



        </main>

    </div>

    @stack('scripts')

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>

</html>
