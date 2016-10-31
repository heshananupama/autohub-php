<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--
            <style>
                html, body {
                    background-color: #fff;
                    color: #636b6f;
                    font-family: 'Raleway', sans-serif;
                    font-weight: 100;
                    height: 100vh;
                    margin: 0;
                }

                .full-height {
                    height: 100vh;
                }

                .flex-center {
                    align-items: center;
                    display: flex;
                    justify-content: center;
                }

                .position-ref {
                    position: relative;
                }

                .top-right {
                    position: absolute;
                    right: 10px;
                    top: 18px;
                }

                .content {
                    text-align: center;
                }

                .title {
                    font-size: 84px;
                }

                .links > a {
                    color: #636b6f;
                    padding: 0 25px;
                    font-size: 12px;
                    font-weight: 600;
                    letter-spacing: .1rem;
                    text-decoration: none;
                    text-transform: uppercase;
                }

                .m-b-md {
                    margin-bottom: 30px;
                }
            </style>
    --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Screen</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/Style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Favicon and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
<div class="flex-center position-ref full-height">
   {{-- @if (Route::has('login'))
        <div class="top-right links">
            <a>Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
    @endif
--}}

</div>


<!-- Top content -->
<div class="top-content">

    <div class="inner-bg" style="padding-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1 style="font-size: 80px"><strong>AutoHub</strong></h1><br/><br/><br/><br/><br/><br/><br/>


                    <a href="{{url('/home')}}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                    </a>

                    @if(Route::has('login'))

                        <a style="margin-left: 10px;"  href="{{ url('/login') }}"
                           class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-user"></span> Login
                        </a>

                        <a style="margin-left: 10px;"  href="{{ url('/register') }}"
                           class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-registration-mark"></span> Register
                        </a>
                        @endif


                </div>

            </div>

        </div>
    </div>

</div>

<footer>
    <div class="social-login ">
        <a class="btn btn-link-2" href="#">
            <i class="fa fa-facebook"></i>
        </a>
        <a class="btn btn-link-2" href="#">
            <i class="fa fa-twitter"></i>
        </a>
        <a class="btn btn-link-2" href="#">
            <i class="fa fa-google-plus"></i>
        </a>
    </div>
    </div>

</footer>

<!-- Javascript -->
<script src="/js/jquery-2.2.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script src="/js/jquery.backstretch.min.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
