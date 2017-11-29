<!doctype html>
<html lang="es">
  <head>
    <title>{{ $title }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            
    @yield('postcss')
  </head>
  <body>
    <input type="hidden" class="baseUrl" value="{{ URL::to('/') }}">
    @if(Auth::check())
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">URI</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ URL::to('administrador') }}">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categorías
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
              <a class="dropdown-item" href="{{ URL::to('administrador/nueva-categoria') }}">Nueva categoría</a>
              <a class="dropdown-item" href="{{ URL::to('administrador/ver-categorias') }}">Ver categorías</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ URL::to('administrador/nueva-subcategoria') }}">Nueva Sub-categoría</a>
              <a class="dropdown-item" href="{{ URL::to('administrador/ver-subcategorias') }}">Ver Sub-categorías</a>

            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNews" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Noticias
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownNews">
              <a class="dropdown-item" href="{{ URL::to('administrador/nueva-noticia') }}">Nueva noticia</a>
              <a class="dropdown-item" href="{{ URL::to('administrador/ver-noticias') }}">Ver noticias</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNews" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Banner principal
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownNews">
              <a class="dropdown-item" href="{{ URL::to('administrador/nuevo-banner') }}">Nuevo banner</a>
              <a class="dropdown-item" href="{{ URL::to('administrador/ver-banners') }}">Ver banners</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNews" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Boletin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownNews">
              <a class="dropdown-item" href="{{ URL::to('administrador/nuevo-boletin') }}">Nuevo boletin</a>
              <a class="dropdown-item" href="{{ URL::to('administrador/ver-boletines') }}">Ver boletines</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    @endif
    <div class="container-fluid">
      <!-- Content here -->
      @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    @yield('postscript')
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
  </body>
</html>