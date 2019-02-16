<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\Modulo;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissionroles.create')->only(['create','store']);
        $this->middleware('permission:permissionroles.index')->only('index');
        $this->middleware('permission:permissionroles.edit')->only(['edit','update']);
        $this->middleware('permission:permissionroles.show')->only('show');
        $this->middleware('permission:permissionroles.destroy')->only('destroy');
    }

    public function index()
    {
        $roles = Role::all();

        return view('configuraciones.permission_role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mostrarPermisosRol(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permissions = Permission::all();
        return view('configuraciones.permission_role.permisos',compact('role','permissions'));
    }
    
    public function updatePermissionRol(Request $request, Role $role){
        //Actualizar los Permisos
        $role->permissions()->sync($request->get('permissions'));

        return $role;
    }
}