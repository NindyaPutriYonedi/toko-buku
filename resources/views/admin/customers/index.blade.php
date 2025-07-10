@extends('layouts.admin')

@section('content')
<h2>Daftar Customer</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Tanggal Daftar</th>
            <th>Jumlah Order</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('d M Y') }}</td>
            <td>{{ $user->total_quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
