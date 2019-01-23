{!! Form::model($role, 
    [
        'route' => ['roles.update',$role->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}

@include('configuraciones.role.form')

{!! Form::close() !!}