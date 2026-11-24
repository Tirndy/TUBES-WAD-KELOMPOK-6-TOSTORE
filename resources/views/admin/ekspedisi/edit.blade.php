
@extends('admin.layouts.app')

@section('title', 'Edit Ekspedisi')
@section('page-heading', 'Edit Ekspedisi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ekspedisi.css') }}">
@endpush

@section('content')

<div class="ekspedisi-header">
    <div>
        <h1>Edit Ekspedisi</h1>
        <p>Perbarui informasi layanan pengiriman.</p>
    </div>

    <a href="{{ route('ekspedisi.index') }}" class="btn-secondary">
        Kembali
    </a>
</div>

<div class="ekspedisi-form">
    <form action="{{ route('ekspedisi.update', $ekspedisi) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_ekspedisi">Nama Ekspedisi</label>
            <input type="text"
                   id="nama_ekspedisi"
                   name="nama_ekspedisi"
                   value="{{ old('nama_ekspedisi', $ekspedisi->nama_ekspedisi) }}"
                   required>
            @error('nama_ekspedisi')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="layanan">Jenis Layanan</label>
            <select id="layanan" name="layanan" required>
                @foreach($layananList as $layanan)
                    <option value="{{ $layanan }}"
                        {{ old('layanan', $ekspedisi->layanan) == $layanan ? 'selected' : '' }}>
                        {{ $layanan }}
                    </option>
                @endforeach
            </select>
            @error('layanan')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="zona">Zona Pengiriman</label>
            <select id="zona" name="zona" required>
                @foreach($zonaList as $zona)
                    <option value="{{ $zona }}"
                        {{ old('zona', $ekspedisi->zona) == $zona ? 'selected' : '' }}>
                        {{ $zona }}
                    </option>
                @endforeach
            </select>
            @error('zona')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="tarif">Tarif Pengiriman (Rp)</label>
            <input type="number"
                   id="tarif"
                   name="tarif"
                   value="{{ old('tarif', $ekspedisi->tarif) }}"
                   min="0"
                   required>
            @error('tarif')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="estimasi">Estimasi Pengiriman</label>
            <input type="text"
                   id="estimasi"
                   name="estimasi"
                   value="{{ old('estimasi', $ekspedisi->estimasi) }}"
                   required>
            @error('estimasi')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection
