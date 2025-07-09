@extends('layouts.app')

@section('title', 'Beli Sekarang - ' . $book->title)

@section('content')
<div class="container py-4" style="max-width: 600px;">
    <h2 class="mb-4">Checkout Buku: {{ $book->title }}</h2>

    <div class="mb-3">
        <strong>Nama:</strong> {{ $user->name }} <br>
        <strong>Alamat:</strong> {{ $user->alamat ?? '-' }} <br>
        <strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }} <br>
        <strong>Jumlah:</strong> 1
    </div>

    <form action="{{ route('buyNow.process', $book->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="transfer" {{ old('metode_pembayaran')=='transfer' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="ovo" {{ old('metode_pembayaran')=='ovo' ? 'selected' : '' }}>OVO</option>
                <option value="gopay" {{ old('metode_pembayaran')=='gopay' ? 'selected' : '' }}>GoPay</option>
            </select>
            @error('metode_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success w-100 rounded-pill">Beli</button>
    </form>
</div>
@endsection
