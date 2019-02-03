{!! Form::model($user, 
    [
        'route' => ['users.update',$user->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}

@include('configuraciones.user.form')

{!! Form::close() !!}

