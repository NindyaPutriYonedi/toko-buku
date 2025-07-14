@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-4" style="max-width: 600px;">
    <h2>Edit Profil</h2>

    {{-- @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat"
                class="form-control @error('alamat') is-invalid @enderror"
                rows="3">{{ old('alamat', $user->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
