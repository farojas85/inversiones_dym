@extends('layouts.home.app')
@section('title-page','Clientes')
   
@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pr&eacute;stamos</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>
                <h4 class="page-title">Clientes</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Listado Clientes</h4>        
                    <div class="table-responsive" id="tabla-detalle">
                        @can('users.create')
                        <button class="btn btn-info btn-rounded" id="btn-agregar-cliente"
                                title="Agregar Cliente">
                            <i class="fa fa-plus"></i> Agregar Cliente
                        </button>
                        @endcan
                        <table id="cliente-datatable" class="table table-striped dt-responsive table-sm" >
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th >ID</th>
                                    <th >Cliente</th>
                                    <th >Correo</th>
                                    <th >Estado</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                @php
                                    switch($cliente->estado)
                                    {
                                        case 'activo':$alert = "badge badge-success";break;
                                        case 'inactivo':$alert = "badge badge-dark";break;
                                        case 'suspendido':$alert = "badge badge-secondary";break;
                                        case 'eliminado':$alert = "badge badge-danger";break;
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        @can('clientes.edit')
                                        <a class="btn btn-warning btn-xs modal-cliente-edit" 
                                            title="Editar Cliente"
                                            href="{{ route('clientes.edit',$cliente->id)}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('clientes.destroy')
                                        <a class="btn btn-danger btn-xs modal-cliente-destroy" title="Eliminar Cliente"
                                            href="{{ route('clientes.destroy',$cliente->id)}}">
                                            <i class="fe-trash-2"></i>
                                        </a>
                                        @endcan
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $cliente->nombres." ".$cliente->apellidos }}</td>
                                    <td>{{ $cliente->correo}}</td>
                                    <td> <span class="{{ $alert }}">{{ $cliente->estado }}</span> </td>
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
    <script src="js/prestamo/cliente.js"></script>
@endsection
