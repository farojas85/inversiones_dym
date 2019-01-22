@extends('layouts.home.app')
@section('title-page','Configuraciones')
    
@section('page-content')
    <section class="section">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home" class="text-muted">Home</a></li>
            <li class="breadcrumb-item active text-" aria-current="page">Configuraciones</li>
        </ol>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Configuraciones Roles y Permisos</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills pb-3" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" 
                                        data-toggle="tab" href="#home3" role="tab" aria-controls="home" 
                                        aria-selected="true">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" 
                                        data-toggle="tab" href="#profile3" role="tab" 
                                        aria-controls="profile" aria-selected="false">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content border-top p-3" id="myTabContent3">
                                <div class="tab-pane fade show active p-0" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                    @can('roles.create')
                                    <button class="btn btn-info btn-rounded" id="btn-agregar"
                                            title="Agregar Role">
                                        <i class="fa fa-plus"></i> Agregar Role
                                    </button>
                                    @endcan
                                    <div class="table-responsive">
                                        <table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
                                            <thead>
                                                <tr>
                                                    <th >ID</th>
                                                    <th >Rol</th>
                                                    <th >Descripción</th>
                                                    <th >Special</th>
                                                    <th >Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $rol)
                                                @php
                                                    switch ($rol->special) {
                                                        case '': case null: 
                                                            $alert = "badge badge-dark";
                                                            $text ="--";break;
                                                        case 'all-access': 
                                                            $alert = "badge badge-info";
                                                            $text ="All-access";break;
                                                        case 'no-access': 
                                                            $alert = "badge badge-secondary";
                                                            $text ="No-access";break;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td>{{ $rol->name }}</td>
                                                    <td>{{ $rol->description }}</td>
                                                    <td>
                                                        <div class="{{ $alert }}">
                                                            {{ $text }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @can('roles.edit')
                                                        <a class="btn btn-social-icon btn-warning modal-edit" 
                                                            title="Editar Role"
                                                            href="{{ route('roles.edit',$rol->id)}}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade p-0" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.
                                </div>
                                <div class="tab-pane fade p-0" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
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
<script src="js/configuraciones/role.js"></script>
@endsection