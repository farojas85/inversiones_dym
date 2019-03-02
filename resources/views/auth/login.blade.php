@extends('layouts.login.app')

@section('contenido')
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-pattern">
            <div class="card-body p-4">                
                <div class="text-center w-75 m-auto">
                    <h3> <span>Inversiones D&amp;M</span></h3>                       
                    <p class="text-muted mb-2 mt-3">Ingrese su Usuario y Contraseña</p>
                </div>
                <form method="POST" action="{{ route('login') }}" class="card-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Nombre de usuario</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label>Contrase&ntilde;a</label>
                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" 
                            name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif                        
                    </div>
                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input  class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>                                     
                    </div>
                    @if (Route::has('password.request'))
                        <p class="mb-2">
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </p>                                           
                    @endif
                    <p class="text-dark mb-0">
                        No Tienes Una Cuenta?<a href="{{ route('register')}}" class="text-primary ml-1">Registrarse</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
