<h5 class="mb-3 text-uppercase bg-light p-2">
    <i class="mdi mdi-account-details mr-1"></i> Editar Cuenta
</h5>
{!! Form::model($user, 
    [
        'route' => ['perfil.update',$user->id],'method' => 'POST',
        'id' => 'form'
    ]) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('name','Usuario',['class' =>'col-form-label text-right']) !!}
                    {!! Form::text('name', null,
                                [   'class' => 'form-control', 'id' => 'name',
                                    'placeholder' => 'Ingrese Nombre de usuario', 
                                    'required' =>'',
                                    'data-parsley-pattern'=>"^[0-9a-zA-ZáéíóúüñÑ]+$"])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('email','Correo Electrónico',['class' =>'col-form-label text-right']) !!}
                    {!! Form::email('email', null,
                                [   'class' => 'form-control', 'id' => 'email',
                                    'placeholder' => 'Ingrese Correo Electrónico', 
                                    'required' =>'',
                                    'data-parsley-trigger'=>'change'])
                    !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group text-center">
                <button type="button" class="btn btn-success" id="btn-perfil-guardar" value="edit">
                    <i class="ti-save"></i> Guardar
                </button>
                <a href="/perfil" class="btn btn-danger waves-effect btn-cancelar" >
                    <i class="fa fa-close"></i> Cancelar
                </a>
            </div>
        </div>
    </div>

{!! Form::close() !!}
