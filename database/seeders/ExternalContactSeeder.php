<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\External_Contacts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExternalContactSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name'          => 'Pedro',
                'type'          => 'assistencials',
                'purpose_type'  => 'motiu',
                'purpose'       => 'Coordinació de pacient extern',
                'origin_type'   => 'company',
                'organization'  => 'Hospital Sant Joan',
                'manager'       => 'Anna Riera',
                'phone_numer'   => '934556677',
                'email_address' => 'anna.riera@hsj.cat',
                'comments'      => 'Contacte habitual per derivacions.',
            ],

            [
                'name'          => 'Lucia',
                'type'          => 'serveis generals',
                'purpose_type'  => 'servei',
                'purpose'       => 'Manteniment i reparacions',
                'origin_type'   => 'company',
                'organization'  => 'TecnoServei SL',
                'manager'       => 'Marc Vidal',
                'phone_numer'   => '932224455',
                'email_address' => 'm.vidal@tecnoservei.com',
                'comments'      => 'Servei extern de manteniment mensual.',
            ],

            [
                'name'          => 'Javier',
                'type'          => 'assistencials',
                'purpose_type'  => 'servei',
                'purpose'       => 'Subministrament de material mèdic',
                'origin_type'   => 'company',
                'organization'  => 'Mediproveïments SA',
                'manager'       => 'Laura Puig',
                'phone_numer'   => '933112233',
                'email_address' => 'l.puig@mediprove.cat',
                'comments'      => 'Proveïdor principal de material quirúrgic.',
            ],

            [
                'name'          => 'Max',
                'type'          => 'serveis generals',
                'purpose_type'  => 'motiu',
                'purpose'       => 'Gestió d\'incidències informàtiques',
                'origin_type'   => 'department',
                'organization'  => 'Departament TIC',
                'manager'       => 'Jordi Pons',
                'phone_numer'   => '900112200',
                'email_address' => 'tic@centre.com',
                'comments'      => 'Incidències recurrents amb sistemes interns.',
            ],

            [
                'name'          => 'Marta',
                'type'          => 'assistencials',
                'purpose_type'  => 'motiu',
                'purpose'       => 'Coordinació emergències',
                'origin_type'   => 'department',
                'organization'  => 'SAMU 061',
                'manager'       => 'Helena Martí',
                'phone_numer'   => '061',
                'email_address' => 'emergencies@samu.cat',
                'comments'      => 'Contacte d’urgències mèdiques.',
            ],
        ];

        foreach ($data as $item) {
            External_Contacts::create($item);
        }
    }
}
