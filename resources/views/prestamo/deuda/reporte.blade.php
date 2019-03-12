<div class="form-group row">
    {!! Form::label('tipo_busqueda','Tipo',['class' =>'col-form-label col-md-4 ']) !!}
    <div class="col-md-8">
        {!! 
            Form::select('tipo_busqueda',$tipos,null,
                        ['class' => 'form-control',
                        'placeholder'=> 'Seleccione Tipo Documento',
                        'id'=>'tipo_busqueda',
                        'required'=>'', 
                        'onChange' =>'mostrar_rango(this.value)']) 
        !!} 
    </div>
</div>
<div class="form-group row">
    {!! Form::label('personal_id','Personal',['class' =>'col-form-label col-md-4 ']) !!}
    <div class="col-md-8">
        {!! 
            Form::select('personal_id',["%" =>'Todos', $personals ],null,
                        ['class' => 'form-control',
                        'placeholder'=> 'Seleccione Personal',
                        'id'=>'personal_id',
                        'required'=>'']) 
        !!} 
    </div>
</div>
<div class="form-group row" id="rango_fechas">
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <div class="form-group">
            <button type="button" class="btn btn-success" id="btn-buscar" name="btn-buscar"
                onclick="mostrar_resultado()">
                <i class="fas fa-search"></i> Buscar
            </button>
            &nbsp;
            <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
                <i class="mdi mdi-close "></i> Cerrar
            </button>
        </div>
    </div>
</div>
<script>
    function mostrar_rango(tipo_busqueda)
    {    
        $.ajax({
            url: '/rangofechasPrestamo/'+tipo_busqueda,
            type:"GET",
            success: function (response) {
                $('#rango_fechas').html(response);
            }
        });
    }

    function mostrar_resultado(){
        var tipo_busqueda = $("#tipo_busqueda").val();
        var personal_id = $('#personal_id').val();

        if(tipo_busqueda == '01'){
            fecha_ini  = $('#fecha_inicio').val();
            fecha_fin = $('#fecha_fib').val();
            $.ajax({
                url: '/resultReporte',
                data:{
                    personal_id:personal_id,
                    fecha_ini: fecha_ini,
                    fecha_fin: fecha_fin,
                    tipo_busqueda: tipo_busqueda
                },
                dataType:"html",
                success: function (response) {
                    $('#tabla-detalle').html(response);
                }
            });
        } 
        else if(tipo_busqueda == '02'){
            mes  = $('#mes').val();
            $.ajax({
                url: '/resultReporte',
                data:{
                    personal_id:personal_id,
                    mes: mes,
                    tipo_busqueda: tipo_busqueda
                },
                dataType:"html",
                success: function (response) {
                    $('#view-detalle').html(response);
                }
            });
        }
    }
</script>