@extends('layouts.home.app')
@section('title-page','Gastos Personal')

@section('page-content')
    <section class="section">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Personal</li>
            <li class="breadcrumb-item active" aria-current="page">Gastos</li>
        </ol>
        <div class="section-body" id="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">Listado Gastos Personal</h4>
                        <div class="row">
                            <div class="col-md-12">
                                @can('personalgastos.create')
                                <button class="btn btn-info btn-rounded" id="btn-agregar"
                                        title="Nuevo Gasto de Personal">
                                    <i class="fa fa-plus"></i> Agregar Gastos Personal
                                </button>
                                @endcan
                                @can('personasgastos.reporte')
                                <button class="btn btn-success btn-rounded" id="btn-buscar"
                                        title="Reporte Gasto Personal">
                                    <i class="fa fa-file"></i> Reporte
                                </button>
                                @endcan
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" id="tabla-detalle">
                                    @if($role_name == 'admin' || $role_name == 'master')
                                    <table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm dt-responsive">
                                        <thead class="thead-dark text-white">
                                            <tr>
                                                <th width="5px"  class="text-white">Acciones</th>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Personal</th>
                                                <th class="text-white">Fecha</th>
                                                <th class="text-white">Descripcion</th>
                                                <th class="text-white">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($personalgastos as $pergastos)
                                            <tr>
                                                <td>
                                                    <!--@can('personalgastos.show')
                                                    <a class="btn btn-info btn-xs modal-show"
                                                        title="Ver Gasto de Personal"
                                                        href="{{ route('personalgastos.show',$pergastos->id)}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @endcan
                                                    @can('personalgastos.edit')
                                                    <a class="btn btn-warning btn-xs modal-edit"
                                                        title="Editar Gasto de Personal"
                                                        href="{{ route('personalgastos.edit',$pergastos->id)}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endcan-->
                                                    @can('personalgastos.destroy')
                                                    <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Gasto de Personal"
                                                        href="{{ route('personalgastos.destroy',$pergastos->id)}}">
                                                        <i class="fe-trash-2"></i>
                                                    </a>
                                                    @endcan
                                                </td>
                                                <td>{{ $loop->iteration}}</td>
                                                <td> {{ $pergastos->personal}} </td>
                                                <td> {{ $pergastos->fecha}} </td>
                                                <td> {{ $pergastos->descripcion }}</td>
                                                <td>{{ "S/ ".number_format($pergastos->monto,2)}} </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">-- Datos No Registrados - Tabla Vacía -- </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @else
                                    <table id="model-datatable-2" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm dt-responsive" >
                                        <thead class="thead-dark text-white">
                                            <tr>
                                                <th width="5px" class="text-white">Acciones</th>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Fecha</th>
                                                <th class="text-white">Descripcion</th>
                                                <th class="text-white">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($personalgastos as $pergastos)
                                            <tr>
                                                <td>
                                                    <!--@can('personalgastos.show')
                                                    <a class="btn btn-info btn-xs modal-show"
                                                        title="Ver Gasto de Personal"
                                                        href="{{ route('personalgastos.show',$pergastos->id)}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @endcan
                                                    @can('personalgastos.edit')
                                                    <a class="btn btn-warning btn-xs modal-edit"
                                                        title="Editar Gasto de Personal"
                                                        href="{{ route('personalgastos.edit',$pergastos->id)}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endcan-->
                                                    @can('personalgastos.destroy')
                                                    <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Gasto de Personal"
                                                        href="{{ route('personalgastos.destroy',$pergastos->id)}}">
                                                        <i class="fe-trash-2"></i>
                                                    </a>
                                                    @endcan
                                                </td>
                                                <td>{{ $loop->iteration}}</td>
                                                <td> {{ $pergastos->fecha}} </td>
                                                <td>{{ $pergastos->descripcion }}</td>
                                                <td>{{ "S/ ".number_format($pergastos->monto,2)}} </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger">-- Datos No Registrados - Tabla Vacía --</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripties')
    <script src="js/principal/personal_gasto.js"></script>
    <script>
        $('#model-datatable-2').DataTable({
            "language":
                {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
            "pageLength": 5,
            "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
        });
    </script>
@endsection

