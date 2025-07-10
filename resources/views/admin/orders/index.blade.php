@extends('layouts.admin')

@section('title', 'Daftar Order')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Order</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @php
                    $statusColors = [
                        'pending' => 'warning',
                        'processing' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    ];
                @endphp
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <div class="btn-group">
                                <button type="button"
                                        class="btn btn-sm btn-{{
                                            $order->status === 'completed' ? 'success' :
                                            ($order->status === 'processing' ? 'primary' :
                                            ($order->status === 'cancelled' ? 'danger' : 'warning')) }}">
                                    {{ ucfirst($order->status) }}
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"></button>
                                <ul class="dropdown-menu">
                                    @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                        @if($status !== $order->status)
                                            <li>
                                                <button type="submit" name="status" value="{{ $status }}" class="dropdown-item">
                                                    {{ ucfirst($status) }}
                                                </button>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
