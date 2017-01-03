@extends('Admin/index')

@section('content')
    <!-- Page content -->
    <div id="page-content-wrapper">
        <div class="page-content">
            <div class="container-fluid">

                <h2>Welcome Admin!!!</h2>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="height: 400px;" class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bookmark"></span> Quick Summary</h3>
                    </div>
                    <br><br><br><br>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-xs-6 text-center  ">
                                <a href="#" class="btn btn-danger btn-lg" role="button"><span
                                            class="glyphicon glyphicon-list-alt"></span> <br/>Brands<br>{{$brandCount}}</a>
                                <a href="#" class="btn btn-warning btn-lg" role="button"><span
                                            class="glyphicon glyphicon-barcode"></span> <br/>Models <br>{{$modelCount}}</a>
                                <a href="#" class="btn btn-primary btn-lg" role="button"><span
                                            class="glyphicon glyphicon-copyright-mark"></span> <br/>Categories <br>{{$categoryCount}}</a>
                                <a href="#" class="btn btn-primary btn-lg" role="button"><span
                                            class="glyphicon glyphicon-wrench"></span> <br/>Spares <br>{{$sparesCount}}</a>
                            </div>
                            <div class="col-sm-3"></div>

                        </div>
                        <br>
                        <div>
                            <div class="col-sm-3"></div>

                            <div class="col-xs-6  text-center">
                                <a href="#" class="btn btn-success btn-lg" role="button"><span
                                            class="glyphicon glyphicon-user"></span> <br/>Customers <br> {{$customerCount}}</a>
                                <a href="#" class="btn btn-info btn-lg" role="button"><span
                                            class="glyphicon glyphicon-user"></span> <br/>Retailers <br>{{$retailerCount}}</a>

                            </div>
                            <div class="col-sm-3"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

@endsection