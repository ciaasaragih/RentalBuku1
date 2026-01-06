<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <div class="flex flex-1">
                <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
                    <div class="p-6">
                        <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3">Menu Fitur Utama</h2>
                        <nav class="mt-4 space-y-2">
    
    <a href="{{ route('admin.books.create') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
        <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </span>
        <span class="ml-3 font-medium text-sm">Tambah Koleksi</span>
    </a>

    <a href="{{ route('admin.rental-logs') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
        <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
        </span>
        <span class="ml-3 font-medium text-sm">Log Peminjaman</span>
    </a>

    <a href="{{ route('penalty.edit') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group">
        <span class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 text-orange-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </span>
        <span class="ml-3 font-medium text-sm">Pengaturan Denda</span>
    </a>

</nav>

                            
                    </div>
                </aside>

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