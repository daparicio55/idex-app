<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;

class NotasExcel implements ToArray
{
    /**
    * @param Collection $collection
    */
    use Importable;
    public function array(Array $rows)
    {
       
    }
}
