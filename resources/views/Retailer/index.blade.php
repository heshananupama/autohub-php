<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="/Retailer/css/bootstrap.min.css" rel="stylesheet">

    <link href="/Retailer/css/retailerStyles.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="/Retailer/css/sb-admin.css" rel="stylesheet">



    <!-- Morris Charts CSS -->
    <link href="/Retailer/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Retailer/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

     <![endif]-->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">AutoHub Retailer</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    {{--<li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>--}}
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
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li >
                    <a href="{{url('/retailer/home')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>

                <li >
                    <a href="{{url('/retailer/spares')}}"><i class="fa fa-fw fa-table"></i> Spares</a>
                </li>
                <li>
                    <a href="{{url('/retailer/complains')}}"><i class="fa fa-fw fa-edit"></i> Complains</a>
                </li>
                <li>
                    <a href="{{url('/retailer/orders')}} "><i class="fa fa-fw fa-cab"></i> Orders</a>
                </li>
                <li>
                    <a href="{{url('/retailer/enquiries')}}"><i class="fa fa-fw fa-file"></i> Enquiries</a>
                </li>
                <li>
                    <a href="{{url('http://localhost:8080/chat/884346')}}"><i class="fa fa-fw fa-envelope"></i> Chat with Admin</a>
                </li>

               {{-- <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                    </ul>
                </li>--}}

                <li>
                    <a href="{{url('/retailer/reports')}}"><i class="fa fa-fw fa-bar-chart-o"></i> Reports</a>
                </li>
                <li>
                    <a href="{{url('/retailer/charts')}}"><i class="fa fa-fw fa-line-chart"></i> Charts</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <!-- /#page-wrapper -->


    @yield('content')
</div>

<!-- /#wrapper -->




<!-- jQuery -->
<script src="/Retailer/js/jquery-2.2.3.min.js"></script>
<script src="/Retailer/js/jquery-ui.min.js"></script>

{{--<script src="/Retailer/js/bootstrap-datepicker.js"></script>--}}

 <script src="/Retailer/js/jsFiddler.min.js"></script>
<script src="/Retailer/js/AutoTable.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/Retailer/js/bootstrap.min.js"></script>
<script src="/Retailer/js/retailerScripts.js"></script>

{{--Report scripts--}}
<script type="text/javascript" src="/Retailer/Libraries/tableExport.js"></script>
<script type="text/javascript" src="/Retailer/Libraries/jquery.base64.js"></script>
<script type="text/javascript" src="/Retailer/Libraries/html2canvas.js"></script>
<script type="text/javascript" src="/Retailer/Libraries/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="/Retailer/Libraries/jspdf/jspdf.js"></script>
<script type="text/javascript" src="/Retailer/Libraries/jspdf/libs/base64.js"></script>

<!-- Morris Charts JavaScript -->
<script src="/Retailer/js/plugins/morris/raphael.min.js"></script>
<script src="/Retailer/js/plugins/morris/morris.min.js"></script>
<script src="/Retailer/js/plugins/morris/morris-data.js"></script>
<link href="/Retailer/css/jquery-ui.css" rel="stylesheet">

</body>

</html>
