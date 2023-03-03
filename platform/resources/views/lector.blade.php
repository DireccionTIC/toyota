@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="{{ asset('css/lector.css') }}">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a href="/toyotaqr/public" target="__blank">
        <img src="{{ asset('img/logo-toyota.png') }}" alt="LOGO TOYOTA" class="Logo-Toyota">
    </a>
        <!-- Right Side Of Navbar -->
    <ul>
        <!-- Authentication Links -->
        <li >
            <a id="navbarDropdown" class="actived" href="{{ route('home') }}">
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
                <a id="navbarDropdown"  href=" {{ route('create.user') }}">
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
<div class="content">
    <div class="section section-one">
        <div class="text">
            <div class="div-title">
                <label class="title-section-one">{{Auth::user()->name}}</label>
            </div>
            <p>
                CONTAR CON EL <strong>SEGURO EXCLUSIVO</strong> TOYOTA ES CONTAR CON EL MEJOR ALIADO SIEMPRE.
                APRECIADO CONCESIONARIO, RECUERDE QUE ESTE ES EL MEDIO PARA <strong>REDIMIR EL BONO.</strong>
                <br> EL CLIENTE PUEDE UTILIZARLO EN: <strong>MANTENIMIENTO, BODY & PAINT, REPUESTOS, ACCESORIOS Y/O BOUTIQUE.</strong>
            </p>
        </div>
        <div class="div-info">
            <img src="{{ asset('img/info-reportes.png') }}" alt="Paso a paso">
        </div>
    </div>
    <div class="section section-two">
        <div class="section-cam">
            <div id="loadingMessage" class="datos-qr">🎥 Incapaz de acceder a la cámara web (asegúrate que esté habilitada)</div>
            <canvas id="canvas" hidden class="cam"></canvas>
            <div id="output" hidden>
                <div id="outputMessage"><span class="label-datos">Datos del usuario: </span> <span id="outputData"></span></div>
                <form method="POST" action="{{ route('cupon.store') }}">
                    @csrf
                    <div id="inputHidden">

                    </div>
                    <button class="btn-redime" type="submit">REDIME AQUÍ</button>
                </form>
                @if(Session::has('success'))
                    <div class="text-alert">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('errorOne'))
                    <label class="text-alert alert">Disculpe, este cupón no está <br/> registrado en nuestra base de datos.</label>
                @endif
                @if(Session::has('errorTwo'))
                <div class="alert alert-warning mt-2" role="alert">
                    <h5 class="text-alert">{{Session::get('errorTwo')}}</h5>
                    <p class="text-alert-who">{{Session::get('who')}}</p>
                    <p class="text-alert text-alert-red">{{Session::get('updated')}}</p>
                </div>
                @endif
            </div>
      <div>
        <!-- </div>
        <div id="output" hidden>
            @if(Session::has('success'))
                <label class="text-alert success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('errorOne'))
            @endif
            @if(Session::has('errorTwo'))
            <label class="text-alert warning">
                <span class="warning-title">Este cupon ya fue redimido</span>
                <p class="mb-0">{{Session::get('errorTwo')}}</p>
                <p class="mb-0">{{Session::get('who')}}</p>
                <p class="mb-0">{{Session::get('updated')}}</p>
            </label>
            @endif
        </div> -->
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
          <div>
                </div>
                <script>
                    var video = document.createElement("video");
                    var canvasElement = document.getElementById("canvas");
                    var canvas = canvasElement.getContext("2d");
                    var loadingMessage = document.getElementById("loadingMessage");
                    var outputContainer = document.getElementById("output");
                    var outputMessage = document.getElementById("outputMessage");
                    var outputData = document.getElementById("outputData");
                    var placa = document.getElementById("placa");

                    var parentInput = document.getElementById("inputHidden");
                    var input = document.createElement("input");
                    input.setAttribute('name', 'placa');
                    input.setAttribute('type', 'hidden');


    
                    function drawLine(begin, end, color) {
                        canvas.beginPath();
                        canvas.moveTo(begin.x, begin.y);
                        canvas.lineTo(end.x, end.y);
                        canvas.lineWidth = 4;
                        canvas.strokeStyle = color;
                        canvas.stroke();
                    }
    
                    // Use facingMode: environment to attemt to get the front camera on phones
                    navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "environment"
                        }
                    }).then(function(stream) {
                        video.srcObject = stream;
                        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                        video.play();
                        requestAnimationFrame(tick);
                    });
    
                    function tick() {
                        loadingMessage.innerText = "⌛ Loading video..."
                        if (video.readyState === video.HAVE_ENOUGH_DATA) {
                            loadingMessage.hidden = true;
                            canvasElement.hidden = false;
                            outputContainer.hidden = false;
    
                            canvasElement.height = video.videoHeight;
                            canvasElement.width = video.videoWidth;
                            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                                inversionAttempts: "dontInvert",
                            });
                            if (code) {
                                drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                                outputMessage.hidden = true;
                                outputData.parentElement.hidden = false;
                                outputData.innerText = code.data;

                                parentInput.appendChild(input);
                                input.value = code.data;
                            }
                            // } else {
                            //   outputMessage.hidden = false;
                            //   outputData.parentElement.hidden = true;
                            // }
                        }
                        requestAnimationFrame(tick);
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection