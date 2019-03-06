@auth    
    @extends('layouts.home.app')
    @section('title-page','Home')
        
    @section('page-content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inversiones DYM</a></li>
                            <li class="breadcrumb-item active">Res&uacute;menes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Res&uacute;menes</h4>
                </div>
            </div>
        </div>
        @php
            //Obtenemos Id del Usuatio
            $user_id = Auth::user()->id;
            $roles = Auth::user()->roles;

            foreach($roles as $role){
                $role_name = $role->name;
            }
        @endphp

        @switch($role_name)
            @case('cobrador')
                @include('dashboards.cobrador')
                @break
            @case('admin')
                @include('dashboards.admin')
                @break        
        @endswitch
    @endsection
@else 
{{ Redirect::to('/') }}
@endauth
