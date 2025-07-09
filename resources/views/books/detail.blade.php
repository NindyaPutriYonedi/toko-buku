@extends('layouts.app')

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
            <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-cover.jpg') }}"
                 alt="{{ $book->title }}"
                 class="img-fluid rounded"
                 style="max-height: 300px; object-fit: contain;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <p class="text-muted mb-1"><strong>{{ $book->author }}</strong></p>
                <h2 class="card-title">{{ $book->title }}</h2>
                @if($book->category)
                <p class="text-muted mb-2">Kategori: <span class="badge bg-primary">{{ $book->category->name }}</span></p>
                @endif
                <p class="card-text mb-3">{{ $book->description }}</p>
                <h4 class="text-success mb-4">Rp {{ number_format($book->price, 0, ',', '.') }}</h4>

                <a href="{{ route('buyNow.show', $book->id) }}" class="btn btn-success btn-lg rounded-pill px-4">
                    <i class="bi bi-cart-check me-2"></i> Beli Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
