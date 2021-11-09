<?php

namespace App\Exports;

use App\Models\Pendapatan as ModelsPendapatan;
use App\Pendapatan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendapatanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ModelsPendapatan::all();     
    }
}
