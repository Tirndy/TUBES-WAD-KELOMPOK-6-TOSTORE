
@extends('admin.layouts.app')

@section('title', 'Edit Brand')
@section('page-heading', 'Edit Brand')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brands.css') }}">
@endpush

@section('content')
<div class="brand-form-container">
    <div class="brand-form-header">
        <div>
            <h2>Edit Brand</h2>
            <p>Perbarui informasi brand.</p>
        </div>
        <a href="{{ route('brands.index') }}" class="btn-secondary">Kembali</a>
    </div>

    <form action="{{ route('brands.update', $brand->id) }}" method="POST" class="brand-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Brand</label>
            <input type="text" id="name" name="name"
                value="{{ old('name', $brand->name) }}" required>
            @error('name')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug"
                value="{{ old('slug', $brand->slug) }}" required>
            @error('slug')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $brand->description) }}</textarea>
            @error('description')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="logo">Path Logo</label>
            <input type="text" id="logo" name="logo"
                value="{{ old('logo', $brand->logo) }}">
            @error('logo')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" required>
                <option value="1" {{ old('is_active', $brand->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active', $brand->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            @error('is_active')
                <small class="form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="brand-form-actions">
            <a href="{{ route('brands.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
