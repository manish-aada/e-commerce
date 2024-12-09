<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'Description for product 1',
            'price' => 100,
            'image' => 'default.png',
            'quantity' => 10,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Description for product 2',
            'price' => 200,
            'image' => 'default.png',
            'quantity' => 10,
        ]);
        Product::create([
            'name' => 'Product 3',
            'description' => 'Description for product 3',
            'price' => 200,
            'image' => 'default.png',
            'quantity' => 10,
        ]);

        Product::create([
            'name' => 'Product 4',
            'description' => 'Description for product 4',
            'price' => 200,
            'image' => 'default.png',
            'quantity' => 10,
        ]);
        Product::create([
            'name' => 'Product 5',
            'description' => 'Description for product 5',
            'price' => 200,
            'image' => 'default.png',
            'quantity' => 10,
        ]);

    }
    
}
