<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
   

    public function __construct()
    {
        $this->middleware('permission:users.create')->only(['create','store']);
        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.edit')->only(['edit','update']);
        $this->middleware('permission:users.show')->only('show');
        $this->middleware('permission:users.destroy')->only('destroy');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function index()
    {
        $users = User::all();
        return view('configuraciones.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoform = "create";
        $roles = Role::pluck('name','id');
        return view('configuraciones.user.create',compact('estadoform','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->roles()->sync($request->role_id);

        return $user;
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
    public function edit(User $user)
    {
        $estadoform="edit";
        $roles = Role::all();
        return view('configuraciones.user.edit', compact('estadoform','user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;        
        $user->save();

         //Asignamos los roles seleccionados
         $user->roles()->sync($request->get('roles'));
        return $user;
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
    public function table()
    {
        $users = User::all();
        return view('configuraciones.user.table',compact('users'));
    }

    public function resetPassword(User $user){
        return view('configuraciones.user.reset',compact('user'));
    }

    public function saveReset(Request $request,User $user){      

        $user->password = Hash::make($request->password_nueva);
        $user->save();

        $mensaje="exito";
        return $mensaje ;
    }

    public function perfil(){
        return view('configuraciones.user.perfil_index');
    }

    public function perfilEdit(){
        $user = Auth::user();
        return view('configuraciones.user.perfil_edit',compact('user'));
    }
    public function updatePerfil(Request $request, User $user){
        $user->name = $request->name;
        $user->email =$request->email;

        $user->save();

        return $user;
    }
}
