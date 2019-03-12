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
                    'placeholder'=> 'Seleccione Fecha Inicio',
                    'id'=>'fecha_fin',
                    'required'=>'']) 
    !!} 
</div>
@elseif($tipo_busqueda == '02')
{!! Form::label('mes','Mes',['class' =>'col-form-label col-md-4 ']) !!}
    <div class="col-md-8">
        {!! 
            Form::select('mes',$meses,null,
                        ['class' => 'form-control',
                        'placeholder'=> 'Seleccione Mes',
                        'id'=>'mes','required'=>'']) 
        !!} 
    </div>
@endif
<script>
    $( function() {
        $( "#fecha_inicio" ).flatpickr();
        $( "#fecha_fin" ).flatpickr();
    } );
</script>