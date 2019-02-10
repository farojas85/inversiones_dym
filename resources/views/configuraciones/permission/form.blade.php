<div class="form-group row">
    {!! Form::label('name','Nombre',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::text('name',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Nombre',
                            'id'=>'name', 'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('slug','Índice (Slug)',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::text('slug',null,
                            ['class' => 'form-control',
                            'placeholder'=> 'Ingrese Nombre',
                            'id'=>'slug', 'required'=>'']) 
        !!} 
    </div>                                           
</div>
<div class="form-group row">
    {!! Form::label('description','Descripción',['class' =>'col-form-label col-md-4 text-right']) !!}
    <div class="col-md-8">
        {!! 
            Form::textarea('description',null,
                            ['class' => 'form-control','rows'=>'2',
                            'placeholder'=> 'Ingrese Nombre',
                            'id'=>'description', 'required'=>'']) 
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