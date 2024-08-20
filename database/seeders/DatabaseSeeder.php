<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(1)->create();
         User::create([
             'name' => 'Admin',
             'email' => 'admin@admin.com',
             'password' => '123',
             'is_admin' => true,
         ]);
        $this->call(ProductSeeder::class);
        $products = Product::get();
        foreach ($products as $product) {
            $product->sort_order = $product->id;
            $product->save();
        }
    }
}
