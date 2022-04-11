<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QuestionsStatisticsExport implements FromArray, withHeadings, WithStyles{

    protected $question_statistics;

    public function __construct(array $question_statistics)
    {
        $this->question_statistics = $question_statistics;
    }

    /**
    * @return \Illuminate\Support\Array
    */
    public function array(): array
    {
        return $this->question_statistics;
    }

    public function headings(): array
    {
        return [
            'CATEGORÍA',
            'SUBCATEGORÍA',
            'PREGUNTA',
            'FRECUENCIA'
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
