{!! Form::open(['id' =>'form','route' => 'permissions.store',
                'class'=>'form-horizontal']) !!}
    @include('configuraciones.permission.form')
{!! Form::close() !!}