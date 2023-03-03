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
                <a id="navbarDropdown" class="actived" href=" {{ route('reportes') }} ">
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
        <form action="{{ route('mostrarConcesionario') }}" method="post" class="form">
            @csrf
            <select class="form-select" aria-label=".form-select-lg example"  name="concesionario" required>
            <option value="Todos">
                Seleccione una opción
            </option>
                @if(isset($selected))
                    <option selected> 
                        {{$selected}}
                    </option>
                @endif
                <option value="Todos">Todos</option>
                @foreach($concesionarios as $concesionario)
                        <option value="{{$concesionario}}">
                            {{$concesionario}}
                        </option>
                @endforeach
            </select>
            <br>
            <button type="submit" class="btn-report">Filtrar</button>
            <br>
            <a href="{{ route('exportar') }}">
                <button class="btn-report export" type="button">
                    Exportar todo
                </button>
            </a>

        </form>

        <h5>CUPONES REDIMIDOS:</h5>


        @if(count($cuponsRedimidos) == 0)
            <div class="ms-4">NO HAY CUPONES REDIMIDOS</div>
        @endif

        @foreach($cuponsRedimidos as $cupon)
            <div class="cupon" role="alert">
                <h4 class="title-cupon">{{$cupon->placa}}</h4>

                <div class="divs-data label-data">
                    <p class="mb-0"> <span class="fw-bold">Sitio:</span><br>
                    <span class="fw-bold">Día y hora:</span> <br><br></p>
                    <p class="mb-0"> <span class="fw-bold">Nombre asegurado: </span>
                    <p class="mb-0"> <span class="fw-bold">Móvil asegurado: </span> 
                    <p class="mb-0"> <span class="fw-bold">Email asegurado: </span> 
                </div>

                <div class="divs-data div-data">
                    <span class="data">  {{$cupon->site}} </span> <br>
                    <span class="data">  {{$cupon->updated_at}} </span> <br><br>

                    <span class="data">  {{$cupon->name}} </span> <br>
                    <span class="data">{{$cupon->number}} </span><br>
                    <span class="data">{{$cupon->email}} </span><br>
                </div>
                <hr>
            </div>
        @endforeach

        <h5>CUPONES SIN REDIMIR:</h5>

        @if(count($cuponsRedimibles) == 0)
                <div class="ms-4">No hay cupones redimibles</div>
                    @endif
                    @foreach($cuponsRedimibles as $cupon)
                <div class="cupon" role="alert">
                    <h4 class="alert-heading">{{$cupon->placa}}</h4>
                    <div class="div-data-off">
                        <div class="divs-data label-data">
                            <p class="mb-0"> <span class="fw-bold">Nombre asegurado: </span> 
                            <p class="mb-0"> <span class="fw-bold">Móvil asegurado: </span>
                            <p class="mb-0"> <span class="fw-bold">Email asegurado: </span> 
                        </div>
                        <div class="divs-data div-data">
                            {{$cupon->name}}<br>
                            {{$cupon->number}}<br>
                            {{$cupon->email}}<br>
                        </div>
                    </div>
                    <hr>
                </div>
        @endforeach
</div>
@endsection