<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TOYOTA</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

        
    </head>
    <body class="antialiased">
        <a href="/toyotaqr/public">
            <img src="{{ asset('img/logo-toyota.png') }}" alt="LOGO TOYOTA" class="Logo-Toyota">
        </a>
        <div class="text-body">
            <p class="p-home">
            CONTAR CON EL <span class="p-home-bold">SEGURO EXCLUSIVO </span>TOYOTA ES CONTAR CON EL MEJOR ALIADO SIEMPRE. 
            <br> APRECIADO CONCESIONARIO, RECUERDE QUE ESTE ES EL MEDIO PARA <span class="p-home-red p-home-bold">REDIMIR EL BONO.</span> 
            <br> EL CLIENTE PUEDE UTILIZARLO EN: <span class="p-home-bold">MANTENIMIENTO, BODY & PAINT, REPUESTOS, ACCESORIOS Y/O BOUTIQUE.</span>
            </p>
        </div>
        @if (Route::has('login'))
            @auth
            <div class="div-button-home">
                <a href="{{ url('/home') }}" class="a-button">
                    <button class="button-home">Inicio</button>
                </a>
            </div>
            @else
            <div class="div-button-home">
                <a href="{{ route('login') }}" class="a-button">
                    <button class="button-home">Iniciar sesión</button>
                </a>
            </div>
            @endauth
        @endif
        <img src="{{ asset('img/logo-campana-toyota.png') }}" alt="LOGO CAMPAÑA TOYOTA">
    </body>
    <footer>
        <div class="text-footer">
            Desarrollado por <a class="a-footer" href="https://www.bpogs.com/" target="_blank">BPO Global Services</a> | Creando Lazos
        </div>
    </footer>
</html>
