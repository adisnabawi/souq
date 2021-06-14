<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Souq: @yield('title') - An easy gateway for students to do business</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1b67393ba3.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    @if(Route::currentRouteName() == 'product')
    <link rel="stylesheet" href="{{ url('gallery/jsgallery.css') }}"  />
    @endif
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
        <img src="{{ url('logo.png') }}" alt=""  height="44">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">How To</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://eshop.iium.edu.my">EShop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://bookshop.iium.edu.my">Bookshop</a>
        </li>
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('dashboard')}}">My Dashboard</a></li>
            <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{route('logout')}}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
            </li>
          </ul>
        </li>
        
        @endauth
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endguest
      </ul>
      <span class="navbar-text">
        <a href="{{ route('ads') }}" class="btn btn-primary" style="color:white"> <i class="far fa-edit"></i> POST FREE AD</a>
      </span>
    </div>
    </nav>
    <div class="container">
    <br>
    @yield('content')
    </div>

    <br>
    <footer style="background-color: #efefef; padding:20px">
    <div class="container-fluid">
    <p>Developed by <a href="https://adisazizan.xyz" target="_blank">Adis Nabawi</a> for IIUM Community &copy; 2021</p>
    </div>
    </footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    @if(Route::currentRouteName() == 'product')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{url('gallery/jquery.jsgallery.min.js')}}"></script>
    <script>
    $("body").jsgallery({
      imgSelector : "#carouselSouq img",
      currentImage : 0,
      customHTMLFooter : "",
      bgClickClose : true,
      leftNavHTML : '<i class="fas fa-chevron-circle-left"></i>',
      rightNavHTML : '<i class="fas fa-chevron-circle-right"></i>', 
      closeHTML : '<i class="fas fa-times"></i>'

    });
    </script>
    @endif
</body>
</html>