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
        $( "#fecha_inicio" ).flatpickr();
        $( "#fecha_fin" ).flatpickr();
    } );
</script>