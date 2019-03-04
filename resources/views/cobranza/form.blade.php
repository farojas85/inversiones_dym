{!! Form::hidden('prestamo_id',$id) !!}
{!! Form::hidden('mini_saldo',$minsaldo) !!}
{!! Form::hidden('cuota',$cuota) !!}

<div class="form-group row">
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Serie</span>
            </div> 
            {!! 
                Form::text('serie','B001',
                            ['class' => 'form-control','placeholder'=> 'Ingrese serie',
                            'id'=>'serie', 'required'=>'','maxlength' =>4]) 
            !!}
        </div>                       
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">N&uacute;mero</span>                       
            </div>
            {!! 
                Form::text('numero',$max_num,
                            ['class' => 'form-control','placeholder'=> 'Ingrese numero',
                            'id'=>'numero', 'required'=>'','readOnly' =>'']) 
            !!} 
        </div>
    </div>                                               
</div>
<div class="form-group row">
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Fecha</span>
            </div>
            {!! 
                Form::text('fecha',null,
                            ['class' => 'form-control','placeholder'=> 'Ingrese fecha',
                            'id'=>'fecha', 'required'=>'']) 
            !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Nro. Cuotas</span>
            </div>
            {!! 
                Form::number('cantidad_cuotas',null,
                            ['class' => 'form-control','placeholder'=> 'Nro. Cuotas',
                            'id'=>'cantidad_cuotas','required'=>'']) 
            !!}
        </div>
    </div>                                          
</div>
<div class="form-group row">
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Monto</span>
            </div>
            {!! 
                Form::number('monto',null,
                            ['class' => 'form-control','placeholder'=> 'Ingrese Monto a Pagar',
                            'id'=>'monto', 'required'=>'']) 
            !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend" title="Saldo Anterior">
                <span class="input-group-text">Saldo Ant.</span>
            </div>
            {!! 
                Form::number('saldo_anterior',$minsaldo,
                            ['class' => 'form-control','placeholder'=> 'Saldo Anterior',
                            'id'=>'saldo_anterior', 'required'=>'']) 
            !!}
        </div>
    </div>                                      
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="input-group">
            <div class="input-group-prepend" title="Nuevo Saldo">
                <span class="input-group-text">Saldo Nuevo</span>
            </div>
            {!! 
                Form::number('saldo_nuevo',null,
                            ['class' => 'form-control','placeholder'=> 'Ingrese Nro. de Cuotas',
                            'id'=>'saldo_nuevo', 'required'=>'']) 
            !!}
        </div>
    </div>                                       
</div>
<div class="from-group row mb-3">
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend" title="Monto Pagado">
                <span class="input-group-text">Pagado</span>
            </div>
            {!! 
                Form::number('pagado',null,
                            ['class' => 'form-control','placeholder'=> 'Monto Pagado',
                            'id'=>'pagado', 'required'=>'']) 
            !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend" title="Monto Vuelto">
                <span class="input-group-text">Vuelto</span>
            </div>
            {!! 
                Form::number('vuelto',null,
                            ['class' => 'form-control','placeholder'=> 'Monto Vuelto',
                            'id'=>'vuelto', 'required'=>'']) 
            !!}
        </div>
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