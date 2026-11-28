<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Data contoh untuk fitur diskon/checkout (jalankan manual):
 *   php artisan db:seed --class=CheckoutDemoSeeder
 * Aman dijalankan berulang (pakai updateOrInsert / firstOrCreate).
 */
class CheckoutDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Voucher
        $vouchers = [
            ['kode' => 'HEMAT10',  'nama' => 'Diskon 10%', 'persen' => 10, 'min_belanja' => 100000],
            ['kode' => 'HEMAT20',  'nama' => 'Diskon 20%', 'persen' => 20, 'min_belanja' => 500000],
            ['kode' => 'SUPER30',  'nama' => 'Diskon 30%', 'persen' => 30, 'min_belanja' => 1000000],
        ];
        foreach ($vouchers as $v) {
            Voucher::updateOrCreate(['kode' => $v['kode']], $v + ['aktif' => true]);
        }

        // Produk contoh (hanya jika tabel products masih kosong; products.category_id wajib terisi)
        if (Product::count() === 0) {
            $now = now();
            $categoryId = DB::table('categories')->where('slug', 'umum')->value('id')
                ?? DB::table('categories')->insertGetId([
                    'name' => 'Umum', 'slug' => 'umum', 'is_active' => 1,
                    'created_at' => $now, 'updated_at' => $now,
                ]);

            $items = [
                ['Kaos Polos',   'kaos-polos',   'SKU-001',  75000],
                ['Celana Jeans', 'celana-jeans', 'SKU-002', 250000],
                ['Jaket Hoodie', 'jaket-hoodie', 'SKU-003', 350000],
                ['Sepatu Sneakers', 'sepatu-sneakers', 'SKU-004', 600000],
            ];
            foreach ($items as [$name, $slug, $sku, $price]) {
                Product::create([
                    'category_id' => $categoryId,
                    'name' => $name, 'slug' => $slug, 'sku' => $sku,
                    'price' => $price, 'status' => 'active',
                ]);
            }
        }
    }
}
