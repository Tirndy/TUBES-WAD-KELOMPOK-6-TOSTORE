
@extends('customer.layouts.app')

@section('title', 'Pembayaran')

@section('content')

<div class="checkout-page">

    <div class="checkout-heading">
        <h1>Pembayaran</h1>
        <p>Periksa kembali pesananmu sebelum melanjutkan.</p>
    </div>

    <div class="checkout-container">

        <div class="checkout-left">

            <div class="checkout-card">
                <h2>Detail Pesanan</h2>

                <div class="product-summary">
                    <div class="product-placeholder">Produk</div>

                    <div>
                        <strong>Wireless Headphone</strong>
                        <p>Jumlah: 1</p>
                        <span>Rp300.000</span>
                    </div>
                </div>
            </div>

            <div class="checkout-card">
                <h2>Metode Pembayaran</h2>

                <p class="card-description">
                    Pilih metode pembayaran yang tersedia.
                </p>

                <div class="shipping-options">

                    <label class="shipping-option">
                        <input type="radio" name="metode" value="Transfer Bank" checked>
                        <div class="shipping-info">
                            <div>
                                <strong>Transfer Bank</strong>
                            </div>
                            <p>Pembayaran melalui transfer bank.</p>
                        </div>
                    </label>

                    <label class="shipping-option">
                        <input type="radio" name="metode" value="E-Wallet">
                        <div class="shipping-info">
                            <div>
                                <strong>E-Wallet</strong>
                            </div>
                            <p>Pembayaran melalui dompet digital.</p>
                        </div>
                    </label>

                    <label class="shipping-option">
                        <input type="radio" name="metode" value="COD">
                        <div class="shipping-info">
                            <div>
                                <strong>COD</strong>
                            </div>
                            <p>Bayar ketika pesanan diterima.</p>
                        </div>
                    </label>

                </div>
            </div>

        </div>

        <div class="checkout-right">

            <div class="checkout-card order-summary">
                <h2>Ringkasan Pembayaran</h2>

                <div class="summary-line">
                    <span>Subtotal Produk</span>
                    <strong>Rp300.000</strong>
                </div>

                <div class="summary-line">
                    <span>Ongkos Kirim</span>
                    <strong id="payment-shipping">
                        Rp{{ number_format($ongkir ?? 0, 0, ',', '.') }}
                    </strong>
                </div>

                <div class="summary-line">
                    <span>Ekspedisi</span>
                    <strong>{{ $namaEkspedisi ?? '-' }}</strong>
                </div>

                <div class="summary-line total-line">
                    <span>Total Pembayaran</span>
                    <strong id="payment-total">
                        Rp{{ number_format(300000 + ($ongkir ?? 0), 0, ',', '.') }}
                    </strong>
                </div>

                <button
                    type="button"
                    class="checkout-button"
                >
                    Konfirmasi Pembayaran
                </button>

                <p class="simulation-note">
                </p>

            </div>

        </div>

    </div>

</div>

@endsection
