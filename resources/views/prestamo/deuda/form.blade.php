<div class="col-md-12">
    <div class="form-group row">
        {!! Form::label('cliente_id','Cliente',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            <div class="col-8">
                {!! 
                    Form::select('cliente_id',$clientes,null,
                                    ['class' => 'form-control',
                                    'placeholder' => 'Seleccione Cliente',
                                    'required'=>'']) 
                !!}
            </div>  
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group row">
        {!! Form::label('monto','Monto',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            <div class="col-8">
                {!! 
                    Form::number('monto',null,
                                    ['class' => 'form-control',
                                    'required' => '']) 
                !!}
            </div>  
        </div>
    </div>
</div>