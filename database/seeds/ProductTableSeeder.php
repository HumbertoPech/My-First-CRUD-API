<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use databases\factories\ProductFactory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class)->create([
            'name' => 'Product 1',
            'price' => '25.99'
        ]);

        factory(App\Product::class)->create([
            'name' => 'Product 2',
            'price' => '29.99'
        ]);
    }
}
