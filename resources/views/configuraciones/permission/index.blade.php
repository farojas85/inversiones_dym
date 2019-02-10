@extends('layouts.home.app')
@section('title-page','Permisos')

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page">Configuraciones</li>
                        <li class="breadcrumb-item active" aria-current="page">Permisos</li>
                    </ol>
                </div>
                <h4 class="page-title">PERMISOS</h4>                            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="header-title">LISTADO DE PERMISOS</h4>
                <div class="row">
                    <div class="col-1">
                        @can('personalsalarios.create')
                        <button class="btn btn-primary btn-rounded" id="btn-agregar"
                                title="Agregar Permiso">
                            <i class="fa fa-plus"></i> Agregar Permiso
                        </button>
                        @endcan
                    </div>
                </div>
                <hr>
                <div class="table-responsive" id="tabla-detalle">
                    <table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm" >
                        <thead>
                            <tr>
                                <th  width="10px">Acciones</th>
                                <th  width="10px">ID</th>
                                <th >Nombre</th>
                                <th >Slug</th>
                                <th >Descripción</th>                                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    @can('permissions.show')
                                    <a class="btn btn-info btn-xs modal-show" 
                                        title="Ver Permiso"
                                        href="{{ route('permissions.show',$permission->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endcan
                                    @can('permissions.edit')
                                    <a class="btn btn-warning btn-xs modal-edit" 
                                        title="Editar Permiso"
                                        href="{{ route('permissions.edit',$permission->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('permissions.destroy')
                                    <a class="btn btn-danger btn-xs modal-destroy" 
                                        title="Eliminar Permiso"
                                        href="{{ route('permissions.destroy',$permission->id)}}">
                                        <i class="fe-trash-2"></i>
                                    </a>
                                    @endcan
                                </td>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $permission->name}} </td>
                                <td> {{ $permission->slug }}</td>
                                <td> {{ $permission->description}} </td>
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
<script src="js/configuraciones/permiso.js"></script>
@endsection

    