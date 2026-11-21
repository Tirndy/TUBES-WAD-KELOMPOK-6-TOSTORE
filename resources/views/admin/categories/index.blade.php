
@extends('admin.layouts.app')

@section('title', 'Kategori')
@section('page-heading', 'Manajemen Kategori')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endpush

@section('content')

<div class="category-header">
    <div>
        <h1>Kategori Produk</h1>
        <p>Kelola pengelompokan produk ToStore.</p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn-primary">
        + Tambah Kategori
    </a>
</div>

<div class="category-table">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?: '-' }}</td>
                    <td>
                        @if($category->is_active)
                            <span class="status-active">Aktif</span>
                        @else
                            <span class="status-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}"
                           class="action-edit">Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Yakin ingin menghapus kategori?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="action-delete">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $categories->links() }}
    </div>
</div>

@endsection
