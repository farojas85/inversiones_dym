{!! Form::open(['id' =>'form','route' => 'personalgastos.store']) !!}
    <div class="row">
        <div class="col-md-6">
    @if ($role_name=='admin' || $role_name=='master')
            <div class="form-group row">
                {!! Form::label('personal_id','Personal',['class' =>'col-md-3 col-form-label col-form-label-sm']) !!}
                <div class="col-md-9">   
                    {!!  Form::select('personal_id',$personal,null,
                                        ['class' => 'form-control form-control-sm',
                                        'placeholder' => 'Seleccione Personal',
                                        'required'=>'']) 
                    !!}
                    
                </div>            
            </div>
    @else
            <div class="form-group row">
                <div class="col-12">
                    <label  class="col-form-label col-form-label-sm">Personal : {{ $personal->nombres." ".$personal->apellidos }}</label>
                    
                    {!! Form::hidden('personal_id', $personal->id, ['id'=>'personal_id']) !!}
                    
                </div>            
            </div>
    @endif
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                {!! Form::label('fecha','Fecha',['class' =>'col-md-3 col-form-label col-form-label-sm']) !!}
                <div class="col-md-9">
                    {!! Form::text('fecha',date('Y-m-d'),
                                ['class' => 'form-control form-control-sm','id'=>'fecha','required'=>'',
                                'placeholder'=>'Seleccione Fecha']) 
                    !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('descripcion','Descripcion :',['class' =>'col-md-3 col-form-label col-form-label-sm']) !!}
        <div class="col-md-9">
            {!! Form::textarea('descripcion',null,
                        ['class' => 'form-control form-control-sm','id'=>'descripcion','required'=>'',
                        'placeholder'=>'Ingrese Descripción', 'rows'=>'3']) 
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('monto','Monto :',['class' =>'col-md-3 col-form-label col-form-label-sm']) !!}
        <div class="col-md-9">
            {!! Form::number('monto',null,
                        ['class' => 'form-control form-control-sm','id'=>'monto','required'=>'',
                        'placeholder'=>'Ingrese Monto', 'step'=>'0.01']) 
            !!}
        </div>
    </div><div class="row">
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
    </script>

{!! Form::close() !!}