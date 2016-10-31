


@extends('index')

@section('content')

    <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
            <div class="item active"  style="margin-left: 15%; margin-right: 15%">
                <h2 style="margin: 0px" align="center">Engine Parts...</h2>
                <a href="#">
                    <img align="center" src="../Images/carousel_03.jpg" alt="Slide 1" /></a>
                <br />
                <div class="carousel-caption">
                    <!--<h2>Largest Range Ever!</h2>-->
                    <!-- -->
                    <!--<p style="text-align: right"><a class="btn btn-primary">More Details</a></p>-->
                </div>
            </div>
            <div class="item" style="margin-left: 15%; margin-right: 15%">
                <h2 style="margin: 0px" align="center">Brakes...</h2>
                <a href="#"><img src="../Images/carousel_02.jpg" alt="Slide 2" /></a>

                <br />

            </div>
            <div class="item" style="margin-left: 15%; margin-right: 15%">
                <h2 style="margin: 0px" align="center">Suspensions...</h2>
                <a href="#"><img src="../Images/carousel_01.jpg" alt="Slide 3" /></a>

                <br />


            </div>
            <div class="item" style="margin-left: 15%; margin-right: 15%">
                <h2 style="margin: 0px" align="center">Filters...</h2>
                <a href="#"><img src="../Images/carousel_04.jpg" alt="Slide 4" /></a>

                <br />
            </div>
            <div class="item" style="margin-left: 15%; margin-right: 15%">
                <h2 style="margin: 0px" align="center">Electrical parts...</h2>
                <a href="#"><img src="../Images/carousel_05.jpg" alt="Slide 5" /></a>

                <br />
            </div>

        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right "></span>
        </a>
    </div>
    <div class="row" style="margin-left:2%;margin-right:2%;">
        <div class="col-lg-4">
            <div class="panel panel-primary" style="height: 200px;">
                <div class="panel-heading">
                    <h3 class="panel-title">What's AutoHub?</h3>
                </div>
                <div class="panel-body">
                    Its a Spare part management and E-commerce web based application for supporting both the Customers and
                    Sellers in the Automobile Industry.

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary" style="height: 200px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Purpose</h3>
                </div>
                <div class="panel-body">
                    How many times has it happened with you that the car spare parts you are looking for is not available in
                    the local spare part market? Or that replacement parts that your garage mechanic has asked you to get
                    and you cannot find it? This is why we brought you AutoHub.com, your one stop shop for buying all the
                    car spare parts and accessories.

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary" style="height: 200px;">
                <div class="panel-heading">
                    <h3 class="panel-title">What do we offer?</h3>
                </div>
                <div class="panel-body">
                    We have taken care to bring you the widest collection of spare parts and accessories for your vehicle.
                    We offer a wide range of spare parts giving the opportunity to the customer to have wide range of
                    comparisons.
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div>
        <div class="row" style="margin-left:2%;margin-right:2%;">
            <div class="col-lg-3">
                <h4>About AutoHub.com</h4><br />
                <p>SparesHub.com is the largest online marketplace for buying spare parts & services in Sri Lanka. We believe in offering quality products at correct prices with best customer service.</p>
            </div>
            <div class="col-lg-3">
                <h4>Links</h4><br />
                <a href=""><span class="glyphicon glyphicon-hand-right"> <span>About Us</span></span></a><br />
                <a href=""><span class="glyphicon glyphicon-hand-right"> <span>Contact Us</span></span></a><br />
                <a href=""><span class="glyphicon glyphicon-hand-right"> <span>Privacy Policy</span></span></a><br />
                <a href=""><span class="glyphicon glyphicon-hand-right"> <span>Terms of use</span></span></a><br />
            </div>
            <div class="col-lg-3">
                <h4>Key Features</h4><br />
                <span>1. Largest collection </span><br />
                <span>2. High quality parts with warranties</span><br />
                <span>3. Safe and secured transaction</span><br />
                <span>4. Fast and on-time delivery </span><br />
            </div>

            <div class="col-lg-3">
                <h4>Company Info</h4><br />
                <span class="glyphicon glyphicon-phone"> 011-2582465</span><br />
                <span class="glyphicon glyphicon-envelope"> autohub@gmail.com</span>
            </div>
        </div>

        <hr />
    </div>



@endsection



