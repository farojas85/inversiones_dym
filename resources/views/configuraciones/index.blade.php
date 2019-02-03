@extends('layouts.home.app')
@section('title-page','Configuraciones')
    
@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistema</a></li>
                        <li class="breadcrumb-item active">Confguraciones</li>
                    </ol>
                </div>
                <h4 class="page-title">Configuraciones</h4>
            </div>
        </div>
    </div>     
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Roles</h4>        
                <div class="table-responsive" id="tabla-detalle">
                    @can('roles.create')
                    <button class="btn btn-info btn-rounded" id="btn-agregar"
                            title="Agregar Role">
                        <i class="fa fa-plus"></i> Agregar Role
                    </button>
                    @endcan
                    <table id="model-datatable" class="table table-stripped nowrap dt-responsive"  >
                        <thead>
                            <tr>
                                <th width="5px">Acciones</th>
                                <th >ID</th>
                                <th >Rol</th>
                                <th  >Descripción</th>
                                <th >Special</th>                            
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
                                        $alert = "badge badge-success";
                                        $text ="All-access";break;
                                    case 'no-access': 
                                        $alert = "badge badge-danger";
                                        $text ="No-access";break;
                                }
                            @endphp
                            <tr>
                                <td>
                                    @can('roles.edit')
                                    <a class="btn btn-warning btn-xs modal-edit" 
                                        title="Editar Role"
                                        href="{{ route('roles.edit',$rol->id)}}">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @endcan
                                    @can('roles.destroy')
                                    <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Role"
                                        href="{{ route('roles.destroy',$rol->id)}}">
                                        <i class="fe-trash-2"></i>
                                    </a>
                                    @endcan
                                </td>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $rol->name }}</td>
                                <td>{{ $rol->description }}</td>
                                <td>
                                    <div class="{{ $alert }}">
                                        {{ $text }}
                                    </div>
                                </td>
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripties')
<script src="js/configuraciones/role.js"></script>
@endsection