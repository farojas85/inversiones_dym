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
                        <table id="cliente-datatable" class="table table-striped dt-responsive table-sm nowrap" >
                            <thead>
                                <tr>
                                    <th style="width: 100px;">Acciones</th>
                                    <th >ID</th>
                                    <th >Cliente</th>
                                    <th >Personal</th>
                                    <th >Estado</th>
                                    <th>Tipo Cliente</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                            @if ($todo == 1)                          
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
                                        @if($cliente->direccion !='' || $cliente->direccion != null)
                                            @can('clientes.gmap')
                                            <a href="{{ route('clientes.gmap',$cliente->id)}}"
                                                class="btn btn-success btn-xs modal-cliente-gmap"
                                                title="Ubicación Cliente"
                                                >
                                                <i class="mdi mdi-map-marker"></i>
                                            </a>
                                            @endcan
                                        @endif
                                        @can('clientes.show')
                                        <a class="btn btn-blue btn-xs modal-cliente-show" title="Ver Cliente"
                                            href="{{ route('clientes.show',$cliente->id)}}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        @endcan
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
                                    <td> {{ $cliente->cli_apellidos." ".$cliente->cli_nombres }}</td>
                                    <td>
                                        {{  $cliente->per_apellidos." ".$cliente->per_nombres  }}
                                    </td>
                                    <td> <span class="{{ $alert }}">{{ $cliente->estado }}</span> </td>
                                    <td>
                                        @php
                                            $fecha_cobranza = \Carbon\Carbon::parse($cliente->fecha_cobranza);
                                            $ahora = \Carbon\Carbon::now();
                                            $dias = 0;
                                            if($cliente->fecha_cobranza == '' || $cliente->fecha_cobranza == null)
                                            {   
                                                $tipo_cliente = "Regular";
                                                $alertipo = "badge badge-warning";
                                            } 
                                            else{
                                                $dias = $fecha_cobranza->diffInDays($ahora);
                                                if($dias == 0 || $dias == 1){
                                                    $tipo_cliente = "Bueno";
                                                    $alertipo = "badge badge-success";
                                                } 
                                                else if($dias >=2 && $dias <=5){
                                                    $tipo_cliente = "Regular";
                                                    $alertipo = "badge badge-warning";
                                                }
                                                else if( $dias > 5){
                                                    $tipo_cliente = "Moroso";
                                                    $alertipo = "badge badge-danger";
                                                }
                                            }
                                        @endphp
                                        <span class="{{ $alertipo }}">{{ $tipo_cliente }}</span>
                                    </td>
                                </tr>  
                                @endforeach
                            @else
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
                                            @can('clientes.show')
                                            <a class="btn btn-blue btn-xs modal-cliente-show" title="Ver Cliente"
                                                href="{{ route('clientes.show',$cliente->id)}}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            @endcan
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cliente->cli_apel." ".$cliente->cli_nombre }}</td>
                                        <td>{{ $cliente->per_apel." ".$cliente->per_nombre }}</td>
                                        <td> <span class="{{ $alert }}">{{ $cliente->estado }}</span> </td>
                                        <td>
                                            @php
                                                $fecha_cobranza = \Carbon\Carbon::parse($cliente->fecha_cobranza);
                                                $ahora = \Carbon\Carbon::now();
                                                $dias = 0;
                                                if($cliente->fecha_cobranza == '' || $cliente->fecha_cobranza == null)
                                                {   
                                                    $tipo_cliente = "Regular";
                                                    $alertipo = "badge badge-warning";
                                                } 
                                                else{
                                                    $dias = $fecha_cobranza->diffInDays($ahora);
                                                    if($dias == 0 || $dias == 1){
                                                        $tipo_cliente = "Bueno";
                                                        $alertipo = "badge badge-success";
                                                    } 
                                                    else if($dias >=2 && $dias <=5){
                                                        $tipo_cliente = "Regular";
                                                        $alertipo = "badge badge-warning";
                                                    }
                                                    else if( $dias > 5){
                                                        $tipo_cliente = "Moroso";
                                                        $alertipo = "badge badge-danger";
                                                    }
                                                }
                                            @endphp
                                        <span class="{{ $alertipo }}"
                                            title="Ultimo día de Cobranza {{  $fecha_cobranza->format('d-m-Y') }}">
                                            {{ $tipo_cliente }}
                                        </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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

