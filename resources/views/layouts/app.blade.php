<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN (NO VITE) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">

        {{-- Top Navigation --}}
        @include('layouts.navigation')

        <div class="flex flex-1">

            {{-- Sidebar --}}
            <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
                <div class="p-6">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3">
                        Menu Fitur Utama
                    </h2>

                    @if(auth()->user()->role === 'admin')
                    <nav class="mt-4 space-y-2">

                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-3 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0H9m3 0h3" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Dashboard</span>
                        </a>

                        <a href="{{ route('admin.books.create') }}"
                            class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Tambah Koleksi</span>
                        </a>

                        <a href="{{ route('admin.books.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Daftar Buku</span>
                        </a>

                        <a href="{{ route('admin.rental-logs') }}"
                            class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Log Peminjaman</span>
                        </a>

                        <a href="{{ route('admin.penalty.edit') }}"
                            class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4
                                         4-1.79 4-4-1.79-4-4-4z" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Pengaturan Denda</span>
                        </a>

                        @else

                        <a href="{{ route('katalog.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6l4 2" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Buku Tersedia</span>
                        </a>

                        <a href="{{ route('pinjaman.saya') }}"
                            class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
                            <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="ml-3 font-medium text-sm">Peminjaman Saya</span>
                        </a>

                        @endif
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1">

                @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                <main class="p-6">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </div>
</body>

</html>