
@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard-welcome">
    <h1>Dashboard</h1>
    <p>Selamat datang di panel pengelolaan katalog ToStore.</p>
</div>

<div class="dashboard-stats">

    <div class="stat-card">
        <p>Total Produk</p>
        <h2>{{ $productCount }}</h2>
    </div>

    <div class="stat-card">
        <p>Total Kategori</p>
        <h2>{{ $categoryCount }}</h2>
    </div>

    <div class="stat-card">
        <p>Total Merek</p>
        <h2>{{ $brandCount }}</h2>
    </div>

    <div class="stat-card">
        <p>Produk Aktif</p>
        <h2>{{ $activeProducts }}</h2>
    </div>

</div>

<div class="dashboard-table">

    <div class="dashboard-table-header">
        <h3>Produk Terbaru</h3>
        <p>Lima produk terakhir yang ditambahkan.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Merek</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($latestProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->brand?->name ?? '-' }}</td>
                    <td>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td>{{ ucfirst($product->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
