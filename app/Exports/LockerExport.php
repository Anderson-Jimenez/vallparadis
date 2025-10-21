<?php

namespace App\Exports;
use App\Models\Professional;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LockerExport implements FromQuery, WithHeadings, WithMapping
{
    //Seleccionar quines dades es van a exportar
    public function query()
    {
        return Professional::query()->select('name','surnames','number_locker', 'clue_locker');
    }

    // Definim quins seran els encapçelaments que volem veure al excel
    public function headings(): array
    {
        return [
            'Nom',
            'Cognoms',
            'Número de guixeta',
            'Clau de guixeta',
        ];
    }

    /**
     * Mapea los datos antes de exportarlos (por si quieres formatear algo).
     */
    public function map($professional): array
    {
        return [
            $professional->name,
            $professional->surnames,
            $professional->number_locker,
            $professional->clue_locker,
        ];
    }
}
