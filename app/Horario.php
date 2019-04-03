<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\personal;

class Horario extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personal($user_id)
    {
        $personal = personal::findOrFail($user_id);
        return $personal;
    }
}
