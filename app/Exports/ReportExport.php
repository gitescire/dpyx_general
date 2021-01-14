<?php

namespace App\Exports;

use App\Models\Repository;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Repository::all();
    }
}
