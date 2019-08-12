<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\personal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResumenViewExport implements FromView
{
   
    public function view() :view
    {
        return view();
    }
}
