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
    {!! Form::label('fecha','fecha',['class' =>'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!!
            Form::text('fecha', null,
                        [   'class' => 'form-control', 'id' => 'fecha'])
        !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('monto_asignado','Monto',['class' =>'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!!
            Form::number('monto_asignado', null,
                        [   'class' => 'form-control', 'id' => 'monto_asignado',
                            'placeholder' => 'Ingrese Monto a Asignar','required'=>'',
                            'min'=>0])
        !!}
    </div>
</div>
<div class="form-group text-center">
    <button type="button" class="btn btn-success" id="btn-guardar" value="{{ $estadoform }}" name="btn-guardar">
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
