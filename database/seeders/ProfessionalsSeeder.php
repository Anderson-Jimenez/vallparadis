<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfessionalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professionals')->insert([
            [
                'center_id'     => 1,
                'name'          => 'Admin',
                'surnames'      => 'Principal',
                'username'      => 'admin',
                'password'      => Hash::make('1234'),
                'phone_number'  => '600123456',
                'email_address' => 'admin@vallparadis.cat',
                'address'       => 'Carrer Major 123',
                'number_locker' => 12,
                'clue_locker'   => 'A1B2C3',
                'link_status'   => 'Actiu',
                'status'   => 'active',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'center_id'     => 1,
                'name'          => 'Laura',
                'surnames'      => 'Pérez Gómez',
                'username'      => 'lperez',
                'password'      => Hash::make('12345'),
                'phone_number'  => '600654321',
                'email_address' => 'lperez@vallparadis.cat',
                'address'       => 'Av. Catalunya 45',
                'number_locker' => 8,
                'clue_locker'   => 'D4E5F6',
                'link_status'   => 'Baixa',
                'status'   => 'inactive',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
