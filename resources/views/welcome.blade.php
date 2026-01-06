<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Buku - Sistem Informasi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Figtree', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="antialiased bg-[#f0f7ff] min-h-screen text-gray-800">
    
    <div class="max-w-6xl mx-auto px-6 py-10">
        
        <div class="glass-card rounded-[3rem] p-10 shadow-2xl shadow-blue-100 mb-8 relative overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
                <div class="text-center md:text-left">
                    <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest mb-4">Sistem Rental Buku</span>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight">
                        Halo, Selamat Datang! 👋
                    </h1>
                    <p class="mt-3 text-gray-500 font-medium text-lg italic">
                        "Kelola dan nikmati ribuan koleksi buku dalam satu genggaman."
                    </p>
                </div>
                
                <div class="mt-8 md:mt-0">
                    @if (Route::has('login'))
                        <div class="flex flex-wrap justify-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 text-lg">
                                    Buka Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-8 py-4 bg-white border border-gray-200 text-gray-700 rounded-2xl font-bold hover:bg-gray-50 transition-all text-lg">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gray-900 text-white rounded-2xl font-bold shadow-xl hover:bg-black hover:-translate-y-1 transition-all duration-300 text-lg">
                                        Daftar Akun
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-200/40 rounded-full blur-3xl"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-blue-50 flex items-center group hover:shadow-md transition">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mr-5 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em]">Member</p>
                    <h3 class="text-2xl font-black text-gray-800">1,250 <span class="text-sm font-medium text-gray-400">Penyewa</span></h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-blue-50 flex items-center group hover:shadow-md transition">
                <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mr-5 shadow-lg shadow-blue-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em]">Koleksi</p>
                    <h3 class="text-2xl font-black text-gray-800">4,500 <span class="text-sm font-medium text-gray-400">Buku</span></h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-blue-50 flex items-center group hover:shadow-md transition">
                <div class="w-14 h-14 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center mr-5 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em]">Dipinjam</p>
                    <h3 class="text-2xl font-black text-gray-800">850 <span class="text-sm font-medium text-gray-400">Transaksi</span></h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-blue-50">
                <div class="flex items-center mb-6">
                    <div class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></div>
                    <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight">Eksplorasi Katalog</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="p-4 bg-blue-50/50 rounded-2xl border border-blue-100 flex items-center justify-between group cursor-pointer hover:bg-blue-600 transition-all duration-300">
                        <div class="flex items-center text-gray-700 group-hover:text-white font-bold transition">
                            <span class="text-2xl mr-4 group-hover:scale-125 transition">📓</span>
                            <span>Lihat Semua Buku</span>
                        </div>
                        <span class="text-blue-400 group-hover:text-white font-black">→</span>
                    </div>

                    <div class="p-4 bg-white rounded-2xl border border-gray-100 flex items-center justify-between group cursor-pointer hover:border-blue-400 transition-all duration-300">
                        <div class="flex items-center text-gray-700 font-bold transition">
                            <span class="text-2xl mr-4 group-hover:scale-125 transition">⭐</span>
                            <span>Koleksi Terpopuler</span>
                        </div>
                        <span class="text-gray-300 group-hover:text-blue-600 font-black">→</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-blue-50">
                <div class="flex items-center mb-6">
                    <div class="w-1.5 h-6 bg-sky-500 rounded-full mr-3"></div>
                    <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight">Kenapa Kami?</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="flex items-start p-2">
                        <div class="bg-green-100 p-2 rounded-lg mr-4 mt-1">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase tracking-tighter">Proses Instan</h4>
                            <p class="text-sm text-gray-500 font-medium">Tanpa antri, pilih buku dan bawa pulang.</p>
                        </div>
                    </div>

                    <div class="flex items-start p-2">
                        <div class="bg-blue-100 p-2 rounded-lg mr-4 mt-1">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase tracking-tighter">Pilihan Lengkap</h4>
                            <p class="text-sm text-gray-500 font-medium">Mulai dari fiksi hingga jurnal edukasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center text-gray-400 text-sm font-medium uppercase tracking-widest">
            &copy; {{ date('Y') }} RentalBuku System.
        </div>
    </div>
</body>
</html>