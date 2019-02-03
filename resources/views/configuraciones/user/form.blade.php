<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            {!! Form::label('name','Usuario',['class' =>'col-md-4 col-form-label text-right']) !!}
            <div class="col-md-8">
                {!! Form::text('name', null,
                            [   'class' => 'form-control', 'id' => 'name',
                                'placeholder' => 'Ingrese Nombre de usuario', 'required' =>'',
                                'data-parsley-pattern'=>"^[0-9a-zA-ZáéíóúüñÑ]+$"])
                !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('email','E-mail',['class' =>'col-md-4 col-form-label text-right']) !!}
            <div class="col-md-8">
                {!! Form::text('email', null,
                            [   'class' => 'form-control', 'id' => 'email',
                                'placeholder' => 'Ingrese Correo Electrónico', 'required' =>''])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h5 class="header-title">Roles</h5>
        <div class="form-group row">
            <ul class="list-unstyled">
                @foreach($roles as $role)
                <li>
                    <label>
                        {!! form::checkbox('roles[]',$role->id,null) !!}
                        {{ __($role->name) }}
                        <small>({{ $role->description ? : 'Sin Descripción' }})</small>
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="form-group text-center">
    <button type="button" class="btn btn-success" id="btn-user-guardar" value="{{ $estadoform }}" name="btn-guardar">
        <i class="{{ ($estadoform == 'create') ? 'fa fa-save' : 'fa fa-refresh'}}"></i>
        {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
    </button>
    &nbsp;
    <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
        <i class="mdi mdi-close "></i> Cerrar
    </button>
</div>