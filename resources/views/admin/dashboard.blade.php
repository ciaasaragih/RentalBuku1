<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .page-bg {
            background: linear-gradient(135deg, #fef3f3 0%, #fef9f3 50%, #f3f9fe 100%);
            min-height: 100vh;
        }

        .admin-banner {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #f97316 100%);
            border-radius: 2rem;
        }

        .book-card:hover img {
            transform: scale(1.05);
        }
    </style>

    <div class="py-10 page-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER ADMIN --}}
            <div class="admin-banner p-10 mb-10 text-white shadow-xl">
                <h1 class="text-3xl font-extrabold">
                    Halo Admin, {{ Auth::user()->name }}!
                </h1>
                <p class="mt-2 text-orange-50 font-medium">
                    Akses cepat manajemen rental buku.
                </p>
            </div>

            {{-- RINGKASAN --}}
            @if($totalBuku > 0)
            <div class="flex justify-end">
                @if($dipinjam > 0)
                <p class="text-sm text-white mt-2 bg-green-600 rounded-xl m-2 p-2">
                    {{ round(($dipinjam / $totalBuku) * 100) }}% buku sedang dipinjam
                </p>
                @else
                <p class="text-sm text-gray-600 mt-2 bg-gray-100 rounded-xl m-2 p-2">
                    Semua buku tersedia
                </p>
                @endif
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">


                <div class="bg-white p-6 rounded-2xl shadow-sm border">
                    <p class="text-gray-500 text-sm">Total Buku</p>
                    <h3 class="text-3xl font-bold text-gray-800">
                        {{ number_format($totalBuku) }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border">
                    <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-orange-600">
                        {{ number_format($dipinjam) }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border">
                    <p class="text-gray-500 text-sm">Member Aktif</p>
                    <h3 class="text-3xl font-bold text-green-600">
                        {{ number_format($memberAktif) }}
                    </h3>
                </div>

            </div>


        </div>
    </div>
</x-app-layout>