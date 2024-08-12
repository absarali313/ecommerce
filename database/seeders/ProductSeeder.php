<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory()->count(20)->create();

        // Establish relationships
        foreach ($products as $product) {
            $relatedProducts = $products->random(rand(1, 5))->pluck('id')->toArray();
            $relatedProducts = array_diff($relatedProducts, [$product->id]);
            $product->relatedProducts()->attach($relatedProducts);
        }

        $this->call(ProductImageSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
