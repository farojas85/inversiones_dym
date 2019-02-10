@extends('layouts.home.app')
@section('title-page','Pagos Personal')

@section('page-content')
    <section class="section">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Personal</li>
            <li class="breadcrumb-item active" aria-current="page">Pagos</li>
        </ol>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Listado Pagos al Personal</h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    @can('personalsalarios.create')
                                    <button class="btn btn-primary" id="btn-agregar"
                                            title="Agregar Pago Personal">
                                        <i class="fa fa-plus"></i> Agregar Pago Personal
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
                                            <th >ID</th>
                                            <th >Personal</th>
                                            <th >Fecha</th>
                                            <th >Monto</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personalSalarios as $personalSalario)
                                        <tr>
                                            <td>
                                                @can('personalsalarios.show')
                                                <a class="btn btn-info btn-xs modal-show" 
                                                    title="Ver Pago Personal"
                                                    href="{{ route('personalsalarios.show',$personalSalario->id)}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endcan
                                                @can('personalsalarios.edit')
                                                <a class="btn btn-warning btn-xs modal-edit" 
                                                    title="Editar Pago  Personal"
                                                    href="{{ route('personalsalarios.edit',$personalSalario->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('personalsalarios.destroy')
                                                <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Pago Personal"
                                                    href="{{ route('personalsalarios.destroy',$personalSalario->id)}}">
                                                    <i class="fe-trash-2"></i>
                                                </a>
                                                @endcan
                                            </td>
                                            <td>{{ $loop->iteration}}</td>
                                            <td> {{ $personalSalario->personal->nombres." ".$personalSalario->personal->apellidos}} </td>
                                            <td> {{ $personalSalario->fecha }} </td>
                                            <td></td>
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
<script src="js/principal/personal_salario.js"></script>
@endsection