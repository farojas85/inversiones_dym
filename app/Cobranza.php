<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobranza extends Model
{
    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
