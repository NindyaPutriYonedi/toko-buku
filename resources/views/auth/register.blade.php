@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f1f1f1;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 500px; border: none; border-radius: 12px; background-color: #ffffff;">
        <h3 class="text-center mb-4" style="color: #333;">Register</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label" style="color: #555;">Nama</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label" style="color: #555;">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label" style="color: #555;">Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label" style="color: #555;">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label" style="color: #555;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-dark">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
