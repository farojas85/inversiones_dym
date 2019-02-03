@extends('layouts.home.app')
@section('title-page','Personal')

@section('page-content')
    <section class="section">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
            <li class="breadcrumb-item active text-" aria-current="page">Personal</li>
        </ol>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Listado Personal</h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    @can('personals.create')
                                    <button class="btn btn-primary" id="btn-agregar"
                                            title="Agregar Personal">
                                        <i class="fa fa-plus"></i> Agregar Personal
                                    </button>
                                    @endcan
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive" id="tabla-detalle">
                                <table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
                                    <thead>
                                        <tr>
                                            <th >ID</th>
                                            <th >Apellidos</th>
                                            <th >Nombres</th>
                                            <th >Usuario</th>
                                            <th>Estado</th>
                                            <th >Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personals as $persona)
                                        @php
                                            switch($persona->estado)
                                            {
                                                case 'activo':$clase="badge badge-success";$texto="Activo";break;
                                                case 'inactivo':$clase="badge badge-secondary";$texto="Inactivo";break;
                                                case 'suspendido':$clase="badge badge-dark";$texto="Suspendido";break;
                                                case 'eliminado':$clase="badge badge-danger";$texto="Eliminado";break;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td> {{ $persona->apellidos }}</td>
                                            <td> {{ $persona->nombres }}</td>
                                            <td> {{ $persona->user->name }}</td>
                                            <td class="text-center">
                                                <span class="{{$clase}}">{{$texto}}</span>
                                            </td>
                                            <td>
                                                @can('personals.edit')
                                                <a class="btn btn-social-icon btn-warning modal-edit" 
                                                    title="Editar Role"
                                                    href="{{ route('personals.edit',$persona->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('personals.destroy')
                                                <a class="btn btn-social-icon btn-danger modal-destroy" title="Eliminar Role"
                                                    href="{{ route('personals.destroy',$persona->id)}}">
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
<script src="js/principal/personal.js"></script>
@endsection