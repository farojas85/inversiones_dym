{!! Form::model($prestamo, 
    [
        'route' => ['prestamos.update',$prestamo->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                {!! Form::label('personal_id','Personal',['class' =>'col-md-3 col-form-label']) !!}
                <div class="col-md-9">  
                    <select name="personal_id" id="personal_id" class="form-control">
                        <option value="{{ $personal->id }}">{{ $personal->nombres }}</option>
                    </select>
                </div>            
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row personal-monto">
                <div class="col-md-6">
                    {!! Form::label(null,'Asignado: '.$personal->total_asignado,['class' =>'col-form-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label(null,'Saldo: '.$personal->total_saldo,['class' =>'col-form-label']) !!}
                    {!! Form::hidden('hdd_saldo', $personal->total_saldo , [ 'id' => 'hdd_saldo']) !!}                    
                </div>              
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row cliente-personal">
                {!! Form::label('cliente_id','Cliente',['class' =>'col-md-3 col-form-label']) !!}
                <div class="col-md-9">
                    {!! 
                        Form::select('cliente_id',$clientes,null,
                                        ['class' => 'form-control',
                                        'placeholder' => 'Seleccione Cliente',
                                        'required'=>'']) 
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('monto','Monto',['class' =>'col-md-3 col-form-label']) !!}
                <div class="col-md-9">
                    {!! 
                        Form::number('monto',null,
                                        ['class' => 'form-control',
                                        'required' => '']) 
                    !!}        
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('dias','Dias',['class' =>'col-md-3 col-form-label']) !!}
                <div class="col-md-9" id="span_dia">
                    {!! 
                        Form::number('dias',null,
                                        ['class' => 'form-control',
                                        'required' => '','value'=>'0',
                                        'id'=>'dias',
                                        'onkeyup'=>'calcular_cuotas()']) 
                    !!}
                </div>
            </div>                    
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                {!! Form::label('fecha_prestamo','Fecha',['class' =>'col-form-label col-md-3']) !!}
                <div class="col-md-9">
                    {!! 
                        Form::text('fecha_prestamo',null,
                                    ['class' => 'form-control','id'=>'fecha_prestamo','required'=>'',
                                    'placeholder'=>'Seleccione Fecha'])
                    !!} 
                </div>                                           
            </div>
            <div class="form-group row">
                {!! Form::label('tasa_interes','Tasa Int.',['class' =>'col-md-3 col-form-label']) !!}
                <div class="col-md-9">
                    {!! 
                        Form::select('tasa_interes',$tasas,null,
                                        ['class' => 'form-control',
                                        'placeholder' => 'Seleccione Tasa de Interés',
                                        'required'=>'',
                                        'onchange' =>'calcular_cuotas()']) 
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('cuota','Cuota',['class' =>'col-md-3 col-form-label']) !!}
                <div class="col-md-9" id="span_cuota">
                    {!! 
                        Form::number('cuota',null,
                                        ['class' => 'form-control',
                                        'placeholder' => 'Ingrese Cuota',
                                        'required' => '','step'=>'0.01']) 
                    !!}
    
                </div>
            </div>
            <div class="form-group row">
                    {!! Form::label('estado','Estado',['class' =>'col-md-3 col-form-label']) !!}
                    <div class="col-md-9">
                        {!! 
                            Form::select('estado',$estadoprestamo,null,
                                            ['class' => 'form-control',
                                            'placeholder' => 'Seleccione Estado',
                                            'required'=>'']) 
                        !!}
                    </div>
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
{!! Form::close() !!}

<script>
    $( function() {
        $( "#fecha_prestamo" ).flatpickr();
    } );
    
    function calcular_cuotas()
    {
        monto =$('#monto').val();
        tasa = $('#tasa_interes').val();
        dia=$('#dias').val();
        if(monto != '' && tasa !='' && (dia!='' || dia !=0)){
            interes = monto*tasa;
            //console.log(interes)
            monto_final = parseInt(monto) + parseInt(interes);
            //console.log(monto_final)
            cuota = parseFloat(parseInt(monto_final) / dia);
            //console.log(cuota)
            $('#cuota').val(Math.round(cuota*10)/10);
        }
    }
</script>