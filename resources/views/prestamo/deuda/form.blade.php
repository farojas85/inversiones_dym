@if ($role_name = 'cobrador')

<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-12">
                <label  class="col-form-control">Personal : {{ $personal->nombres." ".$personal->apellidos }}</label>
                
                {!! Form::hidden('personal_id', $personal->id, ['id'=>'personal_id']) !!}
                
            </div>            
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-6">
                <label  class="col-form-control">Asignado : {{ $personalmontos->total_asignado }}</label>
            </div>
            <div class="col-6">
                <label  class="col-form-control">Saldo : {{ $personalmontos->total_saldo }}</label>
            </div>              
        </div>
    </div>
</div> 
@else
    
@endif

<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
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
                                'placeholder'=>'Seleccione fecha'])
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
                                    'required' => '']) 
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
            cuota = parseInt(monto_final) / dia;
            //console.log(cuota)
            $('#cuota').val(cuota);
        }
    }
</script>