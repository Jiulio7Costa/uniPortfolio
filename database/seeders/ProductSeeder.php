<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title'=>'Velit et nostrud enim tempor et do ad ipsum consequat ad commodo labore.',
            'price'=> '1230.20',
            'quantity'=>5,
            'category_id'=>1,
            'brand_id'=>1,
            'description'=>'Non est Lorem sunt cupidatat velit pariatur excepteur et enim adipisicing. Deserunt labore pariatur elit Lorem elit dolore mollit magna. Ullamco commodo sunt sunt velit nostrud. Laborum quis excepteur fugiat aliqua do minim occaecat ea consequat. Et laboris nulla culpa aliqua sint officia nulla veniam cillum qui proident deserunt eu mollit.'
        ]);
    }
}
