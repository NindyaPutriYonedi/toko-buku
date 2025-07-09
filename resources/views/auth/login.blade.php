@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f1f1f1;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px; border: none; border-radius: 12px; background-color: #ffffff;">
        <h3 class="text-center mb-4" style="color: #333;">Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label" style="color: #555;">Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="color: #555;">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-dark">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
