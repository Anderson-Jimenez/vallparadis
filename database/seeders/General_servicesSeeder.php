<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class General_servicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('general_services')->insert([
            [
            'center_id' => 1,
            'type' => 'Cuina',
            'manager' => 'Laura Martínez',
            'contact' => 'laura@example.com / 600123123',
            'staff' => 'Equip de cuina format per 5 treballadors fixes i 2 suplents.',
            'schedule' => 'Horari: Dilluns a Divendres de 08:00 a 16:00.',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'center_id' => 1,
            'type' => 'Neteja/Bugaderia',
            'manager' => 'Marc Puig',
            'contact' => 'marc@example.com / 611987654',
            'staff' => 'Equip combinat de neteja i bugaderia amb 5 treballadors.',
            'schedule' => 'Horari: Dilluns a Dissabte de 07:00 a 17:00.',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
