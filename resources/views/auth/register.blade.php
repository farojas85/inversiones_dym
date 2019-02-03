@extends('layouts.login.app')

@section('contenido')
<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card bg-pattern">
        <div class="card-body p-4">            
            <div class="text-center w-75 m-auto">
                <a href="index.html">
                    <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                </a>
                <p class="text-muted mb-4 mt-3">No tienes Una Cuenta? Créalo, te tomará menos de un minuto</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de Usuario</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Ingrese Nombre de Usuario"
                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Correo Electr&oacute;nico</label>
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                    name="email" value="{{ old('email') }}" placeholder="Ingrese Correo Electrónico" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Contrase&ntilde;a</label>
                    <input id="password" type="password" 
                        class="form-control { $errors->has('password') ? ' is-invalid' : '' }}" name="password" 
                        placeholder="Ingrese Contraseña" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirmar Contrase&ntilde;a</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" 
                            placeholder="Confirma Contraseña" required>
                </div>
                <div class="form-group mb-3 text-center">
                    <button type="submit" class="btn btn-success btn-block">
                        {{ __('Register') }}
                    </button>
                </div>
                <div class="form-group mb-2">
                    <div class="col-12 text-center">
                        <p class="">Ya tienes Cuenta?  <a href="{{ route('login')}}" class=""><b>{{ __('Login')}}</b></a></p>
                    </div> <!-- end col -->
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection
