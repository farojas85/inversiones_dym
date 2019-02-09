<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalAdelanto extends Model
{
    public function personal()
    {
        return $this->belongsTo(personal::class);
    }
}
