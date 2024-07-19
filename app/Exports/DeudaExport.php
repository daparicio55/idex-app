<?php

namespace App\Exports;

use App\Models\Deuda;
use Maatwebsite\Excel\Concerns\FromCollection;

class DeudaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Deuda::all();
    }
}
