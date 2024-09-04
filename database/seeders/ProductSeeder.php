<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "product_name" => "コーラ",
            "price" => "160",
            "stock" => "6",
            "comment" => "炭酸"
        ]);

        Product::create([
            "product_name" => "お茶",
            "price" => "130",
            "stock" => "4",
            "comment" => "スッキリ"
        ]);
    }
}
