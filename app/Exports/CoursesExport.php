<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Professional;
use App\Models\Professional_course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CoursesExport implements FromCollection, WithHeadings, WithMapping
{
    //Seleccionar quines dades es van a exportar
    public function collection()
    {
        return Professional_course::with([
            'professional', // Relación con Professional
            'course'         // Relación con Course
        ])->get();
    }

    // Definim quins seran els encapçelaments que volem veure al excel
    public function headings(): array
    {
        return [
            'Nom professional',
            'Nom curs',
            'Data de inici',
            'Data de finalització',
        ];
    }

    /**
     * Mapea los datos antes de exportarlos (por si quieres formatear algo).
     */
    public function map($row): array
    {
        return [
            $row->professional->name . ' ' . $row->professional->surnames, // Nombre completo del professional
            $row->course->training_name,                                    // Nombre del curso
            $row->start_date,                                               // Fecha inicio
            $row->end_date,                                                 // Fecha fin
        ];
    }
}
