<div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                {!! Form::label('tipo_documento_id','Tipo Documento',['class' =>'col-form-label col-md-4 text-right']) !!}
                <div class="col-md-8">
                    {!! 
                        Form::select('tipo_documento_id',$tipodocumentos,null,
                                    ['class' => 'form-control',
                                    'placeholder'=> 'Seleccione Tipo Documento',
                                    'id'=>'tipo_documnento_id',
                                    'required'=>'']) 
                    !!} 
                </div>                                           
            </div>
            <div class="form-group row">
                {!! Form::label('dni','Nro. Documento',['class' =>'col-md-4 col-form-label text-right']) !!}
                <div class="col-md-8">
                    {!! Form::text('dni', null,
                                [   'class' => 'form-control', 'id' => 'dni',
                                    'placeholder' => 'Ingrese Nro. Documento', 'required' =>'',
                                    'maxlength' =>'12',
                                    'data-parsley-pattern'=>"^[0-9]+$"])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('apellidos','apellidos',['class' =>'col-md-4 col-form-label text-right']) !!}
                <div class="col-md-8">
                    {!! Form::text('apellidos', null,
                                [   'class' => 'form-control', 'id' => 'apellidos',
                                    'placeholder' => 'Ingrese Apellidos', 'required' =>'',
                                    'data-parsley-pattern'=>"^[a-zA-ZáéíóúüñÑ ]+$"])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('nombres','Nombres',['class' =>'col-md-4 col-form-label text-right']) !!}
                <div class="col-md-8">
                    {!! Form::text('nombres', null,
                                [   'class' => 'form-control', 'id' => 'nombres',
                                    'placeholder' => 'Ingrese Nombres', 'required' =>'',
                                    'data-parsley-pattern'=>"^[a-zA-ZáéíóúüñÑ ]+$"])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('telefono_fijo','Teléfono Fijo',['class' =>'col-md-4 col-form-label text-right']) !!}
                <div class="col-md-8">
                    {!! Form::text('telefono_fijo', null,
                                [   'class' => 'form-control', 'id' => 'telefono_fijo',
                                    'placeholder' => 'Ingrese Telefono fijo'])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('celular','Celular',['class' =>'col-md-4 col-form-label text-right']) !!}
                <div class="col-md-8">
                    {!! Form::text('celular', null,
                                [   'class' => 'form-control', 'id' => 'celular',
                                    'placeholder' => 'Ingrese Número Celular',
                                    'data-parsley-pattern'=>"^[0-9-]+$"])
                    !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">            
            <div class="form-group row">
                    {!! Form::label('licencia','Licencia',['class' =>'col-md-4 col-form-label text-right']) !!}
                    <div class="col-md-8">
                        {!! Form::text('licencia', null,
                                    [   'class' => 'form-control', 'id' => 'licencia',
                                        'placeholder' => 'Ingrese Licencia'])
                        !!}
                    </div>
            </div>
            <div class="form-group row">
                {!! Form::label('direccion','Dirección',['class' =>'col-form-label col-md-4 text-right']) !!}
                <div class="col-md-8">
                {!!
                    Form::textarea('direccion', null,
                                [   'class' => 'form-control', 'id' => 'direccion',
                                    'placeholder' => 'Ingrese Dirección',
                                    'rows'=>3])
                !!}
                </div>        
            </div>
            <div class="form-group row">
                {!! Form::label('sueldo','Sueldo',['class' =>'col-md-4 col-form-label text-right']) !!}
                <div class="col-md-8">
                    {!! Form::number('sueldo', null,
                                [   'class' => 'form-control', 'id' => 'sueldo',
                                    'placeholder' => 'Ingrese Sueldo'])
                    !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('user_id','Usuario',['class' =>'col-form-label col-md-4 text-right']) !!}
                <div class="col-md-8" id="span_usuario">
                    <div class="input-group">
                        {!! 
                            Form::select('user_id',$users,null,
                                            ['class' => 'form-control',
                                            'placeholder'=> 'Seleccione Usuario']) 
                        !!}
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button"
                                    id="btn-subcategoria">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                    </div> 
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
        <button type="button" class="btn btn-success" id="btn-guardar" value="{{ $estadoform }}" name="btn-guardar">
            <i class="{{ ($estadoform == 'create') ? 'ti-save' : 'fe-refresh-cw '}}"></i>
            {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
        </button>
        &nbsp;
        <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
            <i class="mdi mdi-close "></i> Cerrar
        </button>
    </div>