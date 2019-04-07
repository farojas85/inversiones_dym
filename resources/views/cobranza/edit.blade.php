{!! Form::model($cobranza, 
    [
        'route' => ['cobranzas.update',$cobranza->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}

    {!! Form::hidden('prestamo_id',$prestamo_id,['id'=> 'prestamo_id']) !!}
    {!! Form::hidden('mini_saldo',$minsaldo,['id'=> 'mini_saldo']) !!}
    {!! Form::hidden('cuota',$cuota,['id'=> 'cuota']) !!}
    {!! Form::hidden('monto_actual',$cobranza->monto,['id'=> 'monto_actual']) !!}

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
                    Form::text('numero',null,
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
                    Form::text('fecha',\Carbon\Carbon::now()->format('d-m-Y'),
                                ['class' => 'form-control','readonly'=> '',
                                'id'=>'fecha', 'required'=>'']) 
                !!} 
                <script>
                    $( function() {
                        $( "#fecha" ).flatpickr({
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend" title="Saldo Anterior">
                    <span class="input-group-text">Saldo Ant.</span>
                </div>
                {!! 
                    Form::number('saldo_anterior',$minsaldo,
                                ['class' => 'form-control','readonly'=> '',
                                'id'=>'saldo_anterior', 'required'=>'',
                                'step'=>'0.10']) 
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
                                'id'=>'monto', 'required'=>'','step'=>'0.10']) 
                !!} 
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nro. Cuotas</span>
                </div>
                {!! 
                    Form::text('cantidad_cuotas',null,
                                ['class' => 'form-control','placeholder'=> 'Nro. Cuotas',
                                'id'=>'cantidad_cuotas','required'=>'',
                                'readonly' =>'']) 
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
                    Form::number('saldo_nuevo',$minsaldo,
                                ['class' => 'form-control','placeholder'=> 'Saldo Nuevo',
                                'id'=>'saldo_nuevo', 'required'=>''
                                ,'readonly'=>'','step'=>'0.10']) 
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
{!! Form::close() !!}
<script>
        $( function() {
            //$( "#fecha" ).flatpickr();
        } );
        $('body').on('keyup', '#monto', function (event) {
            event.preventDefault();
            cuota = $('#cuota').val();
            monto_actual =$('#monto_actual').val();
            monto = $(this).val(); 
            dif_montos = parseFloat((monto > monto_actual) ? (monto - monto_actual) : (monto_actual - monto));
            console.log(monto_actual+' '+monto+' '+dif_montos)
            saldo_ant = $('#saldo_anterior').val();    
            cantidad_cuotas = parseFloat(monto/cuota).toFixed(2);
            

            $('#cantidad_cuotas').val(cantidad_cuotas);  

            saldo_nuevo = 0;
            if(monto > monto_actual){
                saldo_nuevo = parseFloat(saldo_ant) -  parseFloat(dif_montos);
            }
            else{
               saldo_nuevo =  parseFloat(saldo_ant) + parseFloat(dif_montos);
            }
            $('#saldo_nuevo').val(parseFloat(saldo_nuevo).toFixed(2));
        });
    </script>