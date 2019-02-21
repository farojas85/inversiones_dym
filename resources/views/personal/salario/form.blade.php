<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            {!! Form::label('fecha','Fecha Pago',['class' =>'col-form-label col-md-4']) !!}
            <div class="col-md-8">
                {!! 
                    Form::text('fecha',null,
                                ['class' => 'form-control','id'=>'fecha','required'=>'',
                                'placeholder'=>'Seleccione fecha'])
                !!} 
            </div>                                           
        </div>
        <div class="form-group row">
            {!! Form::label('mes_pago','Mes Pago',['class' =>'col-form-label col-md-4']) !!}
            <div class="col-md-8">
                {!! 
                    Form::select('mes_pago',$meses,null,
                                ['class' => 'form-control','id'=>'mes_pago','required'=>'',
                                'placeholder'=>'Seleccione Mes'])
                !!} 
            </div>                                           
        </div>
        <div class="form-group row">
            {!! Form::label('personal_id','Personal',['class' =>'col-form-label col-md-4']) !!}
            <div class="col-md-8">
                {!! 
                    Form::select('personal_id',$personals,null,
                                    ['class' => 'form-control',
                                    'placeholder'=> 'Seleccione Personal',
                                    'id'=>'personal_id',
                                    'required'=>'',
                                    'onchange' => 'obtener_sueldo(this.value);obtener_adelantos(this.value)']) 
                !!} 
            </div>                                           
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            {!! Form::label('sueldo','Sueldo Bruto',['class' =>'col-form-label col-md-4']) !!}
            <div class="col-md-8" id="span_salario">
                {!! 
                    Form::number('sueldo',null,
                                ['class' => 'form-control','id'=>'sueldo','required'=>''])
                !!} 
            </div>                                           
        </div>
        <div class="form-group row" >
            {!! Form::label('adelantos','Total Adelantos',['class' =>'col-form-label col-md-4']) !!}
            <div class="col-md-8">
                <span id="span_adelanto">
                    <div class="input-group">
                        {!! 
                            Form::text('adelantos',null,
                                        ['class' => 'form-control']) 
                        !!}
                        <div class="input-group-append">
                            <button class="btn btn-blue btn-xs" type="button"
                                    id="btn-adelantos">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>        
                </span> 
            </div>                                         
        </div>
        <div class="form-group row" id="span-detalle-adelantos">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <div class="form-group">
            <button type="button" class="btn btn-success" id="btn-guardar" value="{{ $estadoform }}" name="btn-guardar">
                <i class="{{ ($estadoform == 'create') ? 'ti-save' : 'fe-refresh-cw '}}"></i>
                {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
            </button>
            &nbsp;
            <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
                <i class="mdi mdi-close "></i> Cerrar
            </button>
        </div>
    </div>
</div>

<script>
    $( function() {
        $( "#fecha" ).flatpickr();
    } );
</script>
