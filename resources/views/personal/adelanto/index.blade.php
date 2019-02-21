@extends('layouts.home.app')
@section('title-page','Adelantos Personal')

@section('page-content')

    <section class="section">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Personal</li>
            <li class="breadcrumb-item active" aria-current="page">Adelanto</li>
        </ol>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Listado Adelantos</h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    @can('personaladelantos.create')
                                    <button class="btn btn-primary" id="btn-agregar"
                                            title="Agregar Adelanto Personal">
                                        <i class="fa fa-plus"></i> Agregar Adelanto Personal
                                    </button>
                                    @endcan
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive" id="tabla-detalle">
                                <table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm dt-responsive" >
                                    <thead>
                                        <tr>
                                            <th width="5px" >Acciones</th>
                                            <th >ID</th>
                                            <th >Personal</th>
                                            <th >Fecha</th>
                                            <th> Mes</th>
                                            <th >Monto</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personaladelantos as $personalAdelanto)
                                        <tr>
                                            <td>
                                                @can('personaladelantos.show')
                                                <a class="btn btn-info btn-xs modal-show" 
                                                    title="Ver Adelanto Personal"
                                                    href="{{ route('personaladelantos.show',$personalAdelanto->id)}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endcan
                                                @can('personaladelantos.edit')
                                                <a class="btn btn-warning btn-xs modal-edit" 
                                                    title="Editar Adelanto Personal"
                                                    href="{{ route('personaladelantos.edit',$personalAdelanto->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('personaladelantos.destroy')
                                                <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Adelanto Personal"
                                                    href="{{ route('personaladelantos.destroy',$personalAdelanto->id)}}">
                                                    <i class="fe-trash-2"></i>
                                                </a>
                                                @endcan
                                            </td>
                                            <td>{{ $loop->iteration}}</td>
                                            <td> {{ $personalAdelanto->personal->nombres." ".$personalAdelanto->personal->apellidos}} </td>
                                            <td> {{ $personalAdelanto->fecha}} </td>
                                            <td>
                                               @php
                                                    for($x=1;$x<=count($meses);$x++){
                                                        $idmes = str_pad($x, 2, "0", STR_PAD_LEFT); 
                                                        if($idmes == $personalAdelanto->mes_adelanto){
                                                            echo $meses[$idmes];
                                                        }
                                                    }    
                                               @endphp
                                            </td>
                                            <td>{{ "S/ ".number_format($personalAdelanto->monto,2)}} </td>
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
<script src="js/principal/personal_adelanto.js"></script>
@endsection
