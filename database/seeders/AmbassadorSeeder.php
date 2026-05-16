<?php

namespace Database\Seeders;

use App\Models\Ambassador;
use Illuminate\Database\Seeder;

class AmbassadorSeeder extends Seeder
{
    public function run(): void
    {
        $codes = [
            'MASLACTANCIA',
            'DOULAZUL',
            'MIACONAMOR',
            'DRADANICA',
            'DRAIRMA',
            'LACTAMANTA26',
            'LADOCSANTA',
            'ACUNAR',
            'TIBYDOULA',
            'AIMEMAYU',
        ];

        foreach ($codes as $code) {
            Ambassador::firstOrCreate(
                ['code' => $code],
                [
                    'name'           => 'Embajadora',
                    'last_name'      => '',
                    'email'          => null,
                    'discount_type'  => 'percentage',
                    'discount_value' => 10,
                    'status'         => 'active',
                ]
            );
        }
    }
}
