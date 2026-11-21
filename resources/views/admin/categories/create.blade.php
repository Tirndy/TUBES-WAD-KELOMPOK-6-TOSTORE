
@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')
@section('page-heading', 'Tambah Kategori')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endpush

@section('content')
<div class="category-form-container">
    <div class="category-form-header">
        <div>
            <h2>Tambah Kategori</h2>
            <p>Tambahkan kategori produk baru ke dalam katalog.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="btn-secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('categories.store') }}" method="POST" class="category-form">
        @csrf

        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Masukkan nama kategori"
                required
            >
            @error('name')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input
                type="text"
                id="slug"
                name="slug"
                value="{{ old('slug') }}"
                placeholder="Contoh: pakaian-pria"
                required
            >
            @error('slug')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="Masukkan deskripsi kategori"
            >{{ old('description') }}</textarea>
            @error('description')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" required>
                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            @error('is_active')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="category-form-actions">
            <a href="{{ route('categories.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Kategori</button>
        </div>
    </form>
</div>
@endsection
