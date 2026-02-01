<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$roles = [
            'Responsable/Equip Tècnic',
            'Equip Directiu',
            'Administració',
        ];*/

        // Aquí asumimos que existen center_id = 1 y professional_id = 1
        
        DB::table('rols')->insert([
            [
                'center_id' => 1,
                'role' => 'Equip Directiu',
                'power' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center_id' => 1,
                'role' => 'Administratiu',
                'power' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center_id' => 1,
                'role' => 'Responsable/Equip tècnic',
                'power' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center_id' => 1,
                'role' => 'Sense Rol',
                'power' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
        
    }
}
