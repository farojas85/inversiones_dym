{!! Form::model($user,
    [
        'route' => ['users.savereset',$user->id],'method' => 'POST',
        'id' => 'form'
    ]) !!}
<div class="form-group row">
    {!! Form::label('password_nueva','Contraseña Nueva',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!!
            Form::password('password_nueva',
                        [   'class' =>  'form-control', 'id' => 'password_nueva',
                            'placeholder' => 'Contraseña Nueva', 'required' =>''])
        !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password_nueva_confirma','Repita Contraseña',['class' =>'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!!
            Form::password('password_nueva_confirma',
                        [   'class' =>  'form-control', 'id' => 'password_nueva_confirma',
                            'placeholder' => 'Rrepita Contraseña Nueva', 'required' =>'',
                            'data-parsley-equalto'=>"#password_nueva"])
        !!}
    </div>
</div>
<div class="col-md-12 text-center">
    <div class="form-group">
        <button type="button" class="btn btn-success" id="btn-reset-guardar" value="edit">
            <i class="ti-save"></i> Guardar
        </button>
        <button type="button" class="btn btn-danger waves-effect"  data-dismiss="modal">
            <i class="fas fa-times"></i> Cancelar
        </button>
    </div>
</div>
{!! Form::close() !!}