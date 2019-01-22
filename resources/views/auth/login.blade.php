@extends('layouts.login.app')

@section('contenido')
    <div class="form-title">
        <h1>Inversiones D&amp;M</h1>
    </div>
    <div class="login-form text-center">
            <div class="toggle" title="Registrarse">
                <a href="{{ route('register') }}"><i class="fa fa-user-plus text-white"></i></a>
            </div>
        <div class="form formLogin">
            <h2>{{ __('Login') }}</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                            name="name" value="{{ old('name') }}" placeholder="Nombre de Usuario" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                        name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="remember text-left">
                        <div class="checkbox checkbox-primary">
                            <input class="form-check-input" type="checkbox" 
                                    name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="">
                        <button type="submit">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
