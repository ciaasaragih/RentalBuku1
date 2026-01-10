@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📚 Katalog Buku</h2>

        <form action="{{ route('katalog.index') }}" method="GET" class="d-flex w-50">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <hr>

    <div class="row mt-4">
        @forelse($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0 transition-hover">
                <div class="position-absolute p-2">
                    @if(($book->stock ?? 0) > 0)
                    <span class="badge bg-success shadow-sm">Tersedia</span>
                    @else
                    <span class="badge bg-danger shadow-sm">Habis</span>
                    @endif
                </div>

                @if($book->image)
                <img src="{{ asset('storage/images/' . $book->image) }}" class="card-img-top" style="height: 280px; object-fit: cover; border-radius: 8px 8px 0 0;">
                @else
                <img src="https://via.placeholder.com/250x350?text=No+Cover" class="card-img-top" style="height: 280px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">{{ $book->category ?? 'Umum' }}</small>
                    <h5 class="card-title my-2 fw-bold text-dark text-truncate">{{ $book->title }}</h5>
                    <p class="card-text text-muted mb-3" style="font-size: 0.9rem;">
                        <i class="bi bi-person"></i> {{ $book->author ?? 'Anonim' }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-bold">{{ $book->stock ?? 0 }} Eks</span>
                        <a href="{{ route('katalog.show', $book->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/gray/searching.svg" alt="Not Found" style="width: 200px;">
            <h4 class="mt-4 text-muted">Yah, buku yang kamu cari tidak ada...</h4>
            <a href="{{ route('katalog.index') }}" class="btn btn-primary mt-3">Lihat Semua Buku</a>
        </div>
        @endforelse
    </div>
</div>

<style>
    .transition-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@endsection