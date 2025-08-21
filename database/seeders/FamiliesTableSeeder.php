<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FamiliesTableSeeder extends Seeder
{
    public function run()
    {
        $families = [
            'ELECTRÓNICA',
            'ROPA',
            'ALIMENTOS',
            'HOGAR',
            'JUGUETES',
            'DEPORTES',
            'BELLEZA',
            'SALUD',
            'AUTOMOTRIZ',
            'LIBROS',
            'OFICINA',
            'MASCOTAS',
        ];


        foreach ($families as $family) {
            DB::table('families')->insert([
                'name' => $family,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
