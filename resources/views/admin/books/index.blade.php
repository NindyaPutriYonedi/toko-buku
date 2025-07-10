@extends('layouts.admin')

@section('content')
<h2 class="d-flex justify-content-between align-items-center">
    Daftar Buku
    <a href="{{ route('admin.books.create') }}" class="btn btn-success">+ Tambah Buku</a>
</h2>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Cover</th> {{-- Tambahkan kolom cover --}}
            <th>Judul</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover {{ $book->title }}" width="80">
                @else
                    <span class="text-muted">Tidak ada cover</span>
                @endif
            </td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
            <td>{{ $book->stock }}</td>
            <td>
                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
