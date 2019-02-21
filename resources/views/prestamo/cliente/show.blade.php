{!! Form::model($cliente, ['id' => 'form']) !!}
    <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    {!! Form::label('dni','DNI',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('dni', null,
                                    [   'class' => 'form-control', 'id' => 'dni',
                                        'disabled'=>''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('apellidos','apellidos',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('apellidos', null,
                                    [   'class' => 'form-control', 'id' => 'apellidos',
                                        'disabled' =>''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('nombres','Nombres',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('nombres', null,
                                    [   'class' => 'form-control', 'id' => 'nombres',
                                        'disabled' =>''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('telefono_fijo','Teléfono Fijo',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('telefono_fijo', null,
                                    [   'class' => 'form-control', 'id' => 'telefono_fijo',
                                        'disabled'=>''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('celular','Celular',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('celular', null,
                                    [   'class' => 'form-control', 'id' => 'celular',
                                        'disabled'=>''])
                        !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">            
                <div class="form-group row">
                        {!! Form::label('correo','E-Mail',['class' =>'col-md-4 col-form-label text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('correo', null,
                                        [   'class' => 'form-control', 'id' => 'correo',
                                            'disabled'=>''])
                            !!}
                        </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('direccion','Dirección',['class' =>'col-form-label col-md-4 text-right']) !!}
                    <div class="col-md-8">
                    {!!
                        Form::textarea('direccion', null,
                                    [   'class' => 'form-control', 'id' => 'direccion',
                                        'rows'=>'2',
                                        'disabled'=>''])
                    !!}
                    </div>        
                </div>
                <div class="form-group row">
                    {!! Form::label('nro_referencia','Nro. Referencia',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('nro_referencia', null,
                                    [   'class' => 'form-control', 'id' => 'nro_referencia',
                                        'disabled' => ''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('ruc','R.U.C',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('ruc', null,
                                    [   'class' => 'form-control', 'id' => 'ruc',
                                        'disabled' => ''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('razon_social','Razon Social',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('razon_social', null,
                                    [   'class' => 'form-control', 'id' => 'razon_social',
                                        'disabled' => ''])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    @forelse ($cliente->personals as $personal)
                    @php($personal_actual = $personal->id)
                    @empty
                    @php($personal_actual = 0)    
                    @endforelse
                    {!! Form::label('personal_id','Personal a Cargo',['class' =>'col-form-label col-md-4 text-right']) !!}
                    <div class="col-md-8">
                        
                        {!! 
                            Form::select('personal_id',$personals,$personal_actual,
                                            ['class' => 'form-control',
                                            'placeholder'=> 'Seleccione Personal',
                                            'id'=>'personal_id',
                                            'disabled'=>'']) 
                        !!} 
                    </div>                                           
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <h5 class="header-title text-center">Estado</h5>
                <div class="form-group text-center">
                    <label>{!! Form::radio('estado','activo') !!} Activo</label>
                    <label>{!! Form::radio('estado','inactivo') !!} Inactivo</label>
                    <label>{!! Form::radio('estado','suspendido') !!} Suspendido</label>
                    <label>{!! Form::radio('estado','eliminado') !!} Eliminado</label>
                </div>	
            </div>      
        </div>
        <div class="form-group text-center">
            <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
                <i class="mdi mdi-close "></i> Cerrar
            </button>
        </div>
    
    {!! Form::close() !!}