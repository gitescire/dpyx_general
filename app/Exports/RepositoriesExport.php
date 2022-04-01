<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RepositoriesExport implements FromArray, withHeadings, WithStyles{

    protected $repositories;

    public function __construct(array $repositories)
    {
        $this->repositories = $repositories;
    }


    /**
    * @return \Illuminate\Support\Array
    */
    public function array(): array
    {
        return $this->repositories;
    }

    public function headings(): array
    {
        return [
            'NOMBRE',
            strtoupper(__('containerName')),
            'EVALUACIÓN',
            'ENCARGADO',
            'EVALUADOR'
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
