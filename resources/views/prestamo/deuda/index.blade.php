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
        <div class="card-box" id="view-detalle">
            <h4 class="header-title">Listado de Pr&eacute;stamos</h4>   
            <div class="row">
                <div class="col-md-12">
                    @can('prestamos.create')
                    <button class="btn btn-info btn-rounded" id="btn-agregar"
                            title="Nuevo Préstamo">
                        <i class="fa fa-plus"></i> Nuevo Préstamo
                    </button>
                    @endcan
                    <button class="btn btn-danger btn-rounded" id="btn-reporte"
                            title="Reporte Préstamos">
                        <i class="fas fa-file-pdf"></i> Reportes
                    </button>
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
                        @if ($role_name == 'admin' || $role_name == 'master' )
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
                                <td>{{ $prestamo->nombres }}</td>
                                <td>{{ "S/ ".number_format($prestamo->monto,2) }}</td>
                                <td>
                                    @if ($prestamo->saldo == '' || $prestamo->saldo == null)
                                        {{ 'S/ '.number_format($prestamo->monto,2) }}
                                    @else
                                        {{ "S/ ".number_format($prestamo->saldo,2)}}
                                    @endif
                                </td>
                                <td>
                                    <span class="{{ $clase }}">{{ $prestamo->estado }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            @foreach ($prestamos as $prestamo)
                            @php
                                switch($prestamo->estado){
                                    case 'Generado':$clase="badge badge-danger ";break;
                                    case 'Pendiente':$clase="badge badge-warning";break;
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
                                    <button type="button" class="btn btn-success btn-xs mostrar-cobranza" 
                                        title="Mostrar_Cobranza" onclick="mostrar_cobranza({{$prestamo->id}})">
                                        <i class="fas fa-donate"></i>
                                    </button>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prestamo->fecha_prestamo }}</td>
                                <td>{{ $prestamo->nombres }}</td>
                                <td>{{ "S/ ".number_format($prestamo->monto,2) }}</td>
                                <td>
                                    @if ($prestamo->saldo == '' || $prestamo->saldo == null)
                                        {{ 'S/ '.number_format($prestamo->monto,2) }}
                                    @else
                                        {{ "S/ ".number_format($prestamo->saldo,2)}}
                                    @endif
                                </td>
                                <td>
                                    <span class="{{ $clase }}">{{ $prestamo->estado }}</span>
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
    <script src="js/prestamo/prestamo.js"></script>
@endsection