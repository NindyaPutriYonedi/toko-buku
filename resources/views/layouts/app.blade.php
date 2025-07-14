<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Buku Nindya')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles: White-Gray Theme -->
    <style>
        html, body {
            height: 100%;
            background-color: #f1f1f1;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
        }

        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #333 !important;
        }

        .nav-link {
            color: #555 !important;
            font-weight: 500;
            transition: 0.2s;
        }

        .nav-link:hover {
            color: #000 !important;
        }

        /* .btn-primary {
            background-color: #222831;
            border-color: #6c757d;
        }

        .btn-primary:hover {
            background-color: #222831;
            border-color: #5a6268;
        } */

        .alert {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .list-unstyled a:hover {
            text-decoration: underline;
        }

        .footer-heading {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-book-half me-1"></i> NindyaBook
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><i class="bi bi-cart3"></i> Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('books.history') }}"><i class="bi bi-clock-history"></i> Riwayat</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle"></i> Profil</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="footer-heading"><i class="bi bi-book me-2"></i>Toko Buku Nindya</h5>
                    <p>Menyediakan berbagai buku pilihan untuk menambah wawasan dan inspirasi Anda. Belanja buku jadi lebih mudah dan menyenangkan.</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-whatsapp fa-lg"></i></a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="footer-heading">Kontak Kami</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Kenanga No. 45, Padang</p>
                    <p><i class="fas fa-phone me-2"></i>+62 812 3456 7890</p>
                    <p><i class="fas fa-envelope me-2"></i>cp@nindyabook.com</p>
                    <p><i class="fas fa-clock me-2"></i>Senin - Jumat: 09.00 - 17.00</p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="footer-heading">Kategori Populer</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Fiksi</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Non-Fiksi</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Pendidikan</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Teknologi</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} NindyaBook. Semua hak cipta dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light text-decoration-none me-3">Syarat & Ketentuan</a>
                    <a href="#" class="text-light text-decoration-none">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
