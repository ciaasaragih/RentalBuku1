<x-app-layout>
    <div class="container py-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-primary">📖 Peminjaman Saya</h2>
            <a href="{{ route('katalog.index') }}" class="btn btn-outline-primary px-4 py-2 rounded">
                ← Kembali ke Katalog
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pinjamanSaya as $pinjaman)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($pinjaman->buku?->image && file_exists(storage_path('app/public/books/' . $pinjaman->buku->image)))
                            <img src="{{ asset('storage/books/' . $pinjaman->buku->image) }}"
                                alt="{{ $pinjaman->buku->title ?? 'Buku' }}"
                                class="w-20 h-auto rounded-lg shadow-md">
                            @else
                            <img src="{{ asset('images/no-book.png') }}"
                                class="w-20 h-auto rounded-lg shadow-md"
                                alt="No Cover">
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-800 font-semibold">
                            {{ $pinjaman->buku->title ?? 'Buku tidak tersedia' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $pinjaman->buku->category ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($pinjaman->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($pinjaman->tanggal_kembali_seharusnya)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($pinjaman->status === 'dipinjam')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Dipinjam
                            </span>
                            @if(now()->gt($pinjaman->tanggal_kembali_seharusnya))
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 ml-1">
                                Terlambat
                            </span>
                            @endif
                            @elseif($pinjaman->status === 'dikembalikan')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Dikembalikan
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ ucfirst($pinjaman->status) }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Kamu belum memiliki peminjaman buku.<br>
                            <a href="{{ route('katalog.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">Pinjam Buku Sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>