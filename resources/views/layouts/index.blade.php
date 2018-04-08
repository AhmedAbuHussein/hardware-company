<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hardware</title>

        <!-- Fonts -->
         <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/front.css" rel="stylesheet">
    @yield('style')

    </head>
    <body>
        <div>
            <nav class="navbar navbar-default bg-white navbar-expand-md">
                @if (Route::has('login'))

                <div class="container">
                    <a class="navbar-brand text-dark" href="{{url('/')}}">Hard<span>Company</span></a>
                    <button class="navbar-toggler text-danger" type="button" data-toggle="collapse" data-target="#frontNav" aria-controls="frontNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="frontNav">
                        <ul class="navbar-nav mr-auto">
                            @if(isset($cats))
                            @foreach ($cats as $cat)
                            <li class="nav-item"><a class="nav-link text-dark" href="/category/{{$cat->id}}">{{$cat->name}}</a></li>  
                            @endforeach
                            @endif
                        </ul>

                        @auth
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->groupid == 1)
                                    <li><a href="{{url('/home')}}" class="dropdown-item">Dashboard</a></li>
                                    @endif
                                    <li><a href="/profile/{{Auth::id()}}" class="dropdown-item">Profile</a></li>
                                    <li><a href="/new" class="dropdown-item">New Ads</a></li>
                                    
                                    <li class="divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        Logout
                                    </a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </ul>
                            </li>
                        </ul>
                        @else
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('login') }}">Login</a></li> 
                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('register') }}">Register</a></li> 
                        </ul>
                        @endauth
                    </div>
                </div>
                @endif
            </nav>

            <main>
                @yield('content')
            </main>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="/res/jquery-1.12.4.min.js"></script>
        <script src="/res/jquery.mixitup.min.js"></script>
        <script src="/js/front.js"></script>
        @yield('script')
    </body>
</html>
