<?php

namespace App\Exports;

use App\Models\Professional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UniformsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $professionals = Professional::all();
        $result = [];
        
        foreach ($professionals as $professional) {
            $shirt = $professional->uniforms()
                ->whereNotNull('shirt_size')
                ->orderBy('created_at', 'desc')
                ->value('shirt_size');
                
            $trousers = $professional->uniforms()
                ->whereNotNull('trausers_size')
                ->orderBy('created_at', 'desc')
                ->value('trausers_size');
                
            $shoes = $professional->uniforms()
                ->whereNotNull('shoes_size')
                ->orderBy('created_at', 'desc')
                ->value('shoes_size');
            
            $result[] = [
                'nombre' => $professional->name . ' ' . $professional->surnames,
                'camisa' => $shirt ?: '-',
                'pantalon' => $trousers ?: '-',
                'zapatos' => $shoes ?: '-',
            ];
        }
        
        return collect($result);
    }

    public function headings(): array
    {
        return ['Nombre', 'Camisa', 'Pantalón', 'Zapatos'];
    }
}