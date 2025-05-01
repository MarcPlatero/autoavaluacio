<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('titol', 'Autoavaluació')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])

</head>
<body>
    <!-- Barra de navegació -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logoAutoavaluacio.jpg') }}" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            Autoavaluació
        </a>

        <!-- Botó del menu responsive -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contingut del menu -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <!-- Menú Dades mestres -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dadesMestresDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dades mestres
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dadesMestresDropdown">
                        <a class="dropdown-item" href="#">Tipus usuaris</a>
                        <a class="dropdown-item" href="{{ url('usuaris') }}">Usuaris</a>
                        <a class="dropdown-item" href="{{ url('cicles') }}">Cicles</a>
                        <a class="dropdown-item" href="{{ url('moduls') }}">Mòduls</a>
                        <a class="dropdown-item" href="#">Assignar professors</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Assignar alumnes</a>
                        <a class="dropdown-item" href="#">Resultats aprenentatge</a>
                        <a class="dropdown-item" href="#">Criteris avaluació</a>
                    </div>
                </li>

                <!-- Menú Professors -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="professorsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Professors
                    </a>
                    <div class="dropdown-menu" aria-labelledby="professorsDropdown">
                        <a class="dropdown-item" href="#">Assignar alumnes</a>
                        <a class="dropdown-item" href="#">Resultats aprenentatge</a>
                        <a class="dropdown-item" href="#">Criteris avaluació</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Autoavaluació alumnes</a>
                    </div>
                </li>

                <!-- Menú Alumnes -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="alumnesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Alumnes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alumnesDropdown">
                        <a class="dropdown-item" href="#">Autoavaluació</a>
                    </div>
                </li>
            </ul>

            <!-- Text amb el meu nom -->
            <span class="navbar-text">
                Marc Platero Retamero
            </span>
        </div>
    </nav>

    <!-- Contingut principal -->
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
