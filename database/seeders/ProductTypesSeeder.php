<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypesSeeder extends Seeder
{
    public function run()
    {
        // Inserta 3 tipos de productos. Asume que category_id 1, 2, 3 existen.
        DB::table('product_types')->insert([
            ['category_id' => 1, 'name' => 'Android Phones', 'description' => 'Smartphones running Android OS', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Double Door Fridges', 'description' => 'Two-door refrigerators', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Mesh Chairs', 'description' => 'Ergonomic mesh office chairs', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
