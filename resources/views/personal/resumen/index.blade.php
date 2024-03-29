@extends('layouts.home.app')
@section('title-page','Resumen Diario')

@section('page-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Personal</a></li>
                    <li class="breadcrumb-item active">Resumen Diario </li>
                </ol>
            </div>
            <h4 class="page-title">Listado de Totales Diarios</h4>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Resumen diario</h4> 
            <div class="row mt-2">
                <label for="personal_id" class="col-form-label col-form-label-sm col-md-1">
                    Personal:
                </label>
                    <div class="col-md-3">
                @if ($role_name == 'admin' || $role_name == 'master')
                    <select id="personal_id" name="personal_id"
                        class="form-control form-control-sm" >
                        <option value="%">Todos</option>
                        @foreach ($personals as $pe)
                        <option value="{{ $pe->id }}">{{ $pe->nombres }} {{ $pe->apellidos }}</option>
                        @endforeach
                    </select>
                @else
                    @foreach ($personals as $pe)
                        <input type="hidden" name="personal_id" id="personal_id" value ="{{ $pe->id }}">
                        <input type="text" class="form-control form-control-sm" 
                        value="{{ $pe->nombres }} {{ $pe->apellidos }}"
                        readonly>
                    @endforeach
                @endif
                </div>
                <label for="fecha_ini" class="col-form-label col-form-label-sm col-md1">Fecha Ini:</label>
                <div class="col-md-2">
                    <input type="text" name="fecha_ini" id="fecha_ini" 
                            class="form-control form-control-sm" placeholder="Seleccione Fecha">
                </div>
                <label for="fecha_fin" class="col-form-label col-form-label-sm col-md1">Fecha Fin:</label>
                <div class="col-md-2">
                    <input type="text" name="fecha_fin" id="fecha_fin" 
                            class="form-control form-control-sm" placeholder="Seleccione Fecha">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-sm btn-primary" onclick="mostrar_busqueda()">
                        <i class="fa fa-search"></i> Buscar
                    </button>
                    <a href="/resumen/exportar" class="btn btn-sm btn-success">
                        <i class="far fa-file-excel"></i> Descargar
                    </a>
                </div>
            </div>      
            <div class="table-responsive mt-2" id="tabla-detalle">
                <table id="cliente-datatable" class="table table-striped dt-responsive table-sm nowrap" >
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Personal</th>
                            <th class="text-white">Total Recibido</th>
                            <th class="text-white">Fecha</th>
                            <th class="text-white">Total Pr&eacute;stamo</th>
                            <th class="text-white">Total Cobro</th>
                            <th class="text-white">Total Gasto</th>
                            <th class="text-white">Total Entregado</th>
                            <th class="text-white">Saldo Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $saldo=0;
                    @endphp
                    @forelse ($resumen as $res)
                        @if ($loop->iteration==1)
                            @php
                                $saldo = $res['total_recibido'];
                            @endphp
                        @endif
                        
                        <tr>
                            <td>{{ $res['id'] }}</td>
                            <td>{{ $res['personal'] }}</td>
                            <td>{{ number_format($res['total_recibido'],2) }}</td>
                            <td>{{ $res['fecha'] }}</td>
                            <td>{{ number_format($res['total_prestamo'],2) }}</td>
                            <td>{{ number_format($res['total_cobro'],2) }}</td>
                            <td>{{ number_format($res['total_gasto'],2) }}</td>
                            <td>{{ number_format($res['total_entregado'],2) }}</td>
                            <td>{{ number_format($res['saldo'],2) }}</td>
                        </tr>
                    @empty
                        
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripties')
    <script src="js/principal/resumen_diario.js"></script>
@endsection