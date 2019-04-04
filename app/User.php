<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable,ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function personal()
    {
        return $this->hasOne(Personal::class);
    }

    public function hasRole($role)
    {
        $flag= false;        
        if ($this->roles()->where('name', $role)->first()) {
            $flag =  true;
        }
        return $flag;
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function getHorarios($user_id){
        return $this->horarios()->where('user_id',$user_id)->first();
    }

    public function countHorarios($user_id){
        return $this->horarios()->where('user_id',$user_id)->count();
    }
}
