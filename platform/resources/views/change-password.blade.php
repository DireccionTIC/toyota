@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a href="/toyotaqr/public" target="__blank">
        <img src="{{ asset('img/logo-toyota.png') }}" alt="LOGO TOYOTA" class="Logo-Toyota">
    </a>
        <!-- Right Side Of Navbar -->
    <ul class="">
        <!-- Authentication Links -->
        <li class="">
            <a id="navbarDropdown" class="" href="{{ route('home') }}">
                Lector
            </a>
        </li>
        @if(@Auth::user()->hasRole('admin'))
            <li class="">
                <a id="navbarDropdown" class="" href=" {{ route('reportes') }} ">
                    Reportes
                </a>
            </li>
            <li>
                <a id="navbarDropdown" class="" href=" {{ route('cupon.view.edit') }}">
                    Editar cupones
                </a>
            </li>
            <li>
                <a id="navbarDropdown"  href=" {{ route('create.user') }}">
                    Crear usuario   
                </a>
            </li>
            <li>
                <a id="navbarDropdown" href=" {{ route('reset.password') }}">
                    Resetear contraseña   
                </a>
            </li>
            <li>
                <a id="navbarDropdown" class="actived"  href=" {{ route('change.password') }}">
                    Cambiar contraseña
                </a>
            </li>
            @endif
            @if(@Auth::user()->hasRole('rol2'))
            <li>
                <a id="navbarDropdown" class="" href="{{ route('reportes') }}">
                    Reportes
                </a>
            </li>
            <li>
                <a id="navbarDropdown" class="actived"  href=" {{ route('change.password') }}">
                    Cambiar contraseña
                </a>
            </li>
            @endif

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
<div class="div-info">
    <h4 class="user">
        {{Auth::user()->name}}
    </h4>
</div>
<form method="POST" action="{{ route('change.password') }}" class="form">
    @csrf
    <div class="row mb-3">

            <div class="">
                <input type="password" class="input-placa" name="oldpassword" placeholder="Escriba la contraseña antigua" required>
            </div>
            @if(Session::has('errorPass'))
                <label> {{Session::get('errorPass')}}</label>
            @endif
            <div class="">
                <input type="password" class="input-placa mg-top" name="password"  placeholder="Escriba la nueva contraseña" required>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="">
                <input type="password" class="input-placa mg-top" name="passwordconfirm"  placeholder="Confirme la nueva contraseña" required>
            </div>
            @if(Session::has('message'))
                <label> {{Session::get('message')}} </label>
            @endif
    </div>

    <div class="div-button">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn-cupon btn-find">
                Cambiar
            </button>
        </div>
    </div>
</form>


@endsection
