
@extends('admin.layouts.app')

@section('title', 'Ekspedisi')
@section('page-heading', 'Manajemen Ekspedisi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ekspedisi.css') }}">
@endpush

@section('content')

<div class="ekspedisi-header">
    <div>
        <h1>Data Ekspedisi</h1>
        <p>Kelola layanan pengiriman produk ToStore.</p>
    </div>

    <a href="{{ route('ekspedisi.create') }}" class="btn-primary">
        + Tambah Ekspedisi
    </a>
</div>

<div class="ekspedisi-table">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Ekspedisi</th>
                <th>Layanan</th>
                <th>Zona</th>
                <th>Tarif</th>
                <th>Estimasi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($ekspedisis as $ekspedisi)
                <tr>
                    <td>{{ $ekspedisis->firstItem() + $loop->index }}</td>
                    <td>{{ $ekspedisi->nama_ekspedisi }}</td>
                    <td>{{ $ekspedisi->layanan }}</td>
                    <td>{{ $ekspedisi->zona }}</td>
                    <td>Rp{{ number_format($ekspedisi->tarif, 0, ',', '.') }}</td>
                    <td>{{ $ekspedisi->estimasi }}</td>
                    <td>
                        <a href="{{ route('ekspedisi.edit', $ekspedisi) }}"
                           class="action-edit">Edit</a>

                        <form action="{{ route('ekspedisi.destroy', $ekspedisi) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ekspedisi?')">
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
                    <td colspan="7">Belum ada data ekspedisi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $ekspedisis->links() }}
    </div>
</div>

@endsection
