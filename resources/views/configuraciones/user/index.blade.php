@extends('layouts.home.app')
@section('title-page','Usuarios')
   
@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Configuraciones</a></li>
                        <li class="breadcrumb-item active">Usuario</li>
                    </ol>
                </div>
                <h4 class="page-title">Usuarios</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Usuario</h4>        
                    <div class="table-responsive" id="tabla-detalle">
                        @can('users.create')
                        <a href="{{route('users.create')}}" 
                            title="Nuevo Usuario"
                            class="btn btn-info btn-rounded btn-agregar-usuario">
                            <i class="fa fa-plus"></i> Agregar Usuario
                        </a>
                        @endcan
                        <br>
                        <br>
                        <table id="user-datatable" class="table table-striped dt-responsive table-sm nowrap" >
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th >ID</th>
                                    <th >Usuario</th>
                                    <th >Correo</th>
                                    <th >Rol</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @can('users.edit')
                                        <a class="btn btn-warning btn-xs modal-user-edit" 
                                            title="Editar Usuario"
                                            href="{{ route('users.edit',$user->id)}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('users.reset')
                                        <a class="btn btn-blue btn-xs modal-reset-password"
                                            title="Modificar Contraseña"
                                            href="{{route('users.reset',$user->id)}}"
                                        >
                                            <i class="mdi mdi-key"></i>
                                        </a>
                                        @endcan
                                        @can('users.destroy')
                                        <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Usuario"
                                            href="{{ route('users.destroy',$user->id)}}">
                                            <i class="fe-trash-2"></i>
                                        </a>
                                        @endcan                                        
                                    </td>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $user->name }}</td>
                                    <td> {{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->getRoles() as $role)
                                            @php
                                                switch ($role) {
                                                    case 'admin': $colorbadge = "badge-primary";break;
                                                    case 'master': $colorbadge='badge-info';break;
                                                    case 'analista': $colorbadge='badge-warning';break;
                                                    case 'cobrador': $colorbadge='badge-danger';break;
                                                }
                                            @endphp
                                            <span class="badge {{ $colorbadge }}">{{ $role }}</span>&nbsp;
                                        @endforeach                                    
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('scripties')
<script src="js/configuraciones/user.js"></script>
@endsection
