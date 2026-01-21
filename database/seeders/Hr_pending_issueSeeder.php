<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Hr_pending_issueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hr_pending_issue')->insert([
        [
            'center_id' => 1,
            'opened_at' => '2025-01-10',
            'affected_professional_id' => 1,
            'description' => 'Problema amb la planificació de torns del professional.',
            'registered_by_professional_id' => 2,
            'derived_to_professional_id' => 3,
            'status' => 'in_process',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'center_id' => 1,
            'opened_at' => '2025-01-18',
            'affected_professional_id' => 2,
            'description' => 'Incidència urgent relacionada amb absència no justificada.',
            'registered_by_professional_id' => 1,
            'derived_to_professional_id' => null,
            'status' => 'urgent',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }
}
