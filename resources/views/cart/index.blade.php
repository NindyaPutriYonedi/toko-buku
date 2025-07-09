@extends('layouts.app')

@section('content')
<h2>🛒 Keranjang Belanja</h2>

@if (session('cart') && count(session('cart')) > 0)
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach (session('cart') as $id => $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item['title'] }}</td>
                    <td class="text-center">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="action" value="decrease">
                            <button class="btn btn-sm btn-outline-secondary">−</button>
                        </form>
                        <span class="mx-2">{{ $item['quantity'] }}</span>
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="action" value="increase">
                            <button class="btn btn-sm btn-outline-secondary">+</button>
                        </form>
                    </td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="text-end mt-3">
   <a href="{{ route('buyNow.showAll', $id) }}" class="btn btn-success btn-sm">Beli Sekarang</a>
    </div>
@else
    <div class="alert alert-info mt-3">Keranjang kosong</div>
@endif
@endsection
