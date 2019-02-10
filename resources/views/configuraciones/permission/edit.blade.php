{!! Form::model($permission, 
    [
        'route' => ['permissions.update',$permission->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}

@include('configuraciones.permission.form')

{!! Form::close() !!}