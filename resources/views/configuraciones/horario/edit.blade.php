{!! Form::model($horario, 
    [
        'route' => ['horarios.update',$horario->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}
    
    {!! Form::hidden('id', $horario->id,['id'=>'id']) !!}
    
    <div class="form-group row">
        {!! Form::label('user_id','Personal',['class' =>'col-form-label col-md-3']) !!}
        <div class="col-md-8">
            {!! 
                Form::select('user_id',$personals,null,
                                ['class' => 'form-control',
                                'placeholder'=> 'Seleccione Personal',
                                'id'=>'user_id','required'=>'']) 
            !!} 
        </div>                                           
    </div>
    <div class="form-group row">
        {!! Form::label('hora_inicio','Hora Inicio',['class' =>'col-form-label col-md-3']) !!}    
        <div class="col-md-8">
            {!! 
                Form::text('hora_inicio',null,
                                ['class' => 'form-control',
                                'placeholder' =>'Hora Inicio',
                                'id'=>'hora_inicio', 'required'=>'']) 
            !!}        
        </div>                                           
    </div>
    <div class="form-group row">
        {!! Form::label('hora_fin','Hora Final',['class' =>'col-form-label col-md-3']) !!}    
        <div class="col-md-8">
            {!! 
                Form::text('hora_fin',null,
                                ['class' => 'form-control',
                                'placeholder' => 'Hora Final',
                                'id'=>'hora_fin', 'required'=>'']) 
            !!}      
        </div>                                           
    </div>
    <div class="form-group row">
        {!! Form::label('dias','Dias',['class' =>'col-form-label col-md-2']) !!} 
        <div class="col-md-10 row">
            @php
                $dias= explode("-",$horario->dias);
                $lun="";
                $mar="";
                $mie="";
                $jue="";
                $vie="";
                $sab="";
                $dom="";
                for($i=0;$i< count($dias);$i++){
                    switch($dias[$i]){
                        case 1: $lun = "checked";break;
                        case 2: $mar = "checked";break;
                        case 3: $mie = "checked";break;
                        case 4: $jue = "checked";break;
                        case 5: $vie = "checked";break;
                        case 6: $sab = "checked";break; 
                        case 7: $dom = "checked";break;
                    }
                }
            @endphp
            <div class="checkbox checkbox-primary form-check-inline col-md-2">
                <input type="checkbox" id="lunes" name="lunes" value="1" {{ $lun}}>
                <label for="lunes"> Lunes </label>
            </div>
            <div class="checkbox checkbox-success form-check-inline col-md-2">
                <input type="checkbox" id="martes" name="martes" value="2" {{ $mar}}>
                <label for="martes"> Martes </label>
            </div>
            <div class="checkbox checkbox-info form-check-inline col-md-3">
                <input type="checkbox" id="miercoles" name="miercoles" value="3" {{ $mie }}>
                <label for="miercoles"> Mi&eacute;rcoles </label>
            </div>
            <div class="checkbox checkbox-warning form-check-inline col-md-2">
                <input type="checkbox" id="jueves" name="jueves" value="4" {{ $jue }} >
                <label for="jueves"> Jueves </label>
            </div>
            <div class="checkbox checkbox-danger form-check-inline col-md-2">
                <input type="checkbox" id="viernes" name="viernes" value="5" {{ $vie }}>
                <label for="viernes"> Viernes </label>
            </div>
            <div class="checkbox checkbox-blue form-check-inline col-md-2">
                <input type="checkbox" id="sabado" name="sabado" value="6" {{ $sab }}>
                <label for="sabado"> S&aacutebado </label>
            </div>
            <div class="checkbox checkbox-pink form-check-inline col-md-2">
                <input type="checkbox" id="domingo" name="domingo" value="7" {{ $dom }}>
                <label for="domingo"> Domingo </label>
            </div>
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
            $( "#hora_inicio" ).clockpicker({placement:"bottom",align:"left",autoclose:!0,default:"now"});
            $( "#hora_fin" ).clockpicker({placement:"bottom",align:"left",autoclose:!0,default:"now"});
        } );
    </script>
{!! Form::close() !!}

