@extends('layouts.app')
@section('header')<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
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
                <a id="navbarDropdown" class="actived" href=" {{ route('cupon.view.edit') }}">
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
                <a id="navbarDropdown"  href=" {{ route('change.password') }}">
                    Cambiar contraseña
                </a>
            </li>

            @endif
            @if(@Auth::user()->hasRole('rol2'))
            <a id="navbarDropdown" class="" href="{{ route('reportes') }}">
                Reportes
            </a>
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
    <h4>
    Editar cupones <br>
    </h4>  
</div>
<form method="POST" action="{{ route('show.edit.admin') }}" class="form">
    @csrf
    <div class="row mb-3">

            <div class="">
                <input id="placa" type="text" class="input-placa" name="placa" value="{{ $cupon->placa ?? old('placa') }}" placeholder="Escrica la placa del vehículo" required>
            </div>
    </div>
    @if(Session::has('errorPlaca'))
        <h5 class="text-center">
            {{Session::get('errorPlaca')}}
        </h5>
    @endif

    <div class="div-button">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn-cupon btn-find">
                Buscar
            </button>
        </div>
    </div>
</form>


<div class="card-body">
    
    <form method="POST" action="{{ route('cupon.edit.put') }}" class="form-update">
        @method('PUT')
        @csrf
        
        <h3 class="card-header">Actualización</h3>
        
        <div class="row mb-3">
            
            <div class="div-placa">
                <label for="placa" class="">Placa: </label>
                <input type="text" class="label-placa" value="{{ $cupon->placa ?? old('placa')}}" disabled>
                <input id="placa" type="hidden" class="form-control" name="placa" value="{{ $cupon->placa ?? old('placa')}}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="div-estado">
                <label for="placa" class="">Estado: </label>
                @if(isset($cupon))
                    @if($cupon->enabled == 1)
                    <select class="form-select" name="value">
                        <option value="1" selected>Sin redimir</option>
                        <option value="0">Redimido</option>
                    </select>
                    @else
                    <select class="form-select" name="value">
                        <option value="1">Sin redimir</option>
                        <option value="0" selected>Redimido</option>
                    </select>
                    @endif
                @endif
                <br>
                @if(Session::has('times_updated'))
                    <label>Este cupón ha sido actualizado {{Session::get('times_updated')}} veces</label>
                @endif
            </div>
            <hr>
        </div>
        <div class="row mb-0 mt-2">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn-cupon btn-update">
                    Actualizar
                </button>
            </div>
        </div>
    </form>
    <div class="div-message">
        @if(Session::has('successEdit'))
        <div class="alert alert-success mt-2">{{Session::get('successEdit')}}</div>
        @endif
        
        @if(Session::has('errorEdit'))
        <div class="alert alert-warning mt-2">{{Session::get('errorEdit')}}</div>
        @endif
    </div>
</div>
@endsection
