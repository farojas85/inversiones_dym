<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{  
    var $estado;

    public function __construct()
    {
        $this->middleware('permission:roles.create')->only(['create','store']);
        $this->middleware('permission:roles.index')->only('index');
        $this->middleware('permission:roles.edit')->only(['edit','update']);
        $this->middleware('permission:roles.show')->only('show');
        $this->middleware('permission:roles.destroy')->only('destroy');
        $this->middleware('permission:roleTable')->only('table');
        $this->estado = array( 
            'activo' => 'activo','inactivo' =>'inactivo','eliminado' =>'eliminado');
    }

    public function index()
    {
        $roles=Role::all();
        return view('configuraciones.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoform="create";
        $estados = $this->estado;
        return view('configuraciones.role.create', compact('estadoform','estados'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->special = $request->special;
        $role->estado = 'activo';

        $role->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $estadoform="edit";
        $estados = $this->estado;
        return view('configuraciones.role.edit',compact('role','estadoform','estados'));
    }

    public function update(Request $request,Role $role)
    {
        //$role  = Role::findOrFail($id);

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->special = $request->special;
        $role->estado = $request->estado;

        $role->save();

        //$role::update( $request->all());

        return $role;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $role;
    }

    public function table(){
        $roles=Role::all();
        return view('configuraciones.role.table',compact('roles'));
    }
}
