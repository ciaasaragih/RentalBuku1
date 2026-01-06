<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <div class="p-6 text-gray-900">
                    
                    {{-- Pesan Sukses setelah Klik Approve --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-medium mb-4">Daftar Penyewa yang Menunggu Persetujuan</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border p-3 text-left font-semibold">Nama</th>
                                    <th class="border p-3 text-left font-semibold">Email</th>
                                    <th class="border p-3 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border p-3">{{ $user->name }}</td>
                                        <td class="border p-3">{{ $user->email }}</td>
                                        <td class="border p-3 text-center">
                                            {{-- Form ini akan mengirim ID ke AdminController@approveUser --}}
                                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-xs font-bold uppercase tracking-wider transition">
                                                    Approve
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="border p-8 text-center text-gray-500 italic">
                                            Saat ini tidak ada user baru yang perlu disetujui.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 border-t pt-4">
                        <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                            &larr; Kembali ke Dashboard Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>