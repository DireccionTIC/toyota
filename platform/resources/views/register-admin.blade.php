@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a href="/toyotaqr/public" target="__blank">
        <img src="{{ asset('img/logo-toyota.png') }}" alt="LOGO TOYOTA" class="Logo-Toyota">
    </a>
        <!-- Right Side Of Navbar -->
    <ul>
        <!-- Authentication Links -->
        <li >
            <a id="navbarDropdown" class="" href="{{ route('home') }}">
                Lector
            </a>
        </li>
        @if(@Auth::user()->hasRole('admin'))
            <li >
                <a id="navbarDropdown"  href=" {{ route('reportes') }} ">
                    Reportes
                </a>
            </li>
            <li>
                <a id="navbarDropdown"  href=" {{ route('cupon.view.edit') }}">
                    Editar cupones
                </a>
            </li>
            <li>
                <a id="navbarDropdown" class="actived"  href=" {{ route('create.user') }}">
                    Crear usuario   
                </a>
            </li>
            <li>
                <a id="navbarDropdown"  href=" {{ route('reset.password') }}">
                    Resetear contraseña   
                </a>
            </li>
            @endif
            @if(@Auth::user()->hasRole('rol2'))
            <li>
                <a id="navbarDropdown" href="{{ route('reportes') }}">
                    Reportes
                </a>
            </li>
            @endif
            <li>
                <a id="navbarDropdown"  href=" {{ route('change.password') }}">
                    Cambiar contraseña
                </a>
            </li>
  
        <li class="nav-item dropdown">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Cerrar sesión
            </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('register.admin') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Ingrese el nombre" class="input-login form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <br>
                                @error('name')
                                    <label role="alert">
                                        <strong>{{ $message }}</strong>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Ingrese el correo" class="input-login form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <br>
                                @error('email')
                                    <label role="alert">
                                        <strong>{{ $message }}</strong>
                                    </label>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Ingrese la contraseña" class="input-login form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <br>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Confirme la contraseña" class="input-login form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        @error('password')
                                    <label role="alert">
                                        <strong>{{ $message }}</strong>
                                    </label>
                        @enderror
                        <div class="row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button-login">
                                    Registrar
                                </button>
                            </div>
                        </div>
                        @if(Session::has('registed'))
                            <strong>{{Session::get('registed')}}</strong>
                        @endif
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection