<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class personalMonto extends Model
{
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
