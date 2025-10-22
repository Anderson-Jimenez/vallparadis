<?php

namespace App\Exports;

use App\Models\Professional;
use App\Models\Uniform;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UniformsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Uniform::query()
            ->with('professional')
            ->select('professional_id', 'shirt_size', 'trausers_size', 'shoes_size')->orderBy('professional_id');
    }


    public function headings(): array
    {
        return [
            'Nombre del Profesional',
            'Talla Camisa',
            'Talla Pantalón',
            'Talla Sabates',
        ];
    }

    public function map($uniform): array
    {
        return [
            $uniform->professional ? $uniform->professional->name . ' ' . $uniform->professional->surnames : 'Sin asignar',

            $uniform->shirt_size,
            $uniform->trausers_size,
            $uniform->shoes_size,
        ];
    }
}