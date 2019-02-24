@extends('layouts.home.app')
@section('title-page','Deudas Cliente')
   
@section('page-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pr&eacute;stamos</a></li>
                    <li class="breadcrumb-item active">Deudas Cliente</li>
                </ol>
            </div>
            <h4 class="page-title">Listado Deudas Clientes</h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Listado de Asignaciones</h4>   
                <div class="row">
                    <div class="col-md-2">
                        @can('clienteprestamos.create')
                        <button class="btn btn-info btn-rounded" id="btn-agregar"
                                title="Nuevo Préstamo">
                            <i class="fa fa-plus"></i> Nuevo Préstamo
                        </button>
                        @endcan
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="table-responsive" id="tabla-detalle">
                        <table id="model-datatable" class="table table-striped dt-responsive table-sm" >
                            <thead>
                                <tr>
                                    <th >Acciones</th>
                                    <th >ID</th>
                                    <th >fecha</th>
                                    <th >Cliente</th>
                                    <th >Monto Deuda</th>                                 
                                    <th>Saldo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestamos as $prestamo)
                                @php
                                    switch($prestamo->estado){
                                        case 'Generado':$clase="badge badge-danger";break;
                                        case 'Pendiente':$clase="badge badge-info";break;
                                        case 'Cancelado':$clase="badge badge-success";break;
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        @can('prestamos.show')
                                        <a class="btn btn-blue btn-xs modal-cliente-show" title="Ver Préstamo"
                                            href="{{ route('prestamos.show',$prestamo->id)}}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        @endcan
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prestamo->fecha_prestamo }}</td>
                                    <td>{{ $prestamo->cliente->nombres." ".$prestamo->cliente->apellidos }}</td>
                                    <td>{{ "S/ ".number_format($prestamo->monto,2) }}</td>
                                    <td>
                                        @if ($prestamo->saldo == '' || $prestamo->saldo == null)
                                            {{ 'S/ 0.00' }}
                                        @else
                                            {{ "S/ ".number_format($prestamo->saldo,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $clase }}">{{ $prestamo->estado }}</span>
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
@endsection

@section('scripties')
    <script src="js/prestamo/prestamo.js"></script>
@endsection