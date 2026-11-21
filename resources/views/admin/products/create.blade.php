
@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('page-heading', 'Tambah Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endpush

@section('content')
<div class="product-form-container">
    <div class="product-form-header">
        <div>
            <h2>Tambah Produk</h2>
            <p>Masukkan informasi produk baru ke katalog ToStore.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-secondary">Kembali</a>
    </div>

    <form action="{{ route('products.store') }}" method="POST" class="product-form">
        @csrf

        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name"
                value="{{ old('name') }}" placeholder="Masukkan nama produk" required>
            @error('name')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select name="brand_id" id="brand_id">
                <option value="">Tanpa Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" id="sku" name="sku"
                value="{{ old('sku') }}" placeholder="Contoh: TST-001" required>
            @error('sku')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug"
                value="{{ old('slug') }}" placeholder="Contoh: sepatu-pria" required>
            @error('slug')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Produk</label>
            <textarea id="description" name="description" rows="4"
                placeholder="Deskripsikan produk">{{ old('description') }}</textarea>
            @error('description')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price"
                value="{{ old('price') }}" min="0" placeholder="Contoh: 150000" required>
            @error('price')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="weight">Berat (gram)</label>
            <input type="number" id="weight" name="weight"
                value="{{ old('weight', 0) }}" min="0">
            @error('weight')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="product-dimensions">
            <div class="form-group">
                <label for="length">Panjang (cm)</label>
                <input type="number" id="length" name="length"
                    value="{{ old('length', 0) }}" min="0">
            </div>

            <div class="form-group">
                <label for="width">Lebar (cm)</label>
                <input type="number" id="width" name="width"
                    value="{{ old('width', 0) }}" min="0">
            </div>

            <div class="form-group">
                <label for="height">Tinggi (cm)</label>
                <input type="number" id="height" name="height"
                    value="{{ old('height', 0) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status Produk</label>
            <select name="status" id="status" required>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
            </select>
            @error('status')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="product-form-actions">
            <a href="{{ route('products.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
