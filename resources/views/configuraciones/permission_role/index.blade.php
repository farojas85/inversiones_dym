@extends('layouts.home.app')
@section('title-page','Permisos/Roles')

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page">Configuraciones</li>
                        <li class="breadcrumb-item active" aria-current="page">Permisos / Roles</li>
                    </ol>
                </div>
                <h4 class="page-title">Asignaci&oacute;n Permisos / Roles</h4>                            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card-box">
                <h4 class="header-title">Roles</h4>
                <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" 
                    role="tablist" aria-orientation="vertical">
                    @foreach ($roles as $role)
                    <a class="nav-link mb-2" id="v-pills-home-tab" data-toggle="pill" 
                        onclick="mostrar_permisos({{ $role->id}})" role="tab"  href="" aria-controls="v-pills-home"
                        aria-selected="true">
                        <i class="fe-user"></i>
                        {{ $role->name }}
                    </a>
                    @endforeach
                </div>
            </div>   
        </div>
        <div class="col-md-9">
            <div class="card-box">
                <h3 class="header-title">PERMISOS</h3>
                <div class="tab-content pt-0" id="tabla-detalle">
                    <blockquote class="blockquote">
                        <strong class="text-blue">Seleccione Un Rol</strong>
                        <footer class="blockquote-footer text-success">En esta &Aacute;rea Visualizar&aacute;s los permisos que 
                                se van asignar a cada Rol</footer>
                    </blockquote>                   

                </div>
            </div>   
        </div>
    </div>
    <div class="row">
       
    </div>
@endsection

@section('scripties')
<script src="js/configuraciones/permiso_role.js"></script>
@endsection
