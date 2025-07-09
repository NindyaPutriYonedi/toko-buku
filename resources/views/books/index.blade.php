@extends('layouts.app')

@section('title', 'Toko Buku Nindya')

@section('content')
<div class="container mt-2">

    {{-- Hero Section --}}
    <div class="container-fluid px-0 mb-5">
        <div class="position-relative text-white"
             style="background-image: url('{{ asset('images/bg2.png') }}');
                    background-size: cover; background-position: center; min-height: 550px;">
            <div class="container h-100 d-flex align-items-center justify-content-end">
                <div class="text-end bg-white bg-opacity-75 p-4 rounded shadow-sm">
                    <h1 class="display-5 fw-bold text-dark">Buy One Get One</h1>
                    <p class="text-secondary mb-4">Gospel Voices and Nonfiction Books</p>
                    <a href="login" class="btn btn-dark text-uppercase fw-semibold px-4 py-2 rounded-pill">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Best Seller --}}
    <h3 class="mb-4 text-dark fw-bold">Best Seller</h3>
    <div class="row mb-5">
        @forelse ($bestSellers as $book)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 border-0 shadow rounded-4 position-relative">
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">Best Seller</span>

                    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-cover.jpg') }}"
                         class="card-img-top rounded-top-4" alt="{{ $book->title }}"
                         style="height: 200px;  object-fit: contain; padding: 20px;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1 text-dark">
  <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none text-dark">
    {{ $book->title }}
  </a>
</h5>

                        <p class="card-text text-muted mb-1"> {{ $book->author }}</p>
                        <p class="card-text text-success fw-semibold mb-3">Rp {{ number_format($book->price, 0, ',', '.') }}</p>

                        <div class="mt-auto d-flex gap-2">
                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark w-100 rounded-pill">
                                    <i class="bi bi-cart"></i>
                                </button>
                            </form>

                            <form action="{{ route('buyNow.show', $book->id) }}" method="GET" class="flex-fill">
                                @csrf
                                <button type="submit" class="btn btn-dark w-100 rounded-pill">
                                    Beli Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Belum ada best seller.</p>
            </div>
        @endforelse
    </div>

    {{-- Semua Buku --}}
    <h3 class="mb-4 fw-bold">Semua Buku</h3>
    <div class="row">
        @foreach ($books as $book)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-cover.jpg') }}"
                         class="card-img-top rounded-top-4" alt="{{ $book->title }}"
                         style="height: 200px; object-fit: contain; padding: 20px">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1 text-dark">
  <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none text-dark">
    {{ $book->title }}
  </a>
</h5>

                        <p class="card-text text-muted mb-1"> {{ $book->author }}</p>
                        <p class="card-text text-success fw-semibold mb-3">Rp {{ number_format($book->price, 0, ',', '.') }}</p>

                        <div class="mt-auto d-flex gap-2">
                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark w-100 rounded-pill">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>

                            <form action="{{ route('buyNow.show', $book->id) }}" method="GET" class="flex-fill">
                                @csrf
                                <button type="submit" class="btn btn-dark w-100 rounded-pill">
                                    Beli Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
