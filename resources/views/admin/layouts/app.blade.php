
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | ToStore</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>

<div class="min-h-screen flex">
    <aside>
        <div>
            <h1>ToStore</h1>
            <p>Admin Panel</p>
        </div>

        <nav>
            <div>
                <p>MENU UTAMA</p>

                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('products.index') }}" class="sidebar-link">
                    <span>Produk</span>
                </a>

                <a href="{{ route('categories.index') }}" class="sidebar-link">
                    <span>Kategori</span>
                </a>

                <a href="{{ route('brands.index') }}" class="sidebar-link">
                    <span>Brand</span>
                </a>
            </div>
        </nav>

        <div>
            <p>ToStore Admin Panel</p>
        </div>
    </aside>

    <main>
        <header>
            <h2>@yield('page-heading', 'Dashboard')</h2>
        </header>

        <div class="page-content">
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
