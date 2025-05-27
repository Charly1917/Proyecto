<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CodigoPostal;

class CodigosPostalesSeeder extends Seeder
{
    public function run(): void
    {
        CodigoPostal::insert([
            [
                'codigo_postal' => '01000',
                'colonia' => 'San Ángel',
                'ciudad' => 'Ciudad de México',
                'estado' => 'CDMX',
                'pais' => 'México',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo_postal' => '44100',
                'colonia' => 'Centro',
                'ciudad' => 'Guadalajara',
                'estado' => 'Jalisco',
                'pais' => 'México',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo_postal' => '64000',
                'colonia' => 'Monterrey Centro',
                'ciudad' => 'Monterrey',
                'estado' => 'Nuevo León',
                'pais' => 'México',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
