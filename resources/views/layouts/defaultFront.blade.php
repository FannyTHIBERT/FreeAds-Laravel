<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') - FreeAds </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img class="logo" src="/img/Logo.png" alt="logo" style="max-height: 50px;"></a>
                <!-- collapse -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <a class="navbar-brand px-1" href="/">Home</a>
                    <a class="navbar-brand px-1" href="/ads/create">Déposer une annonce</a>

                    <ul class="nav-brand navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="font-size: 1.25rem; color:rgba(0,0,0,.9);"> Categories </a>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $category)

                                <li><a class="dropdown-item" href="{{ route('pageCategories', $category->id)}}"> {{$category->name}} &raquo; </a>

                                    <ul class="submenu dropdown-menu">
                                        @foreach($category->children as $child)
                                        <li><a class="dropdown-item" href="{{ route('pageCategories', $child->id)}}">{{$child->name}}</a></li>
                                        @endforeach
                                    </ul>

                                </li>

                                @endforeach
                            </ul>
                        </li>
                    </ul>

                </div>





                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nickname }}
                            </a>
                            <!--ajouter profile button-->

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile', auth()->id()) }}">
                                    {{ __('Profile') }}
                                </a>

                                @if (Auth::user()->is_admin == 1)
                                <a class="dropdown-item" href="{{ route('/admin/menu', auth()->id()) }}">
                                    {{ __('Admin') }}
                                </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

        </main>


    </div>

    <div class="">
        @include ('layouts.footer')
    </div>
</body>

</html>