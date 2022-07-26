<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'price' => '100',
                'category' => 'category 1',
                'description' => 'description 1',
                'gallery' => 'https://blog.hubspot.com/hubfs/mobile-phone-photography.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'price' => '200',
                'category' => 'category 2',
                'description' => 'description 2',
                'gallery' => 'https://blog.hubspot.com/hubfs/mobile-phone-photography.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'price' => '300',
                'category' => 'category 3',
                'description' => 'description 3',
                'gallery' => 'https://blog.hubspot.com/hubfs/mobile-phone-photography.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 4',
                'price' => '400',
                'category' => 'category 4',
                'description' => 'description 4',
                'gallery' => 'https://blog.hubspot.com/hubfs/mobile-phone-photography.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 5',
                'price' => '500',
                'category' => 'category 5',
                'description' => 'description 5',
                'gallery' => 'https://blog.hubspot.com/hubfs/mobile-phone-photography.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 6',
                'price' => '600',
                'category' => 'category 6',
                'description' => 'description 6',
                'gallery' => 'https://blog.hubspot.com/hubfs/mobile-phone-photography.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
