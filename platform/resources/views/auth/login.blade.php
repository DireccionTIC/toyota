@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
<a href="https://www.bpogs.com/toyotaqr/public/">
    <img src="{{ asset('img/logo-toyota.png') }}" alt="LOGO TOYOTA" class="Logo-Toyota">
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">  
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <input id="email" type="text" class="input-login" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Usuario">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="password" placeholder="Contraseña" type="password" class="input-login @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="button-login">
                                    Inciar sesión
                                </button>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-login" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <footer>
        <div class="text-footer">
            Desarrollado por <a class="a-footer" href="https://www.bpogs.com/" target="_blank">BPO Global Services</a> | Creando Lazos
        </div>
    </footer>
@endsection
