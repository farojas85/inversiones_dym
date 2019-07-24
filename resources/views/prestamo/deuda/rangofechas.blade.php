@if($tipo_busqueda == '01') 
<div class="col-md-6">
    Fecha Inicio
    {!! 
        Form::text('fecha_inicio',null,
                    ['class' => 'form-control',
                    'placeholder'=> 'Seleccione Fecha Inicio',
                    'id'=>'fecha_inicio',
                    'required'=>'']) 
    !!} 
</div>
<div class="col-md-6">
    Fecha Fin
    {!! 
        Form::text('fecha_fin',null,
                    ['class' => 'form-control',
                    'placeholder'=> 'Seleccione Fecha Final',
                    'id'=>'fecha_fin',
                    'required'=>'']) 
    !!} 
</div>
@elseif($tipo_busqueda == '02')
<div class="col-md-6">
    {!! Form::label('mes_inicio','Mes Inicio',['class' =>'col-form-label']) !!}
    {!! 
        Form::select('mes_inicio',$meses,null,
                    ['class' => 'form-control',
                    'placeholder'=> 'Seleccione Mes',
                    'id'=>'mes_inicio','required'=>'']) 
    !!} 
</div>
<div class="col-md-6">
    {!! Form::label('mes_fin','Mes Fin',['class' =>'col-form-label']) !!}
    {!! 
        Form::select('mes_fin',$meses,null,
                    ['class' => 'form-control',
                    'placeholder'=> 'Seleccione Mes',
                    'id'=>'mes_fin','required'=>'']) 
    !!} 
</div>
@endif
<script>
    $( function() {
        $( "#fecha_inicio" ).flatpickr({
            locale: {
                firstDayOfWeek: 7,
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
        $( "#fecha_fin" ).flatpickr({
            locale: {
                firstDayOfWeek: 7,
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