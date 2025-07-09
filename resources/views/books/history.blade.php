@extends('layouts.app') {{-- Sesuaikan jika nama layout berbeda --}}

@section('title', 'Riwayat Pesanan')

@section('content')
    <h2 class="mb-4">Riwayat Pesanan Saya</h2>

    @forelse ($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>Order {{ $order->id }}</strong><br>
                    <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                </div>
                <span
                    class="badge bg-{{
                        $order->status === 'completed' ? 'success' :
                        ($order->status === 'processing' ? 'primary' :
                        ($order->status === 'cancelled' ? 'danger' : 'warning'))
                    }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->book->title ?? '[Buku telah dihapus]' }}</strong><br>
                                <small>Jumlah: {{ $item->quantity }}</small>
                            </div>
                            <div>
                                Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-3 text-end">
                    <strong>Total:</strong> Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Anda belum memiliki riwayat pesanan.
        </div>
    @endforelse
@endsection
