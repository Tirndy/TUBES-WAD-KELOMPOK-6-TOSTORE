<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

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
});
