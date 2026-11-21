
@extends('admin.layouts.app')

@section('title', 'Manajemen Brand')
@section('page-heading', 'Manajemen Brand')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brands.css') }}">
@endpush

@section('content')

<div class="brand-page">

    <div class="brand-page-header">
        <div>
            <h2>Daftar Brand</h2>
            <p>Kelola seluruh brand yang tersedia di ToStore.</p>
        </div>

        <a href="{{ route('brands.create') }}" class="brand-btn-primary">
            + Tambah Brand
        </a>
    </div>

    @if(session('success'))
        <div class="brand-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="brand-card">

        <div class="brand-card-header">
            <div>
                <h3>Data Brand</h3>
                <p>Daftar brand yang terdaftar dalam sistem.</p>
            </div>

            <span class="brand-total">
                Total: {{ $brands->total() }} Brand
            </span>
        </div>

        <div class="brand-table-wrapper">
            <table class="brand-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Nama Brand</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td>{{ $brands->firstItem() + $loop->index }}</td>

                            <td>
                                @if($brand->logo)
                                    <img
                                        src="{{ asset('storage/' . $brand->logo) }}"
                                        alt="{{ $brand->name }}"
                                        class="brand-logo"
                                    >
                                @else
                                    <div class="brand-logo-placeholder">
                                        {{ strtoupper(substr($brand->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <td class="brand-name">
                                {{ $brand->name }}
                            </td>

                            <td>{{ $brand->slug }}</td>

                            <td>
                                {{ $brand->description ?: '-' }}
                            </td>

                            <td>
                                @if($brand->is_active)
                                    <span class="brand-status active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="brand-status inactive">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="brand-action-group">
                                    <a
                                        href="{{ route('brands.edit', $brand->id) }}"
                                        class="brand-btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('brands.destroy', $brand->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus brand ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="brand-btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="brand-empty">
                                    <h3>Belum Ada Brand</h3>
                                    <p>Silakan tambahkan brand pertama kamu.</p>
                                    <a href="{{ route('brands.create') }}" class="brand-btn-primary">
                                        + Tambah Brand
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="brand-pagination">
            {{ $brands->links() }}
        </div>

    </div>
</div>

@endsection
