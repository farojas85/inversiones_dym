<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\personal;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;
        foreach($roles as $role){
            $role_name = $role->name;
        }

        $todo = 0;
        //Obteneos los clientes de acuerdo al rol
        $personals = 0;
        if($role_name == 'admin' || $role_name == 'master'){

            $clientes = Cliente::all()->count();

            $personals = DB::table('users as u')
                            ->join('role_user as ru','u.id', '=','ru.user_id')
                            ->join('roles as r','ru.role_id','=','r.id')
                            ->where('r.name','cobrador')
                            ->count();
            $prestamos = $this->cantidad_prestamos();
                            
        }
        else{
            $personal = personal::where('user_id','=',$user_id)->get()->first();

            $clientes = DB::table('cliente_personal as cp')
                            ->join('personals as p','cp.personal_id', '=', 'p.id')
                            ->join('clientes as c' ,'cp.cliente_id','=', 'c.id')
                            ->where('cp.personal_id','=',$personal->id)
                            ->count();
        } 
        return view('home',compact('clientes','personals','prestamos'));
       
    }

    public function cantidad_prestamos(){
        return DB::table('prestamos')->count();
    }


}
