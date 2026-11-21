
@extends('admin.layouts.app')

@section('title', 'Edit Kategori')
@section('page-heading', 'Edit Kategori')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endpush

@section('content')
<div class="category-form-container">
    <div class="category-form-header">
        <div>
            <h2>Edit Kategori</h2>
            <p>Ubah informasi kategori produk.</p>
        </div>

        <a href="{{ route('categories.index') }}" class="btn-secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="category-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
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
                value="{{ old('slug', $category->slug) }}"
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
            >{{ old('description', $category->description) }}</textarea>
            @error('description')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" required>
                <option value="1" {{ old('is_active', $category->is_active) == '1' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0" {{ old('is_active', $category->is_active) == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>
            @error('is_active')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="category-form-actions">
            <a href="{{ route('categories.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
