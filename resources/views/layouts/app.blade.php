<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
@include('partials._head')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    {!! Html::style('public/css/custom.css') !!}
    {!! Html::style('public/css/parsley.css') !!}

</head>
<body>
<div id="app">

    <nav class="navbar navbar-default navbar-static-top">

        <div class="container">

            <div class="navbar-header">

                <a class="navbar-brand" href="/">{{ config('app.name') }}</a>

                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>

                    <li><a href="{!! route('user.dashboard') !!}">My Dashboard</a></li>

                    @if (Auth::user() && Auth::user()->isAdmin())

                        <li><a href="{!! route('admin.dashboard') !!}">Admin Dashboard</a></li>
                        <li><a href="{!! route('ingredients.index') !!}">Ingredients</a></li>

                    @endif

                </ul>


            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @if (Auth::user())

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li>

                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();"><span
                                                class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>

                    @else

                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>

                    @endif

                </ul>

            </div>

        </div>

    </nav>

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

    @yield('content')

</div>

@include('partials._javascript')
{!! Html::script('public/js/parsley.min.js') !!}

</body>

</html>
