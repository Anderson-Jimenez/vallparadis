<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('courses')->insert([
            [
                'center_id' => 1,
                'code_forcem' => 'HORTA',
                'hours' => 40,
                'type' => 'FORMACIÓ INTERNA',
                'mode' => 'PRESENCIAL',
                'training_name' => 'Formació en atenció i cures bàsiques',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'center_id' => 1,
                'code_forcem' => 'LA PINEDA',
                'hours' => 30,
                'type' => 'FORMACIÓ EXTERNA',
                'mode' => 'ON LINE',
                'training_name' => 'Prevenció de riscos laborals',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'center_id' => 1,
                'code_forcem' => 'AMETLLA',
                'hours' => 25,
                'type' => 'FORMACIÓ SALUT LABORAL',
                'mode' => 'MIXTE',
                'training_name' => 'Salut laboral i ergonomia',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'center_id' => 1,
                'code_forcem' => 'M. BETRIU',
                'hours' => 20,
                'type' => 'JORN/TALLER/SEMINARI/CONGRÉS',
                'mode' => 'PRESENCIAL',
                'training_name' => 'Taller de comunicació efectiva',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
