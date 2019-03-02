<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\personal;

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
        if($role_name == 'admin' || $role_name == 'master'){

            $count_clientes = Cliente::all()->count();
        
        }
        else{
            $personal = personal::where('user_id','=',$user_id)->get()->first();

            $count_clientes = DB::table('cliente_personal as cp')
                            ->join('personals as p','cp.personal_id', '=', 'p.id')
                            ->join('clientes as c' ,'cp.cliente_id','=', 'c.id')
                            ->where('cp.personal_id','=',$personal->id)
                            ->get()
                            ->count();

        }    
        return view('home',compact('count_clientes'));
    }
}
