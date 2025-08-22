<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class IgvAffectationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['code' => '10', 'description' => 'GRAVADO - OPERACIÓN ONEROSA'],
            // ... resto de los tipos
            ['code' => '40', 'description' => 'EXPORTACIÓN'],
        ];

        foreach ($types as &$type) {
            $type['status'] = 1;
            $type['created_at'] = Carbon::now();
            $type['updated_at'] = Carbon::now();
        }

        DB::table('igv_affectation_types')->insert($types);
    }
}
