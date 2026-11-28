
@extends('admin.layouts.app')

@section('title', 'Detail Ekspedisi')
@section('page-heading', 'Detail Ekspedisi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ekspedisi.css') }}">
@endpush

@section('content')

<div class="ekspedisi-header">
    <div>
        <h1>Detail Ekspedisi</h1>
        <p>Informasi lengkap layanan pengiriman.</p>
    </div>

    <a href="{{ route('ekspedisi.index') }}" class="btn-secondary">
        Kembali
    </a>
</div>

<div class="detail-ekspedisi-card">

    <div class="detail-ekspedisi-item">
        <label>Nama Ekspedisi</label>
        <p>{{ $ekspedisi->nama_ekspedisi }}</p>
    </div>

    <div class="detail-ekspedisi-item">
        <label>Jenis Layanan</label>
        <p>{{ $ekspedisi->layanan }}</p>
    </div>

    <div class="detail-ekspedisi-item">
        <label>Zona Pengiriman</label>
        <p>{{ $ekspedisi->zona }}</p>
    </div>

    <div class="detail-ekspedisi-item">
        <label>Tarif Pengiriman</label>
        <p>Rp{{ number_format($ekspedisi->tarif, 0, ',', '.') }}</p>
    </div>

    <div class="detail-ekspedisi-item">
        <label>Estimasi Pengiriman</label>
        <p>{{ $ekspedisi->estimasi }}</p>
    </div>

    <div class="detail-ekspedisi-actions">
        <a href="{{ route('ekspedisi.edit', $ekspedisi) }}" class="btn-primary">
            Edit Ekspedisi
        </a>
    </div>

</div>

@endsection
