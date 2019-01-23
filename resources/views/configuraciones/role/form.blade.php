<div class="col-md-12">
        <div class="form-group row">
            {!! Form::label('name','Nombre',['class' =>'col-md-3 col-form-label']) !!}
            <div class="col-md-8">
                    {!!
                    Form::text('name', null,
                                [   'class' => 'form-control', 'id' => 'name',
                                    'placeholder' => 'Ingrese Nombre', 'required' =>''])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            {!! Form::label('slug','Slug',['class' =>'col-md-3 col-form-label']) !!}
            <div class="col-md-8">
                {!!
                    Form::text('slug', null,
                                [
                                    'class' => 'form-control', 'id' => 'slug',
                                    'placeholder' =>'Ingrese Slug', 'required' => ''])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            {!! Form::label('description','Descripción',['class' =>'col-md-3 col-form-label']) !!}
            <div class="col-md-8">
                {!!
                    Form::text('description', null,
                                [
                                    'class' => 'form-control', 'id' => 'description',
                                    'placeholder' =>'Ingrese Descripción'
                                    ])
                !!}
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <h4 class="header-title">Permiso Especial</h4>
        <div class="form-group text-center">
            <label>{!! Form::radio('special','all-access') !!} Acceso Total</label>
            <label>{!! Form::radio('special','no-access') !!} Ningún Acceso</label>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="form-group">
            <button type="button" class="btn btn-success" id="btn-guardar" value="{{ $estadoform }}">
                <i class="{{ ($estadoform == 'create') ? 'ti-save' : 'fe-refresh-cw'}}"></i>
                {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
            </button>
            <button type="button" class="btn btn-danger waves-effect"  data-dismiss="modal">
                <i class="fa fa-close"></i> Cancelar
            </button>
        </div>
    </div>