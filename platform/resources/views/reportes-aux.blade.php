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
            @endif
            @if(@Auth::user()->hasRole('rol2'))
            <li>
                <a id="navbarDropdown" class="actived" href=" {{ route('cupon.view.edit') }}">
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
@endsection('header')
@section('content')

<div class="body-report">
    <h1 class="user">{{Auth::user()->name}}</h1>
    <h1>Reportes</h1>
    <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita, delectus? Pariatur nam necessitatibus dolores commodi quae architecto. Natus impedit, quidem dolor expedita quo quisquam cumque id numquam. Eos, fugit quisquam?
    </p>


    <a href="{{ route('exportar') }}">
        <button class="btn-report export" type="button">
            Exportar todo
        </button>
    </a>
    <div class="section-cupon">


        <h5>CUPONES REDIMIDOS:</h5>


        @if(count($cuponsRedimidosAux) == 0)
            <div class="ms-4">NO HAY CUPONES REDIMIDOS</div>
        @endif

        @foreach($cuponsRedimidosAux as $cupon)
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
    </div>
</div>
@endsection

