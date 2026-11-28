<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EkspedisiController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Ekspedisi;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'brandCount' => Brand::count(),
            'activeProducts' => Product::where('status', 'active')->count(),
            'latestProducts' => Product::with(['category', 'brand'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('ekspedisi', EkspedisiController::class);
});

// CUSTOMER - CHECKOUT
Route::get('/customer/checkout', function () {
    $ekspedisis = Ekspedisi::orderBy('tarif', 'asc')->get();

    return view('customer.checkout.index', compact('ekspedisis'));
})->name('customer.checkout');



Route::get('/customer/pembayaran', function () {

    $ongkir = max(0, (int) request('ongkir', 0));
    $namaEkspedisi = request('namaEkspedisi', '-');

    return view('customer.checkout.pembayaran', [
        'ongkir' => $ongkir,
        'namaEkspedisi' => $namaEkspedisi,
    ]);

})->name('customer.pembayaran');


Route::get('/customer/konfirmasi', function () {
    return view('customer.checkout.konfirmasi');
})->name('customer.konfirmasi');
