<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>AutoHub</title>
    <link href="/css/Style.css" rel="stylesheet"/>

    <link href="/css/bootstrap.min.css" rel="stylesheet"/>

</head>
<body>


<div class="row" style="margin:10px;">
    <div class="col-md-6">

            <span style="float: left; margin-left: 10px; margin-top: 1%;"><img src="/Images/sri_lanka.png"
                                                                               style="width: 50px" height="25px"
                                                                               alt=""/>
                We Deliver Across Sri Lanka!!!
            </span>

    </div>
    <div class="col-md-6">
        <div class="social">
            <a href={{ url('/cart') }}><span class="glyphicon glyphicon-shopping-cart "
                                             style="float:right;margin-right:10px;margin-top:1%;height:30px;width:30px;font-size: 2em;">

            </span> <span style="float: right;"> </span></a>

            <form method="get" action="{{url('/browse')}}">{{ csrf_field() }}
                <span>
                    <input id="browseId" name="searchName" class="form-control" placeholder="Search..." type="text" style="float:right;margin-right:20px;margin-top:1%;height:30px; margin-left: 10px; width:250px"/>
                <span class="glyphicon glyphicon-search"
                      style="float:right; margin-right: -5px; margin-top:1%;height:30px;width:30px;font-size: 2em;"></span>
            </span></form>


        </div>
    </div>

</div>

<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="pull-left"><img src="/Images/autohub.png" style="width: 100px" height="50px;" alt=""/></a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{url('/home')}}"><span class="glyphicon glyphicon-home"></span></a>
            </li>
            <li class="dropdown dropdown-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Vehicle Brands
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-menu-large row">
                    <li class="col-sm-3">
                        <img src="/Images/ClassicCars.jpg" alt="">
                        <h5>Get spare parts for any brand and model</h5>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li><a href="#" onclick="aa()">Ashok Leyland</a></li>
                            <li><a href="#">Aston Martin</a></li>
                            <li><a href="#">Audi</a></li>
                            <li><a href="{{url('/car-brands/bmw')}}">BMW</a></li>
                            <li><a href="#">Chevrolet</a></li>
                            <li><a href="#">Ford</a></li>
                            <li><a href="#">Honda</a></li>
                            <li><a href="#">Hyundai</a></li>


                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li><a href="#">Kia</a></li>
                            <li><a href="#">Mahindra</a></li>
                            <li><a href="#">Mazda</a></li>
                            <li><a href="#">Mercedes-Benz</a></li>
                            <li><a href="#">Mitsubishi</a></li>
                            <li><a href="#">Nissan</a></li>
                            <li><a href="#">Puegeot</a></li>
                            <li><a href="#">Porsche</a></li>

                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>

                            <li><a href="#">Ssang Yong</a></li>

                            <li><a href="#">Suzuki</a></li>
                            <li><a href="#">Tata</a></li>
                            <li><a href="{{ url('/browse/toyota') }}">Toyota</a></li>
                            <li><a href="#">Volkswagen</a></li>
                            <li><a href="#">Volvo</a></li>


                        </ul>
                    </li>
                </ul>

            </li>

            <li class="dropdown dropdown-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Manufactures
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-menu-large row">
                    <li class="col-sm-3">
                        <img src="/Images/Manufacturer.jpg" alt="">
                        <h5>A large variety of manufacturers linked on to one marketplace</h5>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li><a href="#">Bosch</a></li>
                            <li><a href="#">NGK</a></li>
                            <li><a href="#">Sakura</a></li>


                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>


                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul></ul>
                    </li>
                </ul>


            </li>

            <li class="dropdown dropdown-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Categories
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-menu-large row">
                    <li class="col-sm-3">
                         <h5>Compare and contrast between different qualities</h5>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li><a href="#">Alternator</a></li>
                            <li><a href="#">Bearings</a></li>
                            <li><a href="#">Belts</a></li>
                            <li><a href="#">Body Parts</a></li>
                            <li><a href="#">Braking System</a></li>
                            <li><a href="#">Cables</a></li>
                            <li><a href="#">Clutch System</a></li>
                            <li><a href="#">Drivetrain</a></li>


                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li><a href="#">Electricals</a></li>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Engine Parts</a></li>
                            <li><a href="#">Filters</a></li>
                            <li><a href="#">Gaskets</a></li>
                            <li><a href="#">Heating & Cooling</a></li>
                            <li><a href="#">Light System</a></li>
                            <li><a href="#">Mirrors</a></li>

                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>

                            <li><a href="#">Motors</a></li>

                            <li><a href="#">Oil & Lubes</a></li>
                            <li><a href="#">Sensors</a></li>
                            <li><a href="#">Spark Plugs</a></li>
                            <li><a href="#">Suspension System</a></li>
                            <li><a href="#">Transmission</a></li>


                        </ul>
                    </li>
                </ul>


            </li>
            <li>
                <a href="#/Sellers ">Sellers</a>
            </li>
            <li>
                <a href="{{url('/enquiry')}}">Parts Enquiry</a>
            </li>
            <li>
                <a href="{{url('/feedback')}} ">Feedback</a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout

                            </a>
                            <a href="">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;Profile
                            </a>

                            <a href="{{ url('/inbox') }}"><i class="glyphicon glyphicon-envelope"></i> Inbox</a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>


</div>


<div>
    @yield('content')
</div>

<footer>
    <div>
        <a href="#">Site Map</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="#">Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="#">Clients</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="#">Feedback</a>
    </div>
    <img src="/Images/linkedin.png" alt="Linked In"
         style="float:right;margin-right:10px;margin-top:-1%;height:30px;width:30px"/>
    <img src="/Images/Twitter_bird_icon.png" alt="Twitter"
         style="float:right;margin-right:10px;margin-top:-1%;height:30px;width:30px"/>
    <img src="/Images/facebook-icon.png" alt="Facebook"
         style="float:right;margin-right:10px;margin-top:-1%;height:30px;width:30px"/>

    <div align="center">
        &copy;All Rights Reserved by Heshan Anupama.
    </div>
    <address>
        Contact No - (077) - 8600195
    </address>
</footer>
<script src="/js/jquery-2.2.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/scripts.js"></script>
<script>

</script>

</body>
</html>
