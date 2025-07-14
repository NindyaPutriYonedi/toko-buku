@extends('layouts.admin')

@section('title', 'Detail Order')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Detail Order {{ $order->id }}</h2>
    <p><strong>Customer:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
    <p><strong>Alamat:</strong> {{ $order->user->alamat ?? '-' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->metode_pembayaran) }}</p>

    <h4 class="mt-4">Item Buku:</h4>
    <table class="table table-sm table-bordered">
        <thead class="table-light">
            <tr>
                <th>Judul</th>
                <th class="text-end">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->book->title }}</td>
                <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total:</th>
                <th class="text-end">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
