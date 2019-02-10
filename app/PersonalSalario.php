<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalSalario extends Model
{
    public function personal()
    {
        return $this->belongsTo(personal::class);
    }
}
