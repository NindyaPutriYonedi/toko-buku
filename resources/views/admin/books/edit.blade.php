@extends('layouts.admin')

@section('content')
<h2>Edit Buku</h2>
<form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="mb-3">
    <label>Cover Saat Ini</label><br>
    @if ($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="cover" width="100" height="140" style="object-fit: cover">
    @else
        <span class="text-muted">Tidak ada gambar</span>
    @endif
</div>

<div class="mb-3">
    <label>Ganti Gambar Cover (opsional)</label>
    <input type="file" name="cover_image" class="form-control" accept="image/*">
    @error('cover_image') <div class="text-danger">{{ $message }}</div> @enderror
</div>

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
    </div>
    <div class="mb-3">
        <label>Penulis</label>
        <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
    </div>
    <div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control" required>{{ $book->description }}</textarea>
    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
</div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control" value="{{ $book->price }}" required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stock" class="form-control" value="{{ $book->stock }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.books') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
