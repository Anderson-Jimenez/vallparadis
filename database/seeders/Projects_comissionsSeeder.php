<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Projects_comissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects_comissions')->insert([
            [
                'center_id' => 1,
                'professional_manager_id' => 2,
                'name' => 'Projecte de renovació d\'aules',
                'start_date' => '2025-03-15',
                'description' => 'Renovació completa de les aules principals del centre educatiu.',
                'observation' => 'Pendent d\'aprovació final per part de la direcció.',
                'type' => 'Projecte',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center_id' => 1,
                'professional_manager_id' => 1,
                'name' => 'Comissió d\'innovació educativa',
                'start_date' => '2025-04-01',
                'description' => 'Equip encarregat de desenvolupar noves metodologies d\'aprenentatge digital.',
                'observation' => 'Reunions mensuals amb el comitè pedagògic.',
                'type' => 'Comissió',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center_id' => 1,
                'professional_manager_id' => 1,
                'name' => 'Projecte de sostenibilitat ambiental',
                'start_date' => '2025-05-10',
                'description' => 'Implementació de plaques solars i millora del sistema de reciclatge del centre.',
                'observation' => 'Finançat parcialment per un programa europeu.',
                'type' => 'Projecte',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center_id' => 1,
                'professional_manager_id' => 2,
                'name' => 'Comissió de convivència escolar',
                'start_date' => '2025-02-01',
                'description' => 'Grup de treball destinat a millorar el clima escolar i la resolució de conflictes.',
                'observation' => 'Funciona des de fa tres cursos consecutius.',
                'type' => 'Comissió',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
