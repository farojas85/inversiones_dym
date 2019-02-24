<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    public function Clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function personals()
    {
        return $this->hasMany(personal::class);
    }
}
