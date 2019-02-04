{!! Form::model($cliente, 
    [
        'route' => ['clientes.update',$cliente->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}

@include('prestamo.cliente.form')

{!! Form::close() !!}