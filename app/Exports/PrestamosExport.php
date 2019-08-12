<?php

namespace App\Exports;

use App\Prestamo;
use App\Cliente;
use App\personal;
use App\personalMonto;
use App\Cobranza;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class PrestamosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prestamo::all();
    }
}
