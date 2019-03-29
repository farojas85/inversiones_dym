{!! Form::label('cliente_id','Cliente',['class' =>'col-md-3 col-form-label']) !!}
<div class="col-md-9">
    {!! 
        Form::select('cliente_id',$clientes,null,
                        ['class' => 'form-control',
                        'placeholder' => 'Seleccione Cliente',
                        'required'=>'']) 
    !!}
</div>