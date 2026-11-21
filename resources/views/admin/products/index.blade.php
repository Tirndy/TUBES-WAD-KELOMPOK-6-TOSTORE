
@extends('admin.layouts.app')
@section('title', 'Produk')
@section('page-heading', 'Manajemen Produk')
@push('styles')
@endpush
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | ToStore</title>
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    @stack('styles')
</head>
@section('content')
<div class="product-header">
    <div>
        <h2>Daftar Produk</h2>
        <p>Kelola seluruh produk yang tersedia di ToStore.</p>
    </div>

    <a href="{{ route('products.create') }}" class="btn-primary">
        + Tambah Produk
    </a>
</div>

<div class="product-table">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Brand</th>
                <th>SKU</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $products->firstItem() + $loop->index }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->brand->name ?? '-' }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($product->status) }}</td>
                    <td>
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product->id) }}" class="action-edit">Detail</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="action-edit">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty-data">
                        Belum ada produk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
</div>
@endsection
