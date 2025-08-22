<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('providers')->insert([
            [
                'name' => 'Tech Supplies Co.',
                'ruc' => '20123456789',
                'email' => 'contact@techsupplies.com',
                'phone' => '987654321',
                'address' => 'Av. Tecnológica 123',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Global Distributors',
                'ruc' => '20456789123',
                'email' => 'ventas@globald.com',
                'phone' => '923456789',
                'address' => 'Calle Comercio 456',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Importaciones El Mundo',
                'ruc' => '20345678901',
                'email' => 'info@elmundo.com',
                'phone' => '912345678',
                'address' => 'Jr. Importadores 789',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
