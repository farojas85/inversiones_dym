<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function Prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function personals()
    {
        return $this->belongsToMany(personal::class)->withTimestamps();
    }

    public function TipoDocumento() 
    {
        return $this->belongsTo(TipoDocumento::class);
    }

}
