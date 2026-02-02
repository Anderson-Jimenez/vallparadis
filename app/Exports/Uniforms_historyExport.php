<?php

namespace App\Exports;

use App\Models\Professional;
use App\Models\Uniform;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Uniforms_historyExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Uniform::query()
            ->with('professional')
            ->select('professional_id', 'shirt_size', 'trausers_size', 'shoes_size', 'renovation_date')
            ->orderBy('created_at', 'desc');
    }


    public function headings(): array
    {
        return [
            'Nombre del Profesional',
            'Talla Camisa',
            'Talla Pantalón',
            'Talla Sabates',
            'Fecha de Renovación', 
        ];
    }

    public function map($uniform): array
    {
        return [
            $uniform->professional ? $uniform->professional->name . ' ' . $uniform->professional->surnames : 'Sin asignar',

            $uniform->shirt_size,
            $uniform->trausers_size,
            $uniform->shoes_size,
            $uniform->renovation_date,
        ];
    }
}