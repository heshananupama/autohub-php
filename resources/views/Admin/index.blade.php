<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brandStyles.css">
    <!-- Scripts -->
    <script src="/js/jquery-2.2.3.min.js"></script>

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <a id="menu-toggle" href="#" class="glyphicon glyphicon-align-justify btn-menu toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a href="{{ url('/admin/home ') }}"><span>AutoHub</span>Admin</a>
                </div>
            </div>
            <div id="navbar" class="collapse navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-log-out"></span>Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li><a href=""
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-user"></span> Profile
                                    </a></li>
                            </ul>


                        </li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <nav id="spy">
            <ul class="sidebar-nav nav">
                <li class="sidebar-brand">
                    <a href="{{ url('/admin/home') }}"><span class="fa fa-home solo">Home</span></a>
                </li>
                <li>
                    <a href="{{ url('/admin/brand') }}">
                        <span class="fa fa-anchor solo">Brands</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/model') }}">
                        <span class="fa fa-anchor solo">Models</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/category') }}">
                        <span class="fa fa-anchor solo">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/retailer') }}">
                        <span class="fa fa-anchor solo">Retailers</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/admin/registerRetailer') }}">
                        <span class="fa fa-anchor solo">Register Retailers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('http://localhost:8080/chat/884346') }}">
                        <span class="fa fa-anchor solo">Private Chat</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div>
        @yield('content')
    </div>
    <!-- Scripts -->

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>

    <script>
        /*Menu-toggle*/
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });

        // When we click on the LI

    </script>
</div>
</body>
</html>