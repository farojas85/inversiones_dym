<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class personal extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personalMontos()
    {
        return $this->hasMany(personalMonto::class);
    }

    public function PersonalAdelantos()
    {
        return $this->hasMany(PersonalAdelanto::class);
    }
    public function PersonalSalalrios()
    {
        return $this->hasMany(PersonalSalario::class);
    }

    public function PersonalGastos()
    {
        return $this->hasMany(PersonalGasto::class);
    }


    public function clientes()
    {
        return $this->belongsToMany(Cliente::class)->withTimestamps();
    }

    public function TipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
