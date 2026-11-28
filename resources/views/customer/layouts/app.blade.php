
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ToStore') | ToStore</title>

    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    @stack('styles')
</head>
<body>

    <!-- Navbar Customer -->
    <header class="customer-navbar">
        <div class="navbar-container">

            <a href="#" class="customer-logo">
                ToStore
            </a>

            <div class="navbar-search">
                <input type="text" placeholder="Cari produk di ToStore...">
                <button type="button">Cari</button>
            </div>

            <nav class="customer-nav">
                <a href="#">Beranda</a>
                <a href="#">Keranjang</a>
                <a href="#">Akun</a>
            </nav>

        </div>
    </header>

    <!-- Konten Halaman Customer -->
    <main class="customer-main">
        @if(session('success'))
            <div class="customer-alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="customer-alert error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="customer-footer">
        <p>&copy; {{ date('Y') }} ToStore. All Rights Reserved.</p>
    </footer>

</body>
</html>
