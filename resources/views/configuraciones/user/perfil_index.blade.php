@extends('layouts.home.app')

@section('title-page','Mi Perfil')

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistema</a></li>
                        <li class="breadcrumb-item active">perfil</li>
                    </ol>
                </div>
                <h4 class="page-title">Mi Perfil</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4 col-md-4">
            <div class="card-box text-center">
                <img src="assets/images/users/user-male.png" class="rounded-circle avatar-lg img-thumbnail"
                    alt="profile-image">
                <h4 class="mb-0">{{ Auth::user()->name}}</h4>
                <p class="text-muted">
                    @php
                        $roles = Auth::user()->getRoles();
                       foreach($roles as $role)
                       {
                        echo $role;
                       }
                    @endphp
                </p>
                <div class="text-center mt-3">
                    <h4 class="font-13 text-uppercase">Acerca de mí :</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8 col-md-4">
            <div class="card-box">
                <h5 class="mb-3 text-uppercase bg-light p-2">
                    <i class="mdi mdi-account-details mr-1"></i> Datos de Usuario
                </h5>
                <div class="row" id="datos-usuario">
                    <div class="col-md-12">
                        <form action="">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo Electr&oacute;nico</label>
                                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Contrase&ntilde;a</label>
                                        <input type="text" class="form-control" id="password" 
                                            value="************************" name="password" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="btn-editar-usuario"
                                        class="btn btn-success waves-effect waves-light mt-2">
                                        <i class="mdi mdi-pencil"></i> Editar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h5 class="mb-3 text-uppercase bg-light p-2">
                    <i class="mdi mdi-account-card-details mr-1"></i> Datos Personales
                </h5>
            </div>
        </div>
    </div>
@endsection
@section('scripties')
<script src="js/configuraciones/user.js"></script>
@endsection