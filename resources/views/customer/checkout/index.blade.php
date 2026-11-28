
@extends('customer.layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="checkout-page">

    <div class="checkout-heading">
        <h1>Checkout</h1>
        <p>Periksa pesanan dan pilih jasa pengirimanmu.</p>
    </div>

    <div class="checkout-container">

        <div class="checkout-left">

            {{-- ALAMAT PENGIRIMAN --}}
            <div class="checkout-card">
                <h2>Alamat Pengiriman</h2>

                <div class="address-box">
                    <div>
                        <strong>Naili Samrotul Masroh</strong>
                        <span>0812-3456-7890</span>
                    </div>

                    <p>
                        Jl. Telekomunikasi, Terusan Buahbatu,
                        Kabupaten Bandung, Jawa Barat.
                    </p>

                    <span class="address-label">Alamat Utama</span>
                </div>

                <p class="simulation-note">
                </p>
            </div>

            {{-- PILIH EKSPEDISI --}}
            <div class="checkout-card">
                <h2>Pilih Jasa Pengiriman</h2>

                <p class="card-description">
                    Pilih ekspedisi dan layanan pengiriman yang tersedia.
                </p>

                <div class="shipping-options">

                    @forelse ($ekspedisis as $ekspedisi)

                        <label class="shipping-option">

                            <input
                                type="radio"
                                name="ekspedisi"
                                value="{{ $ekspedisi->tarif }}"
                                data-name="{{ $ekspedisi->nama_ekspedisi }} - {{ $ekspedisi->layanan }}"
                                data-estimasi="{{ $ekspedisi->estimasi }}"
                                {{ $loop->first ? 'checked' : '' }}
                            >

                            <div class="shipping-info">
                                <div>
                                    <strong>{{ $ekspedisi->nama_ekspedisi }}</strong>
                                    <span>{{ $ekspedisi->layanan }}</span>
                                </div>

                                <p>
                                    Zona: {{ $ekspedisi->zona }}
                                    | Estimasi: {{ $ekspedisi->estimasi }}
                                </p>
                            </div>

                            <strong class="shipping-price">
                                Rp{{ number_format($ekspedisi->tarif, 0, ',', '.') }}
                            </strong>

                        </label>

                    @empty

                        <p>Belum ada jasa ekspedisi yang tersedia.</p>

                    @endforelse

                </div>
            </div>

        </div>

        {{-- RINGKASAN PESANAN --}}
        <div class="checkout-right">

            <div class="checkout-card order-summary">

                <h2>Ringkasan Pesanan</h2>

                <div class="product-summary">
                    <div class="product-placeholder">Produk</div>

                    <div>
                        <strong>Wireless Headphone</strong>
                        <p>Jumlah: 1</p>
                        <span>Rp300.000</span>
                    </div>
                </div>

                <div class="summary-line">
                    <span>Subtotal Produk</span>
                    <strong>Rp300.000</strong>
                </div>

                <div class="summary-line">
                    <span>Ongkos Kirim</span>
                    <strong id="shipping-cost">Rp0</strong>
                </div>

                <div class="summary-line total-line">
                    <span>Total Pembayaran</span>
                    <strong id="total-price">Rp300.000</strong>
                </div>

                <button
                    type="button"
                    class="checkout-button"
                    id="continue-payment"
                >
                    Lanjut ke Pembayaran
                </button>

                <p class="simulation-note">
                </p>

            </div>

        </div>

    </div>

</div>

<script>
    const shippingOptions = document.querySelectorAll(
        'input[name="ekspedisi"]'
    );

    const shippingCost = document.getElementById('shipping-cost');
    const totalPrice = document.getElementById('total-price');

    const subtotal = 300000;

    function formatRupiah(number) {
        return 'Rp' + number.toLocaleString('id-ID');
    }

    function updateTotal() {
        const selected = document.querySelector(
            'input[name="ekspedisi"]:checked'
        );

        const ongkir = selected ? Number(selected.value) : 0;

        shippingCost.textContent = formatRupiah(ongkir);
        totalPrice.textContent = formatRupiah(subtotal + ongkir);
    }

    shippingOptions.forEach(option => {
        option.addEventListener('change', updateTotal);
    });

    updateTotal();

    document.getElementById('continue-payment').addEventListener('click', function () {

        const selected = document.querySelector(
            'input[name="ekspedisi"]:checked'
        );

        if (!selected) {
            alert('Silakan pilih jasa ekspedisi terlebih dahulu!');
            return;
        }

        const ongkir = selected.value;
        const namaEkspedisi = selected.dataset.name;

        const url = new URL(
            '/customer/pembayaran',
            window.location.origin
        );

        url.searchParams.set('ongkir', ongkir);
        url.searchParams.set('namaEkspedisi', namaEkspedisi);

        window.location.href = url.toString();

    });

</script>

@endsection
