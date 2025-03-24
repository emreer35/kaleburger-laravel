<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $categoires = Category::factory(10)->create();

        // foreach($categoires as $category){
        //     $products = Product::factory(7)->create([
        //         'category_id' => $category->id
        //     ]);
        //     foreach ($products as $product) {
        //         ProductOption::factory(3)->create([
        //             'product_id' => $product->id
        //         ]);
        //     }
        // }

        User::query()->create([
            'name' => 'Galip Han Topak',
            'email' => 'kaleburger@gmail.com',
            'password' => Hash::make('kale123')
        ]);
    }
}
