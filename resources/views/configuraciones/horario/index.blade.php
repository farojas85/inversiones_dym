@extends('layouts.home.app')
@section('title-page','Horarios')

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page">Configuraciones</li>
                        <li class="breadcrumb-item active" aria-current="page">Horarios</li>
                    </ol>
                </div>
                <h4 class="page-title">Horarios</h4>                            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="header-title">LISTADO DE HORARIOS</h4>
                <div class="row">
                    <div class="col-1">
                        @can('horarios.create')
                        <button class="btn btn-primary btn-rounded" id="btn-agregar"
                                title="Agregar Horario">
                            <i class="fa fa-plus"></i> Agregar Horario
                        </button>
                        @endcan
                    </div>
                </div>
                <hr>
                <div class="table-responsive" id="tabla-detalle">
                    <table id="model-datatable" class="table table-striped table-bordered table-sm dt-responsive nowrap" >
                        <thead>
                            <tr>
                                <th  width="10%">Acciones</th>
                                <th  width="5%">ID</th>
                                <th>Personal</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>Dias</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                            <tr>
                                <td>
                                    <!--@can('horarios.show')
                                    <a class="btn btn-info btn-xs modal-show" 
                                        title="Ver Permiso"
                                        href="{{ route('horarios.show',$horario->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endcan-->
                                    @can('horarios.edit')
                                    <a class="btn btn-warning btn-xs modal-edit" 
                                        title="Editar Permiso"
                                        href="{{ route('horarios.edit',$horario->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('horarios.destroy')
                                    <a class="btn btn-danger btn-xs modal-destroy" 
                                        title="Eliminar Permiso"
                                        href="{{ route('horarios.destroy',$horario->id)}}">
                                        <i class="fe-trash-2"></i>
                                    </a>
                                    @endcan
                                </td>
                                <td>{{ $loop->iteration}}</td>
                                <td>
                                    {{ 
                                        $horario->personal($horario->user_id)->nombres." ".
                                        $horario->personal($horario->user_id)->apellidos }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format("h:i a")}}</td>
                                <td>{{ \Carbon\Carbon::parse($horario->hora_fin)->format("h:i a")}}</td>
                                <td>
                                    @php
                                        $dias = explode("-",$horario->dias);
                                        
                                        for($i=0;$i<count($dias);$i++)
                                        {
                                            $clase="";
                                            $nombredia="";
                                            switch($dias[$i]){
                                                case 1: $clase ="badge badge-primary";$nombredia="Lunes";break;
                                                case 2: $clase ="badge badge-success";$nombredia="Martes";break;
                                                case 3: $clase ="badge badge-info";$nombredia="Miércoles";break;
                                                case 4: $clase ="badge badge-warning";$nombredia="Jueves";break;
                                                case 5: $clase ="badge badge-danger";$nombredia="Viernes";break;
                                                case 6: $clase ="badge badge-blue";$nombredia="Sábado";break;
                                                case 7: $clase ="badge badge-pink";$nombredia="Domingo";break;
                                            }
                                            echo "<span class='".$clase."'>".$nombredia."</span>";
                                        }
                                    @endphp
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripties')
<script src="js/configuraciones/horario.js"></script>
@endsection

    