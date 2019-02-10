<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions.create')->only(['create','store']);
        $this->middleware('permission:permissions.index')->only('index');
        $this->middleware('permission:permissions.edit')->only(['edit','update']);
        $this->middleware('permission:permissions.show')->only('show');
        $this->middleware('permission:permissions.destroy')->only('destroy');
        $this->middleware('permission:permissionTable')->only('table');
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('configuraciones.permission.index',compact('permissions'));
    }

    public function create()
    {
        $estadoform = "create";
        return view('configuraciones.permission.create',compact('estadoform'));
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());

        return $permission;

    }

    public function show(Permission $permission)
    {
        return view('configuraciones.permission.show',compact('permission'));
    }

    public function edit(Permission $permission)
    {
        $estadoform = "edit";

        return view('configuraciones.permission.edit',compact('permission','estadoform'));
    }

    public function update(Request $request,Permission $permission)
    {
        $permission->update($request->all());

        return $permission;
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return $permission;
    }

    public function table()
    {
        $permissions = Permission::all();
        return  view('configuraciones.permission.table',compact('permissions'));
    }
}
