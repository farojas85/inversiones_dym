<div class="form-group row">
    {!! Form::label('personal_id','Personal',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::select('personal_id',$personals,null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Seleccione Personal',
                            'id'=>'personal_id',
                            'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('fecha','Fecha Pago',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::date('fecha',null,
                        ['class' => 'form-control','id'=>'fecha','required'=>''])
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('sueldo','Sueldo Bruto',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8" id="span_salario">
        {!! 
            Form::number('sueldo',null,
                        ['class' => 'form-control','id'=>'sueldo','required'=>''])
        !!} 
    </div>                                           
</div>
<div class="form-group row" >
    {!! Form::label('adelantos','Total Adelantos',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        <span id="span_adelanto">
            <div class="input-group">
                {!! 
                    Form::number('adelantos',null,
                                    ['class' => 'form-control',
                                    'placeholder'=> 'Total Adelantos']) 
                !!}
                <div class="input-group-append">
                    <button class="btn btn-blue btn-xs" type="button"
                            id="btn-adelantos">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>        
        </span> 
    </div>                                         
</div>
<span class="form-group row" id="span_adelanto_detalle"> 

</span>
<div class="form-group row" id="span_adelanto_detalle">                                        
</div>
