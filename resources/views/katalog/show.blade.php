<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku: {{ $book->title }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12 px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <a href="/dashboard" class="inline-block mb-6 text-blue-600 hover:text-blue-800">
                &larr; Kembali ke Katalog
            </a>
            
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('storage/cover/' . $book->image) }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-auto rounded-lg shadow-md">
                </div>

                <div class="w-full md:w-2/3">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-lg text-indigo-600 mb-4 font-medium">
                        Penulis: {{ $book->author ?? 'Tidak diketahui' }}
                    </p>
                    
                    <hr class="my-4">
                    
                    <h5 class="text-xl font-semibold mb-2 text-gray-800">Deskripsi:</h5>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ $book->description ?? 'Belum ada deskripsi untuk buku ini.' }}
                    </p>
                    
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 mb-6">
                        <p class="text-gray-700">
                            <strong>Sisa Stok:</strong> 
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-bold ml-2">
                                {{ $book->stock ?? 0 }} Unit
                            </span>
                        </p>
                    </div>

                    <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                        Ajukan Peminjaman
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>