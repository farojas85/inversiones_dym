<?php

namespace App\Exports;

use App\PersonalGasto;
use Maatwebsite\Excel\Concerns\FromCollection;

class PersonalGastosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PersonalGasto::all();
    }
}
