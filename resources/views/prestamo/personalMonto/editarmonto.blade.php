
{!! Form::model($personalmontos,
    [
        'route' => ['personalmontos.updateMonto',$personalmontos->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}
    @php
        $nombres = $personal->nombres." ".$personal->apellidos;
    @endphp
    <div class="form-group row">
        {!! Form::label('nombres','Personal',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            {!!
                Form::text('nombres', $nombres,
                            [   'class' => 'form-control', 'id' => 'nombres',
                                'placeholder' => 'Ingrese Nombres','disabled'=>''])
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('fecha','fecha',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            {!!
                Form::text('fecha', null,
                            [   'class' => 'form-control', 'id' => 'fecha'])
            !!}
        </div>
    </div>
{!! Form::close() !!}
<script>
    $( function() {
        $( "#fecha" ).flatpickr();
    } );
</script>
@section('scripties')
    <script src="js/prestamo/personal_monto.js"></script>
@endsection