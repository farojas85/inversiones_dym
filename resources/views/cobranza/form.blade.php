{!! Form::hidden('prestamo_id',$id) !!}
{!! Form::hidden('mini_saldo',$minsaldo) !!}

<div class="form-group row">
    {!! Form::label('fecha','Fecha',['class' =>'col-form-label col-md-3']) !!}
    <div class="col-md-9">
        {!! 
            Form::text('fecha',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese fecha',
                            'id'=>'fecha', 'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('cantidad_cuotas','Nro. Cuotas',['class' =>'col-form-label col-md-3']) !!}
    <div class="col-md-9">
        {!! 
            Form::number('cantidad_cuotas',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Número Cuotas',
                            'id'=>'cantidad_cuotas','required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('monto','Monto Pagar',['class' =>'col-form-label col-md-3']) !!}
    <div class="col-md-9">
        {!! 
            Form::number('monto',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Monto a Pagar',
                            'id'=>'monto', 'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('saldo_anterior','Saldo Anterior',['class' =>'col-form-label col-md-3']) !!}
    <div class="col-md-9">
        {!! 
            Form::number('saldo_anterior',$minsaldo,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Monto a Pagar',
                            'id'=>'saldo_anterior', 'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('saldo_nuevo','Saldo Nuevo',['class' =>'col-form-label col-md-3']) !!}
    <div class="col-md-9">
        {!! 
            Form::number('saldo_nuevo',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Monto Pagar para Ver Saldo',
                            'id'=>'saldo_nuevo', 'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group text-center">
    <button type="button" class="btn btn-success" id="btn-guardar-cobranza" value="{{ $estadoform }}" name="btn-guardar">
        <i class="{{ ($estadoform == 'create') ? 'ti-save' : 'fe-refresh-cw '}}"></i>
        {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
    </button>
    &nbsp;
    <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
        <i class="mdi mdi-close "></i> Cerrar
    </button>
</div>
<script>
    $( function() {
        $( "#fecha" ).flatpickr();
    } );
</script>