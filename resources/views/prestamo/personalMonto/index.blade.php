@extends('layouts.home.app')
@section('title-page','AsignarMontos')
   
@section('page-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pr&eacute;stamos</a></li>
                    <li class="breadcrumb-item active">Asiganción Montos</li>
                </ol>
            </div>
            <h4 class="page-title">Asiganción Montos al Personal</h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Listado de Asignaciones</h4>   
                <div class="row">
                    <div class="col-md-2">
                        @can('personalmontos.create')
                        <button class="btn btn-info btn-rounded" id="btn-agregar"
                                title="Nueva Asignación">
                            <i class="fa fa-plus"></i> Nueva Asignaci&oacute;n
                        </button>
                        @endcan
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive" id="tabla-detalle">
                        <table id="model-datatable" class="table table-striped dt-responsive table-sm" >
                            <thead>
                                <tr>
                                    <th >Acciones</th>
                                    <th >ID</th>
                                    <th >Personal</th>
                                    <th >Total Montos</th>
                                    <th >Total Saldo</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($personalMontos as $pm)
                                <tr>
                                    <td>
                                        @can('personalmontos.show')
                                        <a class="btn btn-blue btn-xs modal-show" 
                                            title="Listado Montos"
                                            href="{{ route('personalmontos.show',$pm->id)}}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('personalmontos.edit')
                                        <a class="btn btn-warning btn-xs modal-edit" 
                                            title="Editar Monto Personal"
                                            href="{{ route('personalmontos.edit',$pm->id)}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pm->nombres }}</td>
                                    <td>{{ "S/ ".number_format($pm->total_asignado,2) }}</td>
                                    <td>{{ "S/ ".number_format($pm->total_saldo,2) }}</td>
                                </tr>
                                @emtpy
                                <tr>
                               <td colspan="5">- Datos No Registrados -</td>
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
    <script src="js/prestamo/personal_monto.js"></script>
@endsection