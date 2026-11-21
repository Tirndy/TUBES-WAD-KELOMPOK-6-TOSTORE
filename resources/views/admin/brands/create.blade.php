
@extends('admin.layouts.app')

@section('title', 'Tambah Brand')
@section('page-heading', 'Tambah Brand')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brands.css') }}">
@endpush

@section('content')
<div class="brand-form-container">
    <div class="brand-form-header">
        <div>
            <h2>Tambah Brand</h2>
            <p>Tambahkan brand baru ke katalog ToStore.</p>
        </div>
        <a href="{{ route('brands.index') }}" class="btn-secondary">Kembali</a>
    </div>

    <form action="{{ route('brands.store') }}" method="POST" class="brand-form">
        @csrf

        <div class="form-group">
            <label for="name">Nama Brand</label>
            <input type="text" id="name" name="name"
                value="{{ old('name') }}" placeholder="Masukkan nama brand" required>
            @error('name')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug"
                value="{{ old('slug') }}" placeholder="Contoh: nike" required>
            @error('slug')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                placeholder="Deskripsi brand">{{ old('description') }}</textarea>
            @error('description')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="logo">Path Logo</label>
            <input type="text" id="logo" name="logo"
                value="{{ old('logo') }}" placeholder="Contoh: brands/nike.png">
            @error('logo')
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

        <div class="brand-form-actions">
            <a href="{{ route('brands.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Brand</button>
        </div>
    </form>
</div>
@endsection
