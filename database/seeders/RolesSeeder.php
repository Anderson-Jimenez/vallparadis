<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Responsable',
            'Equip Tècnic',
            'Equip Directiu',
            'Administració',
        ];

        // Aquí asumimos que existen center_id = 1 y professional_id = 1
        foreach ($roles as $rol) {
            DB::table('roles')->insert([
                'center_id' => 1,
                'professional_id' => 1,
                'rol' => $rol,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
