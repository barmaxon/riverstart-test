<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(30)->create();
        $products = Product::factory()->count(100)->create();
        $products->each(
            fn (Product $product) => $product->categories()->attach(
                $categories->shuffle()->slice(0, random_int(2, 10))->pluck('id')
            )
        );
    }
}
