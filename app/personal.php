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
}
