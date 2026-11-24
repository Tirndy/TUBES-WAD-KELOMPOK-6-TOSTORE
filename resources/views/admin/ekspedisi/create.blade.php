
@extends('admin.layouts.app')

@section('title', 'Tambah Ekspedisi')
@section('page-heading', 'Tambah Ekspedisi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ekspedisi.css') }}">
@endpush

@section('content')

<div class="ekspedisi-header">
    <div>
        <h1>Tambah Ekspedisi</h1>
        <p>Tambahkan layanan pengiriman baru ke ToStore.</p>
    </div>

    <a href="{{ route('ekspedisi.index') }}" class="btn-secondary">
        Kembali
    </a>
</div>

<div class="ekspedisi-form">
    <form action="{{ route('ekspedisi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_ekspedisi">Nama Ekspedisi</label>
            <input type="text"
                   id="nama_ekspedisi"
                   name="nama_ekspedisi"
                   value="{{ old('nama_ekspedisi') }}"
                   placeholder="Contoh: JNE"
                   required>
            @error('nama_ekspedisi')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="layanan">Jenis Layanan</label>
            <select id="layanan" name="layanan" required>
                <option value="">Pilih Layanan</option>
                @foreach($layananList as $layanan)
                    <option value="{{ $layanan }}"
                        {{ old('layanan') == $layanan ? 'selected' : '' }}>
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
                <option value="">Pilih Zona</option>
                @foreach($zonaList as $zona)
                    <option value="{{ $zona }}"
                        {{ old('zona') == $zona ? 'selected' : '' }}>
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
                   value="{{ old('tarif') }}"
                   placeholder="Contoh: 15000"
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
                   value="{{ old('estimasi') }}"
                   placeholder="Contoh: 2-3 hari"
                   required>
            @error('estimasi')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Simpan Ekspedisi
            </button>
        </div>
    </form>
</div>

@endsection
