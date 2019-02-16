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
        </div>
        <div class="col-lg-8 col-xl-8 col-md-4">
        </div>
    </div>
@endsection
@section('scripties')
<script src="js/configuraciones/user.js"></script>
@endsection