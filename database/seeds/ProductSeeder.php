<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*factory(App\Product::class, 4)->create()->each(function ($product) {

      });*/
      Product::create([
        'name' => 'face-mask',
        'image' => 'face-mask',
        'price' => 200,
        'description' => 'Protects from pandemic.'
      ]);

      Product::create([
        'name' => 'sanitiser',
        'image' => 'sanitiser',
        'price' => 500,
        'description' => 'Kills coronavirus'
      ]);

      Product::create([
        'name' => 'garlic',
        'image' => 'garlic',
        'price' => 200,
        'description' => 'absorbs coronavirus, consumption also helps with social distancing'
      ]);
    }
}
