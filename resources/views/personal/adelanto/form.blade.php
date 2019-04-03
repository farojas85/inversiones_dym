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
    {!! Form::label('fecha','Fecha Adelanto',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::text('fecha',null,
                        ['class' => 'form-control','id'=>'fecha','required'=>'',
                        'placeholder'=>'Seleccione Fecha'])
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('motivo','Motivo Adelanto',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::textarea('motivo',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Motivo de Adelanto',
                            'rows' => '2',
                            'id'=>'motivo',
                            'required'=>''])
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('monto','Monto Adelanto',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::number('monto',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Monto de Adelanto',
                            'id'=>'monto',
                            'required'=>''])
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('mes_adelanto','Mes Adelanto',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::select('mes_adelanto',$meses,null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Seleccione Mes',
                            'id'=>'mes_adelanto',
                            'required'=>'']) 
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
        $( "#fecha" ).flatpickr({
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                  shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                  longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                }, 
                months: {
                  shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                  longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
              },
        });
    } );
</script>