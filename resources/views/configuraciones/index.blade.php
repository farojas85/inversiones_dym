@extends('layouts.home.app')
@section('title-page','Configuraciones')
    
@section('page-content')
    <section class="section">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
            <li class="breadcrumb-item active text-" aria-current="page">Configuraciones</li>
        </ol>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Configuraciones Roles y Permisos</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    @can('roles.index')
                                    <button type="button" id="role-frame" class="btn btn-primary">
                                        Roles
                                    </button>
                                    @endcan
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1">
                                    @can('users.index')
                                    <button type="button" id="user-frame" class="btn btn-warning">
                                        Usuarios
                                    </button>
                                    @endcan
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive" id="tabla-detalle">
                                @can('roles.create')
                                <button class="btn btn-info btn-rounded" id="btn-agregar"
                                        title="Agregar Role">
                                    <i class="fa fa-plus"></i> Agregar Role
                                </button>
                                    @endcan
                                <table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
                                    <thead>
                                        <tr>
                                            <th >ID</th>
                                            <th >Rol</th>
                                            <th >Descripción</th>
                                            <th >Special</th>
                                            <th >Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $rol)
                                        @php
                                            switch ($rol->special) {
                                                case '': case null: 
                                                    $alert = "badge badge-dark";
                                                    $text ="--";break;
                                                case 'all-access': 
                                                    $alert = "badge badge-info";
                                                    $text ="All-access";break;
                                                case 'no-access': 
                                                    $alert = "badge badge-secondary";
                                                    $text ="No-access";break;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $rol->name }}</td>
                                            <td>{{ $rol->description }}</td>
                                            <td>
                                                <div class="{{ $alert }}">
                                                    {{ $text }}
                                                </div>
                                            </td>
                                            <td>
                                                @can('roles.edit')
                                                <a class="btn btn-social-icon btn-warning modal-edit" 
                                                    title="Editar Role"
                                                    href="{{ route('roles.edit',$rol->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('roles.destroy')
                                                <a class="btn btn-social-icon btn-danger modal-destroy" title="Eliminar Role"
                                                    href="{{ route('roles.destroy',$rol->id)}}">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                @endcan
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
        </div>
    </section>
@endsection
@section('scripties')
<script src="js/configuraciones/role.js"></script>
@endsection