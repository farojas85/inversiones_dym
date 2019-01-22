@extends('layouts.login.app')

@section('contenido')
<div class="form-title">
    <h1>Inversiones D&amp;M</h1>
</div>
<div class="login-form text-center">
    <div class="toggle" title="Iniciar Sesión">
        <a href="{{ route('login') }}"><i class="fa fa-user text-white"></i></a>
    </div>
    <div class="form formRegister">
        <h2>Crear una Cuenta</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nombre de Usuario"
                    class="{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input id="password" type="password" 
                    class="{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" 
                    placeholder="Contraseña" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" class="" name="password_confirmation" 
                        placeholder="Confirma Contraseña" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
