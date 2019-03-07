{!! Form::open(['id' =>'form','route' => 'users.store']) !!}
<div class="form-group row">
    {!! Form::label('name','Nombre de usuario',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        @php
            $error_name='form-control';
            if($errors->has('name')){
                $error_name = 'form-control is-invalid';
            }
        @endphp
        {!!
            Form::text('name', null,
                        [   'class' =>  $error_name, 'id' => 'name',
                            'placeholder' => 'Ingrese Nombre de Usuario', 'required' =>'',
                            'autofocus'=>''])
        !!}
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('email','Correo Electrónico',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        @php
            $error_email='form-control';
            if($errors->has('email')){
                $error_email = 'form-control is-invalid';
            }
        @endphp
        {!!
            Form::email('email', null,
                        [   'class' =>  $error_email, 'id' => 'email',
                            'placeholder' => 'Ingrese Correo Electrónico', 'required' =>''])
        !!}
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password','Contraseña',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        @php
            $error_password='form-control';
            if($errors->has('password')){
                $error_password = 'form-control is-invalid';
            }
        @endphp
        {!!
            Form::password('password',
                        [   'class' =>  $error_password, 'id' => 'password',
                            'placeholder' => 'Ingrese Contraseña', 'required' =>''])
        !!}
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password-confirm','Confirmar Contraseña',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        @php
            $error_password_confirm='form-control';
            if($errors->has('password-confirm')){
                $error_password_confirm = 'form-control is-invalid';
            }
        @endphp
        {!!
            Form::password('password-confirm',
                        [   'class' =>  $error_password_confirm, 'id' => 'password-confirm',
                            'placeholder' => 'Ingrese Confirmar Contraseña', 'required' =>'',
                            'data-parsley-equalto'=>"#password"])
        !!}
        @if ($errors->has('password-confirm'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password-confirm') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('role_id','Rol',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        @php
            $error_role_id='form-control';
            if($errors->has('role_id')){
                $error_role_id = 'form-control is-invalid';
            }
        @endphp
        {!!
            Form::select('role_id',$roles,null,
                        [   'class' =>  $error_role_id, 'id' => 'role_id',
                            'placeholder' => 'Seleccione un Rol', 'required' =>''])
        !!}
        @if ($errors->has('role_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('role_id') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12 text-right">
    <div class="form-group">
        <button type="button" class="btn btn-success" id="btn-user-guardar" value="{{ $estadoform }}">
            <i class="{{ ($estadoform == 'create') ? 'ti-save' : 'fe-refresh-cw'}}"></i>
            {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
        </button>
        <button type="button" class="btn btn-danger waves-effect"  data-dismiss="modal">
            <i class="fa fa-close"></i> Cancelar
        </button>
    </div>
</div>
{!! Form::close() !!}