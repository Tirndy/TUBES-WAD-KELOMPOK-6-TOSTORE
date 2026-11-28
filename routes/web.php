<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlamatPengirimanController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Login dan Registrasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Fitur akun pembeli
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');

    // Alamat pengiriman
    Route::get('/alamat', [AlamatPengirimanController::class, 'index'])->name('alamat.index');
    Route::post('/alamat', [AlamatPengirimanController::class, 'store'])->name('alamat.store');
    Route::put('/alamat/{id}', [AlamatPengirimanController::class, 'update'])->name('alamat.update');
    Route::delete('/alamat/{id}', [AlamatPengirimanController::class, 'destroy'])->name('alamat.destroy');
    Route::put('/alamat/{id}/default', [AlamatPengirimanController::class, 'setDefault'])->name('alamat.default');
});

// Admin
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