<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .page-bg {
            background: linear-gradient(135deg, #fef3f3 0%, #fef9f3 50%, #f3f9fe 100%) !important;
            min-height: 100vh;
        }
        .admin-banner {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #f97316 100%) !important;
            border-radius: 2rem;
        }
        /* Efek hover untuk kartu buku */
        .book-card:hover img {
            transform: scale(1.05);
        }
    </style>

    <div class="py-10 page-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(Auth::user()->role == 'admin')
                {{-- HEADER BANNER ADMIN --}}
                <div class="admin-banner p-10 mb-10 text-white shadow-xl">
                    <h1 class="text-3xl font-extrabold tracking-tight">
                        Halo Admin, {{ Auth::user()->name }}! 
                    </h1>
                    <p class="mt-2 text-orange-50 opacity-90 font-medium">
                        Akses cepat fitur manajemen rental buku Anda.
                    </p>
                </div>

                {{-- INFO RINGKASAN ADMIN --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-gray-500 text-sm font-medium">Total Buku</p>
                        <h3 class="text-2xl font-bold text-gray-800">120</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-gray-500 text-sm font-medium">Dipinjam</p>
                        <h3 class="text-2xl font-bold text-gray-800">45</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-gray-500 text-sm font-medium">Member Aktif</p>
                        <h3 class="text-2xl font-bold text-gray-800">89</h3>
                    </div>
                </div>

            @else
                {{-- TAMPILAN PENYEWA (USER BIASA) --}}
                <div class="bg-white/70 backdrop-blur-md rounded-[2.5rem] p-10 shadow-sm border border-white">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-black text-gray-800">📚 Buku Tersedia</h3>
                        
                        <form action="{{ route('dashboard') }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Cari buku..." value="{{ request('search') }}"
                                class="pl-4 pr-10 py-2 border-none bg-white rounded-full shadow-sm focus:ring-2 focus:ring-amber-500 text-sm w-64">
                        </form>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                        @forelse ($books as $book)
                        <div class="group book-card">
                            <a href="{{ route('katalog.show', $book->id) }}">
                                <div class="aspect-[3/4] bg-gray-100 rounded-[2rem] mb-4 overflow-hidden shadow-inner border border-gray-100 group-hover:shadow-lg transition-all duration-300">
                                    @if($book->image)
                                       <img src="{{ asset('storage/books/' . $book->image) }}" 
                                        alt="{{ $book->title }}" 
                                        class="w-full h-full object-cover transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 font-medium italic">
                                            No Cover
                                        </div>
                                    @endif
                                </div>
                                <h5 class="font-bold text-gray-800 px-2 group-hover:text-amber-600 transition-colors truncate">
                                    {{ $book->title }}
                                </h5>
                                <p class="text-xs text-gray-500 px-2 mt-1">
                                    Stok: {{ $book->stock ?? 0 }} unit
                                </p>
                            </a>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-10 text-gray-500">
                            Belum ada buku yang tersedia di katalog saat ini.
                        </div>
                        @endforelse
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>