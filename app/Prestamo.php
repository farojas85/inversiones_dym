<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}