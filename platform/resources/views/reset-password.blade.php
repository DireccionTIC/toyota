@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="{{ asset('css/reportes.css') }}">
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
                <a id="navbarDropdown"  href=" {{ route('reportes') }} ">
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
                <a id="navbarDropdown"  class="actived" href=" {{ route('reset.password') }}">
                    Resetear contraseña   
                </a>
            </li>
            @endif
            @if(@Auth::user()->hasRole('rol2'))
            <a id="navbarDropdown" class="" href="{{ route('reportes') }}">
                Reportes
            </a>
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
<div class="body-report">
    <div class="div-title">
        <h1 class="user">{{Auth::user()->name}}</h1>
    </div>
        <form action="{{ route('resetear.contraseña') }}" method="post" class="form">
            @csrf
            <select class="form-select" aria-label=".form-select-lg example"  name="concesionario" required>
            <option value="">
                Seleccione una opción
            </option>
                @foreach($concesionarios as $concesionario)
                        <option value="{{$concesionario}}">
                            {{$concesionario}}
                        </option>
                @endforeach
            </select>
            <br>
            <button type="submit" class="btn-report">Resetear contraseña</button>
            <br>
        </form>
        @if(Session::has('success'))
            <strong>{{Session::get('success')}}</strong>
        @endif
</div>
@endsection