<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // ✅ Modelo correcto

class RolSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['nombre' => 'cliente']);
        Role::firstOrCreate(['nombre' => 'proveedor']);
    }
}
