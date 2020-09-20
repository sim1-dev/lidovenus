<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lido Venus') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/login.js') }}" defer></script>
    <script
    src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
    integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
    crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/animsition/css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify-icons/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme_style.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">

        <header class="header_area "style="position:relative !important">
            <div class="header-top">
              <div class="container">
                <div class="d-flex align-items-center">
                  <div id="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('img/3263.jpg') }}" style="max-width:88px" alt="" title="" /></a>
                  </div>
                  <h2 class="mx-2">Lido Venus</h2>
                  <div class="ml-auto d-none d-md-block d-md-flex">
                    <div class="media header-top-info">
                <i class="fas fa-2x fa-phone-volume" style="padding:7px;padding-right:15px;color:#c2b280"></i>
                      <div class="media-body">
                        <p>Hai bisogno di informazioni?</p>
                        <p>Chiamaci: <a href="tel:+12 365 5233">+39 345 523 3133</a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="main_menu">
              <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <!-- <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a> -->
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav">
                    <li class="nav-item active"><a class="nav-link" href="{{ url('/index') }}">Home</a></li>
                      <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                      <li class="nav-item"><a class="nav-link" href="properties.html">Properties</a></li>
                      <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
                      <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu">
                          <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                          <li class="nav-item"><a class="nav-link" href="blog-single.html">Blog Details</a></li>
                        </ul>
                      </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Login</a></li>
                    </ul>
                  </div>

                  <ul class="social-icons ml-auto">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="#"><i class="fas fa-rss"></i></a></li>
                  </ul>
                </div>
              </nav>

              <!-- <div class="search_input" id="search_input_box">
                <div class="container">
                  <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                  </form>
                </div>
              </div> -->
            </div>
            </header>

        <main>
            @yield('content')
        </main>

</div>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
</html>
