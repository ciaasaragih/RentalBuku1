<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .page-wrapper {
            background: linear-gradient(135deg, #fef3f3 0%, #fef7f3 25%, #fef9f3 50%, #f3fef6 75%, #f3f9fe 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75) !important;
            backdrop-filter: blur(20px);
            border: 1.5px solid rgba(255, 255, 255, 0.8) !important;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.08) !important;
        }
        .btn-extend {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%) !important;
            transition: all 0.2s ease;
        }
        .btn-extend:hover { transform: scale(1.05); }
        .badge-returned { background: #d1fae5 !important; color: #065f46 !important; }
        .badge-borrowed { background: #fef3c7 !important; color: #92400e !important; }
        .badge-danger { background: #fee2e2 !important; color: #991b1b !important; }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800">{{ __('Log Peminjaman') }}</h2>
            <a href="{{ route('dashboard') }}" class="bg-amber-500 text-white text-sm font-bold py-2 px-4 rounded-xl shadow">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 page-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 glass-card rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 glass-card">
                <p class="text-sm">
                    <strong>Informasi Setting:</strong> Setiap perpanjangan menambah masa pinjam 
                    <b>{{ $penaltyDetail->masa_tenggang ?? 0 }} hari</b>. 
                    Tarif denda: <b>Rp {{ number_format($penaltyDetail->nominal_denda ?? 0, 0, ',', '.') }}</b>/hari.
                </p>
            </div>

            <div class="glass-card bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-gray-200">
                <div class="p-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">User</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Buku</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tgl Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Estimasi Denda</th>
                                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($logs as $log)
                            @php
                                // Hitung selisih hari jika terlambat
                                $today = \Carbon\Carbon::today();
                                $returnDate = \Carbon\Carbon::parse($log->return_date);
                                $isLate = !$log->actual_return_date && $today->gt($returnDate);
                                $lateDays = $isLate ? $today->diffInDays($returnDate) : 0;
                                $estimatedFine = $lateDays * ($penaltyDetail->nominal_denda ?? 0);
                            @endphp
                            <tr>
                                <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium">{{ $log->user->username ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $log->bookItem?->book?->title ?? 'N/A' }}</td>
                                
                                <td class="px-6 py-4 text-sm {{ $isLate ? 'text-red-600 font-bold' : '' }}">
                                    {{ $returnDate->format('d M Y') }}
                                    @if($isLate)
                                        <br><span class="text-[10px] uppercase">(Terlambat {{ $lateDays }} Hari)</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $log->actual_return_date ? 'badge-returned' : 'badge-borrowed' }}">
                                        {{ $log->actual_return_date ? 'Sudah Kembali' : 'Masih Dipinjam' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm font-bold {{ $estimatedFine > 0 ? 'text-red-600' : 'text-gray-400' }}">
                                    Rp {{ number_format($estimatedFine, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if(!$log->actual_return_date)
                                        <form action="{{ route('admin.rental-logs.extend', $log->id) }}" method="POST" onsubmit="return confirm('Perpanjang peminjaman buku ini selama {{ $penaltyDetail->masa_tenggang ?? 0 }} hari?')">
                                            @csrf
                                            <button type="submit" class="btn-extend text-white text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase">
                                                + Perpanjang
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-300">- Selesai -</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>