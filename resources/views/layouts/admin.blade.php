<!DOCTYPE html>
<html>
<head>
    <title>Admin - Toko Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin</a>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="{{ route('admin.books') }}" class="nav-link">Buku</a></li>
        <li class="nav-item"><a href="{{ route('admin.categories.index') }}" class="nav-link">Kategori</a></li>
        <li class="nav-item"><a href="{{ route('admin.customers') }}" class="nav-link">Customer</a></li>
        <li class="nav-item"><a href="{{ route('admin.orders') }}" class="nav-link">Order</a></li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-link nav-link">Logout</button>
            </form>
        </li>
    </ul>
</nav>
<div class="container py-4">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
