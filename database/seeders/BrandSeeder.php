<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
   {
        Brand::firstOrCreate([
            'name' => 'Dell',
            'slug' => 'dell'
        ]);

        Brand::firstOrCreate([
            'name' => 'Samsung',
            'slug' => 'samsung'
        ]);

        Brand::firstOrCreate([
            'name' => 'Apple',
            'slug' => 'apple'
        ]);

        Brand::firstOrCreate([
            'name' => 'Asus',
            'slug' => 'asus'
        ]);
        Brand::firstOrCreate([
            'name' => 'HP',
            'slug' => 'hp'
        ]);

        Brand::firstOrCreate([
            'name' => 'Lenovo',
            'slug' => 'lenovo'
        ]);

        Brand::firstOrCreate([
            'name' => 'Acer',
            'slug' => 'acer'
        ]);

        Brand::firstOrCreate([
            'name' => 'Toshiba',
            'slug' => 'toshiba'
        ]);

        Brand::firstOrCreate([
            'name' => 'Huawei',
            'slug' => 'huawei'
        ]);

    }
}

