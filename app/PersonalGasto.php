<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalGasto extends Model
{
    public function personal()
    {
        return $this->belongsTo(personal::class);
    }
}
