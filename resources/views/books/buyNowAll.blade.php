@extends('layouts.app')

@section('title', 'Konfirmasi Pembelian')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Konfirmasi Pembelian</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($cart as $item)
                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $grandTotal += $subtotal;
                @endphp
                <tr>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('buyNow.processAll') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ovo">OVO</option>
                <option value="gopay">GoPay</option>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Konfirmasi Checkout</button>
        </div>
    </form>
</div>
@endsection
